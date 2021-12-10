<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planilla;
use Illuminate\Support\Facades\DB;
use App\Models\Empleado;
use App\Models\Gasto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PlanillaController extends Controller
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
        
        $planillas = Planilla::where('fecha', '>=','2021-01-01')->where('fecha', '<=',$fecha_final)->orderBy('fecha')->get();
        $planillaMes=Planilla::where('fecha', '>=', $fecha_inicial)->where('fecha', '<=', $fecha_final)->sum('total');
        $planillaAnual=Planilla::where('fecha', '>=',$fechaAno)->where('fecha', '<=',$fecha_final)->sum('total');

        $planillaMes = number_format($planillaMes, 2);
        $planillaAnual = number_format($planillaAnual, 2);

        $total = DB::table('planillas')->sum('total');
        return view('planilla.index', compact('planillas','total','planillaMes','planillaAnual','mes','year'));
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
        $empleados = Empleado::where('id_estado',1)->orderBy('id_empleado')->get();
        return view('planilla.create',compact('empleados'));
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
            'id_empleado' => 'required',
            'total' => 'required',
            
        ]);
        
        try
        {
           
            $codigo = request('id_empleado');
            $empleados= DB::table('empleados')->where('id_empleado',$codigo)->first();
            DB::beginTransaction();

            $planillas = new Planilla();
            $planillas-> fecha = request('fecha');
            $planillas-> id_empleado = request ('id_empleado');
            $planillas-> total = request ('total');
            $planillas-> id_usuario= auth()->user()->id;
         
            DB::Commit();
            $planillas->save();
            $descripcion= "Pago de Planilla a $empleados->nombre";

            if($planillas->save())
            {   
                DB::beginTransaction();
                $gastos = new Gasto();
                $gastos-> fecha = request('fecha');
                $gastos-> codigo_gasto = $empleados->codigo_empleado;
                $gastos-> descripcion = $descripcion;
                $gastos-> total = request ('total');
                $gastos-> id_categoria = 1;
                $gastos-> id_usuario= auth()->user()->id;
                DB::Commit();
                $gastos->save();

                return redirect()->back()->with(['message' => 'Pago guardado con exito', 'alert' => 'alert-success']);
            }
           
        }
        catch(\Exception $e)
        {
            DB::Rollback();
            echo 'Error: ' .$e->getMessage();
            //return redirect()->back()->with(['message' => 'ERROR', 'alert' => 'alert-danger']);
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
