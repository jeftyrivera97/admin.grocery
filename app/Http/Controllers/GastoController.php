<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Gasto;
use App\Models\GastoCategoria;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GastoController extends Controller
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
       
        $mes="Noviembre";
        $hoy = Carbon::today(); 
        $fecha_inicial="2021-11-01";
        $fecha_final= "2021-11-30";
        $fechaAno="2021-01-01";
        $year="2021";
       
        $gastos = Gasto::where('fecha', '>=','2021-01-01')->where('fecha', '<=',$fecha_final)->orderBy('fecha')->get();
        $gastosMes=Gasto::where('fecha', '>=',$fecha_inicial)->where('fecha', '<=',$fecha_final)->sum('total');
        $gastosAnual=Gasto::where('fecha', '>=',$fechaAno)->where('fecha', '<=',$fecha_final)->sum('total');

        $gastosMes = number_format($gastosMes, 2);
        $gastosAnual = number_format($gastosAnual, 2);
       
        return view('gasto.index', compact('gastos','gastosAnual','gastosMes','mes','year'));
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
        $categorias = GastoCategoria::where('id_estado',1)->get();
        return view('gasto.create', compact('categorias'));
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
            'id_categoria' => 'required',
            'fecha' => 'required',
            'total' => 'required',
            'referencia' => 'required',
           
        ]);
        $codigo= request('referencia');
        $existe= DB::table('gastos')->where('codigo_gasto', $codigo)->exists();
      

        DB::beginTransaction();

        try
        {
            $total=request('total');
            $im=0.15;
            $impuesto= $total*$im;
            $importe= $total-$impuesto;

            $gastos = new Gasto();
            $gastos-> fecha = request ('fecha');
            $gastos-> codigo_gasto = request ('referencia');
            $gastos-> descripcion = request ('descripcion');
            $gastos-> total = $total;
            $gastos-> id_categoria = request ('id_categoria');
            $gastos-> id_usuario= auth()->user()->id;
           
            DB::Commit();
            $gastos->save();
            return redirect()->back()->with(['message' => 'El gasto fue creado con exito', 'alert' => 'alert-success']);


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
    public function show($id_gasto)
    {
        return view('gasto.show', ['gastos' => Gasto::findOrFail($id_gasto)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_gasto)
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
