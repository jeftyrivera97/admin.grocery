<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Pintado;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
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
        
        $ventas = Venta::all();
        $clientes = Cliente::where('id_estado',1)->get();

        $ventasAnual=DB::table('ventas')->sum('total');
        $ventasMes=Venta::where('fecha', '>=',$fecha_inicial)->where('fecha', '<=',$fecha_final)->sum('total');

        $ventasAnual = number_format($ventasAnual, 2);
        $ventasMes = number_format($ventasMes, 2);
     
        return view('venta.index', compact('ventas','ventasAnual','clientes','hoy','ventasMes','mes'));
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
      
        $fecha = date("Y-m-d");
        return view('venta.create', compact('fecha'));
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
           
            
            'total' => 'required|numeric|min:0',
          
            
        ]);
        DB::beginTransaction();

        try
        {
            
            $hora=now()->toDateTimeString('Y-m-d  H:i:s');
            $fecha = date("Y-m-d");
            
            $ventas = new Venta();
            $ventas-> total = request ('total');
            $ventas-> descripcion = request ('descripcion');
            $ventas-> fecha= $fecha;
            $ventas-> fechaHora= $hora;
            $ventas-> id_usuario= auth()->user()->id;
           
          
            DB::Commit();
            $ventas->save();
           // return redirect('/producto');
           return redirect()->back()->with(['message' => 'El Ingreso fue creado con exito', 'alert' => 'alert-success']);
           
        }
        catch(\Exception $e)
        {
            DB::Rollback();
            echo 'Error: ' .$e->getMessage();
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
