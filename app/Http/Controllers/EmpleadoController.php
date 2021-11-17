<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EmpleadoController extends Controller
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
     
        $empleados = Empleado::where('id_estado','1')->orderBy('id_empleado')->get();
        return view('empleado.index', compact('empleados'));
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
     
        return view('empleado.create');
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
            'codigo_empleado' => 'required',
            'nombre' => 'required',
            'puesto' => 'required',
        ]);
        
        $codigo= request('codigo_empleado');
        $existe= DB::table('empleados')->where('codigo_empleado', $codigo)->exists();
        if($existe==true)
        {
            return redirect()->back()->with(['message' => 'ERROR. Empleado ya existe. Cambie Identidad.', 'alert' => 'alert-danger']);
            
        }
        DB::beginTransaction();

        try
        {
            $empleados = new Empleado();
            $empleados-> codigo_empleado = request ('codigo_empleado');
            $empleados-> nombre = request ('nombre');
            $empleados-> puesto = request ('puesto');
            $empleados-> telefono = request ('telefono');
            $empleados-> id_estado= 1;
         
            DB::Commit();
            $empleados->save();
            return redirect()->back()->with(['message' => 'Empleado creado con exito', 'alert' => 'alert-success']);
        }
        catch(\Exception $e)
        {
            DB::Rollback();
            //echo 'Error: ' .$e->getMessage();
            return redirect()->back()->with(['message' => 'ERROR', 'alert' => 'alert-danger']);
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
    public function edit($id_empleado)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        return view('empleado.edit', ['empleados' => Empleado::findOrFail($id_empleado)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_empleado)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }   
        $validatedData = $request->validate([
            'nombre' => 'required',
            'puesto' => 'required',
        ]);
       
     
        DB::beginTransaction();

        try
        {
            $empleados =  Empleado::findOrFail($id_empleado);
            $empleados-> codigo_empleado = request ('codigo_empleado');
            $empleados-> nombre = request ('nombre');
            $empleados-> puesto = request ('puesto');
            $empleados-> telefono = request ('telefono');
         
            DB::Commit();
            $empleados->update();
            return redirect()->back()->with(['message' => 'Empleado actualizado con exito', 'alert' => 'alert-success']);
        }
        catch(\Exception $e)
        {
            DB::Rollback();
            //echo 'Error: ' .$e->getMessage();
            return redirect()->back()->with(['message' => 'ERROR', 'alert' => 'alert-danger']);
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
