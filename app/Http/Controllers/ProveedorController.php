<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProveedorController extends Controller
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
     
        $proveedores = Proveedor::where('id_estado','1')->orderBy('id_proveedor')->get();
        return view('proveedor.index', compact('proveedores'));
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
        return view('proveedor.create');
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
            'codigo_proveedor' => 'required',
            'descripcion' => 'required',
            'contacto' => 'required',
            
        ]);
        
        $codigo= request('codigo_proveedor');
        $existe= DB::table('proveedores')->where('codigo_proveedor', $codigo)->exists();
        if($existe==true)
        {
            return redirect()->back()->with(['message' => 'ERROR. Proveedor ya existe. Cambie el RTN.', 'alert' => 'alert-danger']);
            
        }
        DB::beginTransaction();

        try
        {
            $proveedores = new Proveedor();
            $proveedores-> codigo_proveedor = request ('codigo_proveedor');
            $proveedores-> descripcion = request ('descripcion');
            $proveedores-> contacto = request ('contacto');
            $proveedores-> telefono = request ('telefono');
            $proveedores-> categoria = request ('categoria');
            $proveedores-> id_estado= 1;
         
            DB::Commit();
            $proveedores->save();
            return redirect()->back()->with(['message' => 'Proveedor creado con exito', 'alert' => 'alert-success']);
        }
        catch(\Exception $e)
        {
            DB::Rollback();
            //echo 'Error: ' .$e->getMessage();
            return redirect()->back()->with(['message' => 'ERROR. Intente cambiar RTN', 'alert' => 'alert-danger']);
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
    public function edit($id_proveedor)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        return view('proveedor.edit', ['proveedores' => Proveedor::findOrFail($id_proveedor)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_proveedor)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }   
        $validatedData = $request->validate([
            'codigo_proveedor' => 'required',
            'descripcion' => 'required',
            'contacto' => 'required',
              
        ]);
        DB::beginTransaction();

        try
        {
            $proveedores =  Proveedor::findOrFail($id_proveedor);
            $proveedores-> codigo_proveedor = request ('codigo_proveedor');
            $proveedores-> descripcion = request ('descripcion');
            $proveedores-> contacto = request ('contacto');
            $proveedores-> categoria = request ('categoria');
            $proveedores-> telefono = request ('telefono');
        
            DB::Commit();
            $proveedores->update();
            return redirect()->back()->with(['message' => 'El proveedor fue actualizado con exito', 'alert' => 'alert-success']);
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
