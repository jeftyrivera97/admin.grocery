<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Pos;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\Transaccion;
use App\Models\Credito;
use App\Models\Caja;
use App\Models\FolioFactura;
use App\Models\FacturaCredito;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Facades\Auth;

class FacturaController extends Controller
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
        $hoy = Carbon::today(); 
        $facturas= Factura::where('id_estado',1)->orderBy('codigo_factura')->where('tipo',1)->get();
        $total= Factura::where('fecha',$hoy)->sum('total');
        return view('factura.index', compact('facturas','total'));
    }

    public function facturasCredito()
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }
      
        $hoy= date("Y-m-d");

        $facturas= Factura::where('id_estado',2)->orderBy('fechaHora')->get();
        $creditos= FacturaCredito::where('id_estado',2)->get();
        $total= FacturaCredito::where('id_estado',2)->sum('saldo');
        return view('factura.creditos', compact('facturas','total','creditos'));
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

       
        if(Caja::where('id_estado', 1)->doesntExist())
        {
            return redirect()->back()->with(['message' => 'ERROR. Caja aun no esta abierta.', 'alert' => 'alert-danger']);
            
        }

        if(FolioFactura::where('id_estado', 1)->doesntExist())
        {
            return redirect()->back()->with(['message' => 'ERROR. No existe un folio activo.', 'alert' => 'alert-danger']);
            
        }
      
        $fecha = Carbon::today(); 
        $productos=Producto::where('id_estado',1)->where('stock','>',0)->get();
        $clientes=Cliente::where('id_estado',1)->get();
        return view('factura.create', compact('fecha','clientes','productos'));
    }

    public function data(Request $request)
    {
        $codigo= request('codigo_producto');
        $noExiste= Producto::where('codigo_producto',$codigo)->doesntExist();
        if($noExiste==true)
        {
            return "NO EXISTE";
            
        }
        $productos=Producto::where('codigo_producto',$codigo)->get();
        return response(json_encode($productos),200)->header('Content-type','text/plain');

    }
    public function ventana()
    {
        return view('modal.create');
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
            'total' => 'required|numeric|min:0',
        ]);

        $tot= request('total');
        $efe= request('efectivo');
        $cam= request('cambio');
        $tipo_pago= request('tipo_pago');
        $tipo_factura="";
        $estado="";
        $tp=0;$tc=0;$ep=0;
        $hora=Carbon::now(); 
        $fecha = Carbon::today(); 
        $id_cliente= request('id_cliente');
        $tipo=0;
        $total_factura= request ('total');
        $descuento= request('descuento');
        $formatter = new NumeroALetras();
        $formatter->conector = 'Y';
        $letras=$formatter->toMoney($total_factura, 2, 'lempiras', 'centavos');

        $impuesto15=0;$impuesto18=0;$exento=0;$gravado15=0;$gravado18=0;
        $linea = $request->input('productos.*.linea_detalles');
        $count = count($linea);
        $impuestos15 = $request->input('productos.*.impuesto15');
        $impuestos18 = $request->input('productos.*.impuesto18');
        $gravados15 = $request->input('productos.*.gravado15');
        $gravados18 = $request->input('productos.*.gravado18');
        $exentos = $request->input('productos.*.exento');
        $codigo_factura=0;

        for ($i = 0; $i<$count; $i++)
        {
            $exento=$exento+$exentos[$i];
            $impuesto15=$impuesto15+$impuestos15[$i];
            $impuesto18=$impuesto18+$impuestos18[$i];
            $gravado15= $gravado15+$gravados15[$i];
            $gravado18= $gravado18+$gravados18[$i];
        }
    
        if($descuento!=0)
        {
            $gravado15= $gravado15-($gravado15*$descuento);
            $gravado18= $gravado18-($gravado18*$descuento);
            $impuesto15= $impuesto15-($impuesto15*$descuento);
            $impuesto18= $impuesto18-($impuesto18*$descuento);
            $exento= $exento-($exento*$descuento);
        }


        if($id_cliente==2 && $tipo_pago=="Credito" )
        {
            return redirect()->back()->with(['message' => 'ERROR. No se puede realizar un credito', 'alert' => 'alert-danger']);
        }
        if($id_cliente==1 && $tipo_pago=="Credito" )
        {
            return redirect()->back()->with(['message' => 'ERROR. No se puede realizar un credito', 'alert' => 'alert-danger']);
        }

        if($tipo_pago=="Credito"){$tp=3;$ep=2;$tc=2;$tipo_factura="Credito";$estado="Sin Pagar"; $efe=0;$cam=0;}
        if($tipo_pago=="Efectivo"){$tp=1;$ep=1;$tc=1;$tipo_factura="Contado";$estado="Pagado";}
        if($tipo_pago=="POS"){$tp=2;$ep=1;$tc=1;$tipo_factura="Contado";$estado="Pagado"; $efe=$tot; $cam=0;}
        
        if($id_cliente==2 && $tipo_factura=="Contado") //CONTADO 2
        {
            $folio= FolioFactura::where('id_estado',1)->first(); 
            $id_folio= $folio->id_folio;
            $codigo_factura=$folio->contador_temp;

            DB::beginTransaction();

            try
            {
           
                $recibos = new Recibo();
                $recibos-> codigo_recibo = $codigo_factura;
                $recibos-> fecha= $fecha;
                $recibos-> fechaHora= $hora;
                $recibos-> id_cliente = request ('id_cliente');
                $recibos-> tipo_pago = $tp;
                $recibos-> id_estado = $ep;
                $recibos-> total=$total_factura;
                $recibos-> id_usuario= auth()->user()->id;
                DB::Commit();
                $recibos->save();

                if($recibos->save())
                {
                    $info=Recibo::where('codigo_recibo',$codigo_factura)->first();
                    $id_factura=$info->id_recibo;

                    $linea = $request->input('productos.*.linea_detalles');
                    $count = count($linea);
                    $codigo = $request->input('productos.*.id_producto');
                    $cantidad = $request->input('productos.*.cantidad');
                    $subtotal = $request->input('productos.*.subtotal');
                    $precio_venta = $request->input('productos.*.precio_venta');
                    
                    
                    for ($i = 0; $i < $count; $i++)
                    {
                        $detalles = new ReciboDetalle();
                        $detalles-> fecha= $fecha;
                        $detalles-> linea= $linea[$i];
                        $detalles-> id_recibo= $id_recibo;
                        $detalles-> id_producto=  $codigo[$i];
                        $detalles-> cantidad= $cantidad[$i];
                        $detalles-> precio_venta= $precio_venta[$i];
                        $detalles-> subtotal=$subtotal[$i];
                        $detalles->save();
                    }

                    for ($i = 0; $i < $count; $i++)
                    {
                        $id_producto=$codigo[$i];
                        $cant=$cantidad[$i];
                        $info = Producto::where('id_producto',$id_producto)->first();
                        $precio_venta= $info->precio_venta;
                        $stock = $info->stock;
        
                        $stockNuevo= $stock-$cant;
                        $valorNuevo= $stockNuevo*$precio_venta;
                        $productos =  Producto::findOrFail($id_producto);
                        $productos-> stock = $stockNuevo;
                        $productos-> valor=$valorNuevo;
                        $productos->update();
                    }

                    $folios =  FolioFactura::findOrFail($id_folio);
                    $folios-> contador_temp = $codigo_factura+1;
                    DB::Commit();
                    $folios->update();
                       
                    $ventas = new Venta();
                    $ventas-> fecha= $fecha;
                    $ventas-> fechaHora= $hora;
                    $ventas-> id_cliente = request ('id_cliente');
                    $ventas-> tipo_pago = $tp;
                    $facturas-> id_estado = $ep;
                    $ventas-> total=$total_factura;
                    $ventas-> id_usuario= auth()->user()->id;
                    DB::Commit();
                    $ventas->save();

                    $t=request('total');
    
                    $inf=Caja::where('id_estado',1)->first();
                    $id_caja= $inf->id_caja;
                    $efectivo= $inf->efectivo;
                    $nuevo_efectivo= $efectivo +$t;
    
                    $cajas =  Caja::findOrFail($id_caja);
                    $cajas-> efectivo= $nuevo_efectivo;
                    DB::Commit();
                    $cajas->save();

                    $info=Recibo::where('codigo_recibo',$codigo_factura)->first();
                    $id_recibo=$info->id_recibo;
                    $articulos=ReciboDetalle::where('id_recibo',$id_recibo)->sum('cantidad');
                
                    $facturas= Recibo::where('id_recibo',$id_recibo)->first();
                    $detalles= ReciboDetalle::where('id_recibo',$id_recibo)->get();
                    $hoy = date("Y-m-d");
                    $empresa= DB::table('empresas')->where('id_empresa','1')->first();

                    $folio= FolioFactura::where('id_estado',1)->first();
                    $pdf=PDF::loadView('pdf.facturas.facturaContado2',compact('efe','cam','articulos','facturas','detalles','hoy','empresa','folio'));
                    return $pdf->stream('facturaImprimir.pdf');
                    
                }
            }
            catch(\Exception $e)
            {
                DB::Rollback();
                echo 'Error: ' .$e->getMessage();
            }
          
           
        }

        if($id_cliente!=2 && $tipo_factura=="Contado") //CONTADO
        {    
            $folio= FolioFactura::where('id_estado',1)->where('tipo',1)->first(); 
            $id_folio= $folio->id_folio;
            $codigo_factura=$folio->contador;

            DB::beginTransaction();

            try
            {
                $facturas = new Factura();
                $facturas-> codigo_factura = $codigo_factura;
                $facturas-> id_folio = $id_folio;
                $facturas-> fecha= $fecha;
                $facturas-> fechaHora= $hora;
                $facturas-> id_cliente = request ('id_cliente');
                $facturas-> tipo_pago = $tp;
                $facturas-> tipo_cuenta = $tc;
                $facturas-> id_estado = $ep;
                $facturas-> descuentos= request('descuento_total');
                $facturas-> exento=$exento;
                $facturas-> gravado15= $gravado15;
                $facturas-> gravado18= $gravado18;
                $facturas-> impuesto15=$impuesto15;
                $facturas-> impuesto18=$impuesto18;
                $facturas-> total=$total_factura;
                $facturas-> tipo=1;
                $facturas-> total_letras= $letras;
                $facturas-> id_usuario= auth()->user()->id;
                DB::Commit();
                $facturas->save();

                if($facturas->save())
                {
                    $ventas = new Venta();
                    $ventas-> fecha= $fecha;
                    $ventas-> fechaHora= $hora;
                    $ventas-> id_cliente = request ('id_cliente');
                    $ventas-> tipo_pago = $tp;
                    $facturas-> id_estado = $ep;
                    $ventas-> total=$total_factura;
                    $ventas-> id_usuario= auth()->user()->id;
                    DB::Commit();
                    $ventas->save();

                    $folios =  FolioFactura::findOrFail($id_folio);
                    $folios-> contador = $codigo_factura+1;
                    DB::Commit();
                    $folios->update();

                    

                    if($tipo_pago=="POS")
                    {
                        $info=Factura::where('codigo_factura',$codigo_factura)->first();
                        $id=$info->id_factura;
        
                        $pos= new Pos();
                        $pos-> codigo_pos= request('codigo_pos');
                        $pos-> id_factura= $id;
                        DB::Commit();
                        $pos->save();

                        $t=request('total');
        
                        $inf=Caja::where('id_estado',1)->first();
                        $id_caja= $inf->id_caja;
                        $pos= $inf->pos;
                        $nuevo_pos= $pos +$t;
        
                        $cajas =  Caja::findOrFail($id_caja);
                        $cajas-> pos= $nuevo_pos;
                        DB::Commit();
                        $cajas->save();
                    }

                    if($tipo_pago=="Efectivo")
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
                    }
                
                    $info=Factura::where('codigo_factura',$codigo_factura)->first();
                    $id_factura=$info->id_factura;

                    $linea = $request->input('productos.*.linea_detalles');
                    $count = count($linea);
                    $codigo = $request->input('productos.*.id_producto');
                    $cantidad = $request->input('productos.*.cantidad');
                    $subtotal = $request->input('productos.*.subtotal');
                    $precio_venta = $request->input('productos.*.precio_venta');
                    
                    
                    for ($i = 0; $i < $count; $i++)
                    {
                        $detalles = new FacturaDetalle();
                        $detalles-> fecha= $fecha;
                        $detalles-> linea= $linea[$i];
                        $detalles-> id_factura= $id_factura;
                        $detalles-> id_producto=  $codigo[$i];
                        $detalles-> cantidad= $cantidad[$i];
                        $detalles-> precio_venta= $precio_venta[$i];
                        $detalles-> subtotal=$subtotal[$i];
                        $detalles->save();
                    }

                    for ($i = 0; $i < $count; $i++)
                    {
                        $id_producto=$codigo[$i];
                        $cant=$cantidad[$i];
                        $info = Producto::where('id_producto',$id_producto)->first();
                        $precio_venta= $info->precio_venta;
                        $stock = $info->stock;
        
                        $stockNuevo= $stock-$cant;
                        $valorNuevo= $stockNuevo*$precio_venta;
                        $productos =  Producto::findOrFail($id_producto);
                        $productos-> stock = $stockNuevo;
                        $productos-> valor=$valorNuevo;
                        $productos->update();
                    }

                    $info=Factura::where('codigo_factura',$codigo_factura)->first();
                    $id_factura=$info->id_factura;
                    $articulos=DB::table('factura_detalles')->where('id_factura',$id_factura)->sum('cantidad');
                
                    $facturas= Factura::where('id_factura',$id_factura)->first();
                    $detalles= FacturaDetalle::where('id_factura',$id_factura)->get();
                    $hoy = date("Y-m-d");
                    $empresa= DB::table('empresas')->where('id_empresa','1')->first();

                    $folio= FolioFactura::where('id_estado',1)->where('tipo',1)->first();
                    $pdf=PDF::loadView('pdf.facturas.facturaContado',compact('efe','cam','articulos','facturas','detalles','hoy','empresa','folio'));
                    return $pdf->stream('facturaImprimir.pdf');
            
                
                }
                    
            }
            catch(\Exception $e)
            {
                DB::Rollback();
                echo 'Error: ' .$e->getMessage();
            }
        
        }

        if($id_cliente!=2 && $tipo_factura=="Credito") //CREDITO
        {
            $codigo_factura=mt_rand(100000, 999999);
            
            try
            {
                $folio= FolioFactura::where('id_estado',1)->where('tipo',1)->first(); 
                $id_folio= $folio->id_folio;

                DB::beginTransaction();

                try
                {
                    $facturas = new Factura();
                    $facturas-> codigo_factura = $codigo_factura;
                    $facturas-> id_folio = $id_folio;
                    $facturas-> fecha= $fecha;
                    $facturas-> fechaHora= $hora;
                    $facturas-> id_cliente = request ('id_cliente');
                    $facturas-> tipo_pago = $tp;
                    $facturas-> tipo_cuenta = $tc;
                    $facturas-> id_estado = $ep;
                    $facturas-> descuentos= request('descuento_total');
                    $facturas-> exento=$exento;
                    $facturas-> gravado15= $gravado15;
                    $facturas-> gravado18= $gravado18;
                    $facturas-> impuesto15=$impuesto15;
                    $facturas-> impuesto18=$impuesto18;
                    $facturas-> total=$total_factura;
                    $facturas-> tipo=0;
                    $facturas-> total_letras= $letras;
                    $facturas-> id_usuario= auth()->user()->id;
                    DB::Commit();
                    $facturas->save();
    
                    if($facturas->save())
                    {
                        $info=Factura::where('codigo_factura',$codigo_factura)->first();
                        $id_factura=$info->id_factura;
    
                        $linea = $request->input('productos.*.linea_detalles');
                        $count = count($linea);
                        $codigo = $request->input('productos.*.id_producto');
                        $cantidad = $request->input('productos.*.cantidad');
                        $subtotal = $request->input('productos.*.subtotal');
                        $precio_venta = $request->input('productos.*.precio_venta');
                        
                        DB::beginTransaction();
                        for ($i = 0; $i < $count; $i++)
                        {
                            $detalles = new FacturaDetalle();
                            $detalles-> fecha= $fecha;
                            $detalles-> linea= $linea[$i];
                            $detalles-> id_factura= $id_factura;
                            $detalles-> id_producto=  $codigo[$i];
                            $detalles-> cantidad= $cantidad[$i];
                            $detalles-> precio_venta= $precio_venta[$i];
                            $detalles-> subtotal=$subtotal[$i];
                            $detalles->save();
                        }
                        DB::Commit();
                        DB::beginTransaction();
                        for ($i = 0; $i < $count; $i++)
                        {
                            $id_producto=$codigo[$i];
                            $cant=$cantidad[$i];
                            $info = Producto::where('id_producto',$id_producto)->first();
                            $precio_venta= $info->precio_venta;
                            $stock = $info->stock;
            
                            $stockNuevo= $stock-$cant;
                            $valorNuevo= $stockNuevo*$precio_venta;
                            $productos =  Producto::findOrFail($id_producto);
                            $productos-> stock = $stockNuevo;
                            $productos-> valor=$valorNuevo;
                            $productos->update();
                        }
                        DB::Commit();
                        DB::beginTransaction();


                        $i= Factura::where('codigo_factura',$codigo_factura)->first();
                        $id_f=$i->id_factura;
        
                        $fcreditos = new FacturaCredito();
                        $fcreditos-> id_factura = $id_f;
                        $fcreditos-> saldo= request('total');
                        $fcreditos-> id_estado= 2;
                        DB::Commit();
                        $fcreditos->save();
        
                        $tipo= "Credito";
                        $id_cliente= request ('id_cliente');
                        $monto= request('total');
                        $fecha = Carbon::today(); 
                        $c = DB::table('creditos')->where('id_cliente',$id_cliente)->first();
                        $saldoActual= $c->saldo;
                        $saldoNuevo= $saldoActual+$monto;
                        
                        DB::beginTransaction();
                        $transacciones =  new Transaccion();
                        $transacciones-> fecha= $fecha;
                        $transacciones-> id_cliente= $c->id_cliente;
                        $transacciones-> tipo_transaccion=$tipo;
                        $transacciones-> total= request('total');
                        $transacciones-> saldo= $saldoNuevo;
                        $transacciones-> descripcion= "Credito Comprobante #$codigo_factura";
                        $transacciones-> id_usuario= auth()->user()->id;
                        DB::Commit();
                        $transacciones->save();
        
                        if($transacciones->save()) 
                        {
                            
                            $info= Credito::where('id_cliente',$id_cliente)->first();
                            $id_credito= $info->id_credito;
        
                            $creditos =  Credito::findOrFail($id_credito);
                            $creditos-> saldo = $saldoNuevo;
                            DB::Commit();
                            $creditos->update();
                            
                            $folio= FolioFactura::where('id_estado',1)->where('tipo',1)->first();
                            $pdf=PDF::loadView('pdf.facturas.facturaCredito',compact('efe','cam','articulos','facturas','detalles','hoy','empresa','folio'));
                            return $pdf->stream('facturaImprimir.pdf');
                        }
                        
                    }
                }
                catch(\Exception $e)
                {
                    DB::Rollback();
                    echo 'Error: ' .$e->getMessage();
                }
  
            }
            catch(\Exception $e)
            {
                DB::Rollback();
                echo 'Error: ' .$e->getMessage();
            }

        }

    }

    public function imprimir($id_factura)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }   

        $articulos=DB::table('factura_detalles')->where('id_factura',$id_factura)->sum('cantidad');
       
        $facturas= Factura::where('id_factura',$id_factura)->first();
        $detalles= FacturaDetalle::where('id_factura',$id_factura)->get();
        $hoy = date("Y-m-d");
        $empresa= DB::table('empresas')->where('id_empresa','1')->first();
        $folio=FolioFactura::where('id_estado',1)->first();

        $pdf=PDF::loadView('pdf.facturas.facturaReimpresion',compact('articulos','facturas','detalles','hoy','empresa','folio'));
        return $pdf->download('facturaImprimir.pdf');
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
    public function edit($id_factura)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        return view('facturas.edit', ['facturas' => Factura::findOrFail($id_factura)]);
    }

    public function actualizar($id_factura)
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

        DB::beginTransaction();

        try
        {
            $folio= FolioFactura::where('id_estado',1)->where('tipo',1)->first();
            $ultimo= $folio->contador;
            $id_folio= $folio->id_folio;
            $codigo_factura=$ultimo+1;
          
            
            $hora=Carbon::now(); 
            $fecha = Carbon::today(); 
            $facturas =  Factura::findOrFail($id_factura);
            $facturas-> codigo_factura = $codigo_factura;
            $facturas-> tipo_pago = 1;
            $facturas-> tipo_cuenta = 1;
            $facturas-> id_estado = 1;
            $facturas-> fechaHora = $hora;
            $facturas-> fecha = $fecha;
            $facturas-> tipo = 1;
            DB::Commit();
            $facturas->update();

            if($facturas->update())
            {
                $folios =  FolioFactura::findOrFail($id_folio);
                $folios-> contador = $codigo_factura;
                DB::Commit();
                $folios->update();
                
                $tipo= "Debito";
                $info= Factura::where('id_factura',$id_factura)->first();
                $id_cliente= $info->id_cliente;
                $monto= $info->total;
                $fecha = Carbon::today();                   
                $c = DB::table('creditos')->where('id_cliente',$id_cliente)->first();
                $saldoActual= $c->saldo;
                $saldoNuevo= $saldoActual-$monto;
                    
                DB::beginTransaction();
                $transacciones =  new Transaccion();
                $transacciones-> fecha= $fecha;
                $transacciones-> id_cliente= $c->id_cliente;
                $transacciones-> tipo_transaccion=$tipo;
                $transacciones-> total= $monto;
                $transacciones-> saldo= $saldoNuevo;
                $transacciones-> descripcion= "Pago de Factura $codigo_factura";
                $transacciones-> id_usuario= auth()->user()->id;
                DB::Commit();
                $transacciones->save();

                if($transacciones->save()) 
                {
                    $info= Credito::where('id_cliente',$id_cliente)->first();
                    $id_credito= $info->id_credito;

                    $creditos =  Credito::findOrFail($id_credito);
                    $creditos-> saldo = $saldoNuevo;
                    DB::Commit();
                   $creditos->update();
                   return redirect()->back()->with(['message' => 'Factura actualizada con exito', 'alert' => 'alert-success']);
                }

            }

           
        }
        catch(\Exception $e)
        {
            DB::Rollback();
            echo 'Error: ' .$e->getMessage();
           // return redirect()->back()->with(['message' => 'ERROR', 'alert' => 'alert-danger']);
        }
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
