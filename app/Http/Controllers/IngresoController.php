<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso;
use App\Models\Auto;
use App\Models\Pintado;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\PintadoIngreso;
use App\Models\IngresoCategoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mes="Noviembre";
        $hoy = Carbon::today(); 
        $fecha_inicial="2021-11-01";
        $fecha_final= "2021-11-30";
        $fechaAno="2021-01-01";
        $year="2021";
        
        $ventas = Ingreso::all();
        $clientes = Cliente::where('id_estado',1)->get();

        $ventasAnual=Ingreso::sum('total');
        $ventasMes=Ingreso::where('fecha', '>=',$fecha_inicial)->where('fecha', '<=',$fecha_final)->sum('total');

        $ventasAnual = number_format($ventasAnual, 2);
        $ventasMes = number_format($ventasMes, 2);
     
        return view('ingreso.index', compact('ventas','ventasAnual','clientes','hoy','ventasMes','mes','year'));
    }

    public function verServicios()
    {
        $mes="Agosto";
        $hoy = Carbon::today(); 
        $fecha_inicial="2021-08-01";
        $fecha_final= "2021-08-31";
        $fechaAno="2021-01-01";
        $year="2021";
        
        $categorias= IngresoCategoria::where('id_estado',1)->get();
        $ingresos = Ingreso::where('fecha', '>=','2021-01-01')->where('fecha', '<=',$fecha_final)->where('id_categoria',1)->get();
        $ingresosAnual=Ingreso::where('fecha', '>=',$fechaAno)->where('fecha', '<=',$fecha_final)->where('id_categoria',1)->sum('total');
        $ingresosMes=Ingreso::where('fecha', '>=',$fecha_inicial)->where('fecha', '<=',$fecha_final)->where('id_categoria',1)->sum('total');
        $ingresosAnual = number_format($ingresosAnual, 2);
        $ingresosMes = number_format($ingresosMes, 2);
     
        return view('ingreso.indexServicios', compact('ingresos','ingresosAnual','hoy','ingresosMes','mes','year','categorias'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function ejecutar()
    {
        $ingresos=Ingreso::all();
        
        foreach($ingresos as $ingreso)
        {
            DB::beginTransaction();
            $ingresosP = new PintadoIngreso();
            $ingresosP-> id_ingreso= $ingreso->id_ingreso;
            $ingresosP-> id_pintado= 1;
            DB::Commit();
            $ingresosP->save();
        }

        return redirect('ingreso')->with('message', 'Ingresados!!!!!!!');

    }

    public function crear(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }
        $id_categoria= request('id_categoria');

        $categorias=IngresoCategoria::where('id',$id_categoria)->first();
        $autos=Auto::where('id_estado',1)->get();
        $servicios=Servicio::where('id_estado',1)->get();

        if($id_categoria!=1){
            return view('ingreso.create',compact('categorias','autos','servicios'));

        }
        if($id_categoria=1)
        {
            return view('ingreso.crearServicio',compact('categorias','autos','servicios'));

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
        $hora=Carbon::now(); 

        try
        {
            DB::beginTransaction();
        
            $ingresos = new Ingreso();
            $ingresos-> fecha= request ('fecha');
            $ingresos-> fechaHora= $hora;
            $ingresos-> id_categoria = request ('id_categoria');
            $ingresos-> descripcion =request ('descripcion');
            $ingresos-> total =request ('total');
            $ingresos-> id_usuario= auth()->user()->id;
            DB::Commit();
            $ingresos->save();
           

            return redirect('ingreso')->with('message', 'Ingreso creado con exito');
            
        }
        catch(\Exception $e)
        {
            DB::Rollback();
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function guardar(Request $request)
    {

        $hora=Carbon::now(); 
        DB::beginTransaction();
           try
            {  

                $cliente= request('nombre_cliente');
                if( $existe= Cliente::where('nombre',$cliente)->exists())
                {
                    $buscar= Cliente::where('nombre',$cliente)->first();
                    $id_cliente= $buscar->id_cliente;
                }
                else{
                    DB::beginTransaction();
                    $clientes = new Cliente();
                    $clientes-> codigo_cliente= rand(1,1000);
                    $clientes-> nombre = $cliente;
                    $clientes-> id_estado = 1;           
                    DB::Commit();
                    $clientes->save();
                    $id_cliente=$clientes->id_cliente;
                }

                $pintados = new Pintado();
                $pintados-> fecha = request ('fecha');
                $pintados-> fecha_ingreso = request ('fecha_ingreso');
                $pintados-> fecha_salida = request ('fecha_salida');
                $pintados-> id_auto = request ('id_auto');
                $pintados-> id_cliente = $id_cliente;
                $pintados-> id_servicio = request ('id_servicio');
                $pintados-> descripcion = request ('labor');
                $pintados-> color = request ('color');
                $pintados-> placa = request ('placa');
                $pintados-> año = request ('año');
                $pintados-> id_estado = 4;
                $pintados-> id_usuario= auth()->user()->id;
                DB::Commit();
                $pintados->save();
                $id_pintado=$pintados->id_pintado;
               
                DB::beginTransaction();
                $ingresos = new Ingreso();
                $ingresos-> fecha= request ('fecha');
                $ingresos-> fechaHora= $hora;
                $ingresos-> id_categoria = request ('id_categoria');
                $ingresos-> descripcion =request ('descripcion');
                $ingresos-> total =request ('total');
                $ingresos-> id_usuario= auth()->user()->id;
                DB::Commit();
                $ingresos->save();
                $id_ingreso=$ingresos->id_ingreso;
               
                DB::beginTransaction();
                $ingresoPintado = new PintadoIngreso();
                $ingresoPintado-> id_pintado= $id_pintado;  
                $ingresoPintado-> id_ingreso= $id_ingreso;
               
                DB::Commit();
                $ingresoPintado->save();  

                return redirect('ingreso')->with('message', 'Ingreso creado con exito');
                
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
