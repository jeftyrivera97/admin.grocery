<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Credito;
use App\Models\Transaccion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
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

        $clientes = Cliente::where('id_estado','1')->orderBy('id_cliente')->get();
        return view('cliente.index', compact('clientes'));
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
        return view('cliente.create');
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
            'codigo_cliente' => 'required',
            'nombre' => 'required',
            
        ]);
        $codigo= request('codigo_cliente');
        $existe= DB::table('clientes')->where('codigo_cliente', $codigo)->exists();
        if($existe==true)
        {
            return redirect()->back()->with(['message' => 'ERROR. Cliente ya existe. Cambie el RTN.', 'alert' => 'alert-danger']);
            
        }
        DB::beginTransaction();

        try
        {
            $hora = Carbon::now();
            $clientes = new Cliente();
            $clientes-> codigo_cliente = request ('codigo_cliente');
            $clientes-> nombre = request ('nombre');
            $clientes-> telefono = request ('telefono');
            $clientes-> id_estado = 1;
            DB::Commit();
            $clientes->save();

            if($clientes->save())
            {
               
                $codigo_cliente=request ('codigo_cliente');
                $id= Cliente::where('codigo_cliente',$codigo_cliente)->first();
                DB::beginTransaction(); 
                $creditos= new Credito();
                $creditos-> id_cliente= $id->id_cliente;
                $creditos-> saldo=0;
                DB::Commit();
                $creditos->save();
                return redirect()->back()->with(['message' => 'El cliente fue creado con exito', 'alert' => 'alert-success']);
            }
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
    public function show($codigo_cliente)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        $nombres = DB::table('clientes')->where('codigo_cliente', $codigo_cliente)->first();
        $creditos = Credito::where('codigo_cliente',$codigo_cliente)->get();
        
        return view('cliente.show', compact('creditos','nombres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_cliente)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        return view('cliente.edit', ['clientes' => Cliente::findOrFail($id_cliente)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_cliente)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }   
        $validatedData = $request->validate([
            'nombre' => 'required',
            
        ]);
        

        DB::beginTransaction();

        try
        {
            $clientes =  Cliente::findOrFail($id_cliente);
            $clientes-> nombre = request ('nombre');
            $clientes-> telefono = request ('telefono');
           

            DB::Commit();
            $clientes->update();
            return redirect()->back()->with(['message' => 'El cliente fue actualizado exito', 'alert' => 'alert-success']);
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
