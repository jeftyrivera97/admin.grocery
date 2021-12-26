<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;
use App\Models\Factura;
use Illuminate\Support\Facades\DB;
use App\Models\Ingreso;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }

        $hora=Carbon::now(); 
        $fecha = Carbon::today(); 
        $existe=DB::table('cajas')->where('id_estado',1)->exists();
        if($existe==true)
        {
            $cajas= Caja::where('id_estado',1)->get();
            $buscar = Caja::where('id_estado',1)->first();
            $HoraInicio= $buscar->fechaHora_inicio;
            $total= Factura::where('fechaHora','>=',$HoraInicio)->where('fechaHora','<=',$hora)->where('tipo_cuenta',1)->sum('total');
            
        }else{
            $cajas= Caja::where('id_estado',1)->get();
            $total=0;
        }  
       
        return view('caja.index', compact('cajas','total'));
    }

    public function historial()
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }

        $cajas= Caja::where('id_estado',2)->get();
           
        return view('caja.historial', compact('cajas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }

        $buscar=Caja::where('id_estado','1')->exists();
        if($buscar==true)
        {
            return redirect()->back()->with(['message' => 'ERROR.Existe una caja ya abierta.', 'alert' => 'alert-danger']);
        }

         $hora=Carbon::now(); 
         $fecha = Carbon::today(); 
        return view('caja.create', compact('fecha','hora'));
    }

    public function guardar()
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }
        $buscar=Caja::where('id_estado',1)->exists();
        if($buscar==true)
        {
            return redirect()->back()->with(['message' => 'ERROR. Ya Existe una caja abierta.', 'alert' => 'alert-danger']);
        }
      
        DB::beginTransaction();
        try
        {
            $hora=Carbon::now(); 
            $fecha = Carbon::today(); 
            
            $cajas= new Caja();
            $cajas-> fecha= $fecha;
            $cajas-> fechaHora_inicio= $hora;
            $cajas-> id_estado= 1;
            $cajas-> efectivo=0;
            $cajas-> pos=0;
            $cajas-> total=0;
            $cajas-> id_usuario= auth()->user()->id;
            DB::Commit();
            $cajas->save();
            return redirect()->back()->with(['message' => 'La caja fue creada con exito', 'alert' => 'alert-success']);
           
        }
        catch(\Exception $e)
        {
            DB::Rollback();
            echo 'Error: ' .$e->getMessage();
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_caja)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }

        $hora=Carbon::now(); 
        $fecha = Carbon::today(); 

        $cajas = Caja::where('id_caja',$id_caja)->first();
        $HoraInicio= $cajas->fechaHora_inicio;
        $efectivo= Caja::where('id_caja',$id_caja)->sum('efectivo');
        $pos= Caja::where('id_caja',$id_caja)->sum('pos');
        $total=$efectivo+$pos;

        if($efectivo==0 && $pos==0)
        {
            return redirect('caja')->with('message', 'No hay ninguna venta que guardar');
        }

        return view('caja.edit', compact('cajas','pos','efectivo','total'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_caja)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }
        $validatedData = $request->validate([
           
            'caja' => 'required',
            'descripcion' => 'required',
            'pos' => 'required|numeric',
            'caja' => 'required|numeric',
        ]);

        $buscar=Caja::where('id_caja',$id_caja)->first();
        $estado=$buscar->id_estado;
        if($estado==0)
        {
            return redirect('caja')->with('message', 'Caja ya habia sido cerrada');
        }
        DB::beginTransaction();

        try
        {
            $p= request('pos');
            $e= request('caja');
            $pp= request('total_p');
            $ee= request('total_e');
            $tot= $p+$e;
            $total_caja= request('total_caja');

            if($tot>$total_caja){return redirect()->back()->with(['message' => 'ERROR. Datos Ingresados son mayor a Total Vendido', 'alert' => 'alert-danger']);}
            if($p>$pp){return redirect()->back()->with(['message' => 'ERROR. POS Ingresado es  mayor a Total Vendido en POS', 'alert' => 'alert-danger']);}
            if($e>$ee){return redirect()->back()->with(['message' => 'ERROR. Efectivo Ingresado es  mayor a Total Vendido en Efectivo', 'alert' => 'alert-danger']);}
            if($tot==$total_caja){$faltante=0;}
            else{$faltante= $total_caja-$tot;}
           

            $HoraFinal=Carbon::now(); 
            $fecha = Carbon::today(); 
           
            
            $cajas =  Caja::findOrFail($id_caja);
            $cajas-> fechaHora_cierre=$HoraFinal;
            $cajas-> pos=request('total_p');
            $cajas-> efectivo=request('total_e');
            $cajas-> total= request('total_caja');
            $cajas-> id_estado=2;
            $cajas-> faltante= $faltante;
            DB::Commit();
            $cajas->save();

            if($cajas->save())
            {

                $ventas = new Ingreso();
                $ventas-> fecha= $fecha;
                $ventas-> fechaHora= $HoraFinal;
                $ventas-> id_categoria= 2;
                $ventas-> id_tipo= 1;
                $ventas-> descripcion = request ('descripcion');
                $ventas-> total = request('total_caja');
                $ventas-> id_usuario= auth()->user()->id;
               
                DB::Commit();
                $ventas->save();
            }
            $usuario=auth()->user()->name;
            $cajas = Caja::where('id_caja',$id_caja)->first();
            $HoraInicio= $cajas->fechaHora_inicio;
            $total= Factura::where('fechaHora','>=',$HoraInicio)->where('fechaHora','<=',$HoraFinal)->where('id_estado',1)->sum('total');
            $pos=Factura::where('fechaHora','>=',$HoraInicio)->where('fechaHora','<=',$HoraFinal)->where('tipo_pago',2)->sum('total');
            $efectivo=Factura::where('fechaHora','>=',$HoraInicio)->where('fechaHora','<=',$HoraFinal)->where('tipo_pago',1)->sum('total');
            $empresa= DB::table('empresas')->where('id_empresa','1')->first();
            
            $pdf=PDF::loadView('pdf.facturas.caja',compact('p','e','fecha','tot','faltante','usuario','total','HoraInicio','HoraFinal','pos','efectivo','empresa'));
            return $pdf->stream('reporte.pdf');
           //return redirect()->back()->with(['message' => 'La caja fue cerrada con exito', 'alert' => 'alert-success']);
           
        }
        catch(\Exception $e)
        {
            DB::Rollback();
            echo 'Error: ' .$e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
