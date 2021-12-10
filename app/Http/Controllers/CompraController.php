<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Pedido;
use App\Models\CompraCategoria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
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

        $mes="Diciembre";
        $hoy = Carbon::today(); 
        $fecha_inicial="2021-12-01";
        $fecha_final= "2021-12-31";
        $fechaAno="2021-01-01";
        $year="2021";

        $comprasMes= Compra::where('fecha', '>=',$fecha_inicial)->where('fecha', '<=',$fecha_final)->sum('total');
        $comprasCredito=Compra::where('fecha', '>=',$fecha_inicial)->where('fecha', '<=',$fecha_final)->where('id_estado', 2)->sum('total');
        $comprasAnual = Compra::where('tipo_cuenta',1)->where('fecha', '>=',$fechaAno)->where('fecha', '<=',$fecha_final)->sum('total');
        $compras = Compra::where('fecha', '>=','2021-01-01')->where('fecha', '<=',$fecha_final)->orderBy('fecha')->get();

        $comprasMes = number_format($comprasMes, 2);
        $comprasCredito = number_format($comprasCredito, 2);
        $comprasAnual = number_format($comprasAnual, 2);
        
        return view('compra.index', compact('compras','comprasMes','comprasCredito','comprasAnual','hoy','mes','year'));
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
        $proveedores=Proveedor::where('id_estado','1')->get();
        $categorias = CompraCategoria::where('id_estado',1)->get();
        return view('compra.create',compact('proveedores','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }   
        $validatedData = $request->validate([
            'codigo_compra' => 'required',
            'id_categoria' => 'required',
            'fecha' => 'required',
            'total' => 'required|numeric|min:1',
            'id_proveedor' => 'required',
            'tipo' => 'required'
            
        ]);

        $codigo= request('codigo_compra');
        $existe= DB::table('compras')->where('codigo_compra', $codigo)->exists();
        if($existe==true)
        {
            return redirect()->back()->with(['message' => 'ERROR. Compra ya existe. Cambie el #Factura.', 'alert' => 'alert-danger']);
            
        }

        $tipo=request('tipo');
        $fechaPago=request('fecha_pago');

        if($tipo=="Contado")
        {
            $tipo_cuenta=1;
            $estado= 1;

        }else{
            $tipo_cuenta=2;
            $estado= 2;
            if($fechaPago=="")
            {
                return redirect()->back()->with(['message' => 'ERROR. Debe agregar FECHA DE PAGO cuando es un CREDITO.', 'alert' => 'alert-danger']);
            }
        }
        $exento=request('exento');
        $gravado15=request('gravado15');
        $gravado18=request('gravado18');
        $impuesto15=request('impuesto15');
        $impuesto18=request('impuesto18');
        if($exento==""){$exento=0;}
        if($gravado15==""){$gravado15=0;}
        if($gravado18==""){$gravado18=0;}
        if($impuesto15==""){$impuesto15=0;}
        if($impuesto18==""){$impuesto18=0;}
      
        $total=request('total');

        if($exento+$gravado15+$gravado18+$impuesto15+$impuesto18>$total)
        {
            return redirect()->back()->with(['message' => 'ERROR. Los datos ingresados no igualan al total.', 'alert' => 'alert-danger']);
        }
        
        DB::beginTransaction();

        try
        {
            $id_proveedor=request ('id_proveedor');
            $nombre = DB::table('proveedores')->where('id_proveedor',$id_proveedor)->first();

            $compras = new Compra();
            $compras-> codigo_compra = request ('codigo_compra');
            $compras-> tipo_cuenta = $tipo_cuenta;
            $compras-> id_estado = $estado;
            $compras-> fecha = request ('fecha');
            $compras-> fecha_pago = request ('fecha_pago');
            $compras-> id_categoria = request ('id_categoria');
            $compras-> id_proveedor = request ('id_proveedor');
            $compras-> exento = $exento;
            $compras-> gravado15 = $gravado15;
            $compras-> gravado18 = $gravado18;
            $compras-> impuesto15 = $impuesto15;
            $compras-> impuesto18 = $impuesto18;
            $compras-> total = request ('total');
            $compras-> id_usuario= auth()->user()->id;
          


            DB::Commit();
            $compras->save();
            return redirect()->back()->with(['message' => 'La compra fue creada con exito', 'alert' => 'alert-success']);


        }
        catch(\Exception $e)
        {
            DB::Rollback();
            echo 'Error: ' .$e->getMessage();
           // return redirect()->back()->with(['message' => 'ERROR. Intente cambiar #Factura', 'alert' => 'alert-danger']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_compra)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        return view('compra.show', ['compras' => Compra::findOrFail($id_compra)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_compra)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        return view('compra.edit', ['compras' => Compra::findOrFail($id_compra)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_compra)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        $validatedData = $request->validate([
           
            'estado' => 'required',
          
        ]);
        DB::beginTransaction();

        try
        {
            $compras =  Compra::findOrFail($id_compra);
            $compras-> id_estado = request ('estado');
            $compras-> tipo_cuenta = 1;
            DB::Commit();
            $compras->update();
             return redirect()->back()->with(['message' => 'La compra fue actualizada con exito', 'alert' => 'alert-success']);
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
