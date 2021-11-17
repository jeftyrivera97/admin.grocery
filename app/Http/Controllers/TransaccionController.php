<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Credito;
use App\Models\Transaccion;
use App\Models\Factura;
use App\Models\Caja;
use App\Models\Contador;
use App\Models\FacturaCredito;
use App\Models\FolioFactura;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransaccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $clientes= Cliente::where('id_estado','1')->orderBy('id_cliente')->get();
        return view('transaccion.create', compact('clientes'));
    }


    public function crear($id_factura)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        $noExiste= DB::table('cajas')->where('id_estado', 1)->doesntExist();
        if($noExiste==true)
        {
            return redirect()->back()->with(['message' => 'ERROR. Caja aun no esta abierta.', 'alert' => 'alert-danger']);
            
        }

        $facturas= Factura::where('id_factura',$id_factura)->first();
        $creditos= FacturaCredito::where('id_factura',$id_factura)->first();
        $saldo= $creditos->saldo;
        return view('transaccion.crear', compact('facturas','saldo'));
    }

    public function guardar(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }   
        $validatedData = $request->validate([
            'total' => 'required|numeric|min:1',
            
        ]);

        try
        {
            
            $id_cliente= request ('id_cliente');
            $monto= request('total');
            $fecha = Carbon::today(); 
            $fechaHora = Carbon::now(); 
           

            $factura= request('id_factura');
            $inf= Factura::where('id_factura',$factura)->first();
            $id_factura= $inf->id_factura;
            $codigo_factura= $inf->codigo_factura;
            $total_factura= $inf->total;
            $tipo;

            $facturaCreditos= FacturaCredito::where('id_factura',$id_factura)->first();
            $saldoFactura= $facturaCreditos->saldo;

            $c = Credito::where('id_cliente',$id_cliente)->first();
            $saldoActual= $c->saldo;
            $id_credito= $c->id_credito;

            $saldoNuevo=$saldoActual-$monto;


            if($monto>$saldoFactura)
            {
                return redirect()->back()->with(['message' => 'ERROR. Monto de Abono es mayor al saldo de la Factura.', 'alert' => 'alert-danger']);
            }

            if($monto==$saldoFactura)
            {
                $descripcion="Debito PAGO TOTAL Comprobante #$codigo_factura";
                $tipo=1;
            }

            if($monto<$saldoFactura)
            {
                $descripcion="Debito PAGO PARCIAL Comprobante #$codigo_factura";
                $tipo=0;
            }           
            
            DB::beginTransaction();
            $transacciones =  new Transaccion();
            $transacciones-> fecha= $fechaHora;
            $transacciones-> id_cliente= $id_cliente;
            $transacciones-> tipo_transaccion= "Debito";
            $transacciones-> total= request('total');
            $transacciones-> saldo= $saldoNuevo;
            $transacciones-> descripcion= $descripcion;
            $transacciones-> id_usuario= auth()->user()->id;
            DB::Commit();
            $transacciones->save();

            if($tipo==1)
            {  

                $folio= FolioFactura::where('id_estado',1)->first();
                $ultimo= $folio->contador;
                $id_folio= $folio->id_folio;
                $codigo_factura=$ultimo+1;

                $facturas =  Factura::findOrFail($id_factura);
                $facturas-> codigo_factura = $codigo_factura;
                $facturas-> tipo_pago = 1;
                $facturas-> tipo_cuenta = 1;
                $facturas-> id_estado = 1;
                $facturas-> fechaHora = $fechaHora;
                $facturas-> fecha = $fecha;
                $facturas-> tipo = $tipo;
                DB::Commit();
                $facturas->update();

                $folios =  FolioFactura::findOrFail($id_folio);
                $folios-> contador = $codigo_factura;
                DB::Commit();
                $folios->update();

                $i= FacturaCredito::where('id_factura',$id_factura)->first();
                $idfc= $i->id_facturaCredito;

                $fcreditos= FacturaCredito::findOrFail($idfc);
                $fcreditos-> saldo = 0;
                $fcreditos-> id_estado = 1;
                DB::Commit();
                $fcreditos->save();
            }

            if($tipo==0)
            {

                $i= FacturaCredito::where('id_factura',$id_factura)->first();
                $idfc= $i->id_facturaCredito;
                $saldoF= $i->saldo;
                $pago= request('total');
                $nuevoSaldo= $saldoF-$pago;

                $fcreditos= FacturaCredito::findOrFail($idfc);
                $fcreditos-> saldo = $nuevoSaldo;
                DB::Commit();
                $fcreditos->save();
            }
           

            if($transacciones->save()) 
            {
                $t=request('total');
    
                $inf=Caja::where('id_estado',1)->first();
                $id_caja= $inf->id_caja;
                $efectivo= $inf->efectivo;
                $nuevo_efectivo= $efectivo +$t;

                $cajas =  Caja::findOrFail($id_caja);
                $cajas-> efectivo= $nuevo_efectivo;
                DB::Commit();
                $cajas->save();

                $creditos =  Credito::findOrFail($id_credito);
                $creditos-> saldo = $saldoNuevo;
                 DB::Commit();
                 $creditos->update();
                 return redirect('facturas/creditos')->with('message', 'Abono creado con exito');
               
            }
            
        }
        catch(\Exception $e)
        {
            DB::Rollback();
            echo 'Error: ' .$e->getMessage();
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
        if(!Auth::check())
        {
            return redirect('/login');
        }   
        $validatedData = $request->validate([
            'id_cliente' => 'required',
            'total' => 'required|numeric|min:1',
            'tipo' => 'required', 
            'descripcion' => 'required', 
        ]);

        try
        {
            $fecha=Carbon::now(); 
            $tipo= request('tipo');
            $id_cliente= request ('id_cliente');
            $monto= request('total');
            $c = DB::table('creditos')->where('id_cliente',$id_cliente)->first();
            $saldoActual= $c->saldo;
       
            if($tipo=="Credito")
            {
                $saldoNuevo= $saldoActual+$monto;
            }else{
                $saldoNuevo= $saldoActual-$monto;

                if($saldoNuevo<0)
                {
                    return redirect()->back()->with(['message' => 'ERROR. Monto de Abono resulta en un saldo menor a 0.', 'alert' => 'alert-danger']);
                }
            }
            
            DB::beginTransaction();
            $transacciones =  new Transaccion();
            $transacciones-> fecha= $fecha;
            $transacciones-> id_cliente= $c->id_cliente;
            $transacciones-> tipo_transaccion=$tipo;
            $transacciones-> total= request('total');
            $transacciones-> saldo= $saldoNuevo;
            $transacciones-> descripcion= request('descripcion');
            $transacciones-> id_usuario= auth()->user()->id;
            DB::Commit();
            $transacciones->save();

            if($transacciones->save()) {
                
                $info= Credito::where('id_cliente',$id_cliente)->first();
                $id_credito= $info->id_credito;

                $creditos =  Credito::findOrFail($id_credito);
                $creditos-> saldo = $saldoNuevo;
                 DB::Commit();
                 $creditos->update();

                 return redirect()->back()->with(['message' => 'Transaccion realizada exitosamente', 'alert' => 'alert-success']);
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
    public function show($id_cliente)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 

        if($id_cliente==1){return redirect()->back()->with(['message' => 'No se puede acceder. ', 'alert' => 'alert-danger']);}

        $nombres = DB::table('clientes')->where('id_cliente', $id_cliente)->first();
        $creditos = Credito::where('id_cliente',$id_cliente)->first();
        $transacciones =Transaccion::where('id_cliente',$creditos->id_cliente)->get();
        return view('transaccion.show', compact('creditos','nombres','transacciones'));

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
