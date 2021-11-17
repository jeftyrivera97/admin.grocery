<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FolioFactura;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FolioFacturaController extends Controller
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

        $folios = FolioFactura::where('id_estado',1)->where('tipo',1)->get();
        return view('folio.index', compact('folios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (FolioFactura::where('id_estado',1)->exists()) {
            return redirect()->back()->with(['message' => 'Ya existe un Folio Activo!', 'alert' => 'alert-danger']);
        }else{
            return view('folio.create');
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
        try
        {

            DB::beginTransaction();
            $folios = new FolioFactura();
            $folios-> inicio = request ('inicio');
            $folios-> final = request ('final');
            $folios-> fecha_inicial = request ('fecha_inicial');
            $folios-> fecha_final = request ('fecha_final');
            $folios-> contador =request ('inicio');
            $folios-> tipo = 1;
            $folios-> id_estado = 1;
            DB::Commit();
            $folios->save();

            DB::beginTransaction();
            $folios = new FolioFactura();
            $folios-> inicio = request ('inicio');
            $folios-> final = request ('final');
            $folios-> fecha_inicial = request ('fecha_inicial');
            $folios-> fecha_final = request ('fecha_final');
            $folios-> contador =request ('inicio');
            $folios-> tipo = 0;
            $folios-> id_estado = 1;
            DB::Commit();
            $folios->save();

            return redirect('folio')->with(['message' => 'Folio activado con exito!', 'alert' => 'alert-success']);
         
            

        }
        catch(\Exception $e)
        {
            DB::Rollback();
            echo 'Error: ' .$e->getMessage();
          // return redirect()->back()->with(['message' => 'ERROR. Intente cambiar Codigo', 'alert' => 'alert-danger']);
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
