<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
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
      
        $empresas = Empresa::where('id_empresa','1')->first();
     
      
        return view('empresa.index', compact('empresas'));
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
        
        $empresas = Empresa::where('id_empresa','1')->first();
     
      
        return view('empresa.create', compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $id_empresa= request('id_empresa');
            DB::beginTransaction();
          $empresas= request('id_empresa');
          $empresas =  Empresa::findOrFail($id_empresa);
          $empresas-> descripcion = request('descripcion');
          $empresas-> direccion = request('direccion');
          $empresas-> razon_social = request('razon_social');
          $empresas-> telefono = request('telefono');
          $empresas-> correo = request('correo');
          $empresas-> cai = request('cai');

          DB::Commit();
          $empresas->update();
    
          return redirect()->back()->with(['message' => 'Los cambios fueron guardados con exito', 'alert' => 'alert-success']);
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
