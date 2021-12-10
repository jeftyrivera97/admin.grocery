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
        $mes="Diciembre";
        $hoy = Carbon::today(); 
        $fecha_inicial="2021-12-01";
        $fecha_final= "2021-12-31";
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
