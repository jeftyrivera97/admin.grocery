<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CompraCategoria;
use App\Models\GastoCategoria;
use App\Models\Ingreso;
use App\Models\Compra;
use App\Models\Gasto;
use App\Models\Planilla;
use App\Models\Producto;
use App\Models\Empresa;
use App\Models\Pedido;
use App\Models\FacturaCredito;
use App\Models\Proveedor;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ComprasExport;
use App\Exports\VentasExport;
use App\Exports\FacturasExport;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{

    public function ventaPdf()
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }
       
        return view('reporte.pdf.ventas');
    }

    public function exportVentaDia(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        $validatedData = $request->validate([
            'fecha' => 'required', 
        ]);
        $buscar= request ('fecha');
        $Noexiste= DB::table('ingresos')->where('fecha', $buscar)->doesntExist();
        if($Noexiste==true)
        {
            return redirect()->back()->with(['message' => 'No existen registros para esta fecha.', 'alert' => 'alert-danger']);
            
        }
        $hoy = Carbon::now();
        $fecha= request ('fecha');
        $ventas = Ingreso::where('fecha', '>=', $fecha)->where('id_categoria',1)->orderBy('fechaHora')->get();
        $total = DB::table('ingresos')->where('fecha', $fecha)->sum('total');
        $empresa= DB::table('empresas')->where('id_empresa','1')->first();
        $total= number_format($total, 2);
        
        $pdf=PDF::loadView('pdf.ventas.ventaDia',compact('ventas','total','hoy','empresa','fecha'));
        $pdf->setPaper('Letter', 'landscape');
        return $pdf->download("Ingresos Periodo $fecha.pdf");
    }
    
    public function exportVentaRango(Request $request)
    {  if(!Auth::check())
        {
            return redirect('/login');
        } 
        $validatedData = $request->validate([
            'fecha_inicial' => 'required', 
            'fecha_final' => 'required', 
        ]);
        $fechaInicial= request ('fecha_inicial');
        $fechaFinal= request ('fecha_final');
        $Noexiste= DB::table('ingresos')->where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->doesntExist();
        if($Noexiste==true)
        {
            return redirect()->back()->with(['message' => 'No existen registros para esta fecha.', 'alert' => 'alert-danger']);
            
        }

        $hoy = Carbon::now();
        $empresa= DB::table('empresas')->where('id_empresa','1')->first();
        $fechaInicial= request ('fecha_inicial');
        $fechaFinal= request ('fecha_final');
        $total = Ingreso::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->sum('total');

        $ventas = Ingreso::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->where('id_categoria',1)->orderBy('fechaHora')->get();
        $total= number_format($total, 2);

        
        $pdf=PDF::loadView('pdf.ventas.ventaRango',compact('ventas','total','hoy','empresa','fechaInicial','fechaFinal'));
        $pdf->setPaper('Letter', 'landscape');
        return $pdf->download("Ingresos Periodo $fechaInicial al $fechaFinal.pdf");
    }


    public function compraPdf()
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }
       
        return view('reporte.pdf.compras');
    }

    public function exportCompraDia(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        $validatedData = $request->validate([
            'fecha' => 'required', 
        ]);
        $buscar= request ('fecha');
        $Noexiste= DB::table('compras')->where('fecha', $buscar)->doesntExist();
        if($Noexiste==true)
        {
            return redirect()->back()->with(['message' => 'No existen registros para esta fecha.', 'alert' => 'alert-danger']);
            
        }

        $hoy = Carbon::now();
        $empresa= DB::table('empresas')->where('id_empresa','1')->first();
        $fecha= request ('fecha');
        
        $compras = Compra::where('fecha',$fecha)->orderBy('fecha')->get();
        $total=DB::table('compras')->where('fecha',$fecha)->sum('total');
        
        
        $isv=$total*0.15;
        $gravado= $total-$isv;
        $gravado= number_format($gravado, 2);
        $isv= number_format($isv, 2);
        $total= number_format($total, 2);

        $pdf=PDF::loadView('pdf.compras.compraDia',compact('compras','hoy','empresa','total','fecha','gravado','isv'));
        $pdf->setPaper('Letter', 'landscape');
        return $pdf->download("Compras Periodo $fecha.pdf");
    }
    
    public function exportCompraRango(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        $validatedData = $request->validate([
            'fecha_inicial' => 'required', 
            'fecha_final' => 'required', 
        ]);
        $fechaInicial= request ('fecha_inicial');
        $fechaFinal= request ('fecha_final');
        $Noexiste= DB::table('compras')->where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->doesntExist();
        if($Noexiste==true)
        {
            return redirect()->back()->with(['message' => 'No existen registros para esta fecha.', 'alert' => 'alert-danger']);
            
        }

        $hoy = Carbon::now();
        $empresa= DB::table('empresas')->where('id_empresa','1')->first();
        $fechaInicial= request ('fecha_inicial');
        $fechaFinal= request ('fecha_final');
        
        $compras = Compra::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->orderBy('fecha')->get();
        $total = Compra::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->sum('total');
        
        $pagadas=Compra::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->where('id_estado',1)->sum('total');
        $porPagar=Compra::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->where('id_estado',2)->sum('total');
        $efectivo=Compra::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->where('tipo_cuenta',1)->sum('total'); 
        $credito=Compra::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->where('tipo_cuenta',2)->sum('total');                              
        
        $encontrados=[];
        $categorias= CompraCategoria::all();
        $contador= count($categorias);
        
        for($i=0; $i<$contador; $i++)
        {
           $id= $categorias[$i]->id;
           $d= $categorias[$i]->descripcion;
           
           $total= Compra::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->sum('total');
           $totalCompra= Compra::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->where('id_categoria',$id)->sum('total');
           $p= ($totalCompra*100)/$total;
           $p = number_format($p, 2, '.', '');
           $descripcion= "$d | % de Categoria: $p%";   
           $encontrados[$i] = Arr::add(['descripcion' => $descripcion], 'total', $totalCompra);
               

        }
        $columns = array_column($encontrados, 'total');
        array_multisort($columns, SORT_DESC, $encontrados);
        $comprasProveedor= Compra::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->orderBy('id_proveedor')->get();
        $proveedores= Proveedor::all();
        $proveedoresE=[];
        $contador= count($proveedores);
        $p= 0;
        
        for($i=0; $i<$contador; $i++)
        {
           $id= $proveedores[$i]->id_proveedor;
           $d= $proveedores[$i]->descripcion;
           
           $cantidad= Compra::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->where('id_proveedor',$id)->sum('total');
           $p= ($cantidad*100)/$total;
           $p = number_format($p, 2, '.', '');
           $descripcion= "$d | % de Proveedor: $p%";
           $proveedoresE[$i] = Arr::add(['descripcion' => $descripcion], 'total', $cantidad);

        }
        $columns = array_column($proveedoresE, 'total');
        array_multisort($columns, SORT_DESC, $proveedoresE);

      
        $gravado= Compra::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->sum('gravado15');
        $isv= Compra::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->sum('impuesto15');
        $gravado= number_format($gravado, 2);
        $isv= number_format($isv, 2);
        $total= number_format($total, 2);



        $pdf=PDF::loadView('pdf.compras.compraRango',compact('proveedoresE','encontrados','credito','efectivo','porPagar','pagadas','compras','total','hoy','empresa','fechaInicial','fechaFinal','gravado','isv'));
        $pdf->setPaper('Letter', 'landscape');
        return $pdf->download("Compras Periodo $fechaInicial al $fechaFinal.pdf");
    }

    public function exportCompraCredito(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        
        $buscar= request ('fecha');
        $Noexiste= DB::table('compras')->where('id_estado', 2)->doesntExist();
        if($Noexiste==true)
        {
            return redirect()->back()->with(['message' => 'No existen Creditos por pagar.', 'alert' => 'alert-danger']);
            
        }

        $hoy = Carbon::now();
        $empresa= DB::table('empresas')->where('id_empresa','1')->first();
        
        $compras = Compra::where('id_estado',2)->orderBy('fecha_pago')->get();
        $total = Compra::where('id_estado',2)->sum('total');
        
        $pdf=PDF::loadView('pdf.compras.compraCredito',compact('compras','hoy','empresa','total'));
        return $pdf->download('compraCredito.pdf');
    }

    public function gastoPdf()
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }
        return view('reporte.pdf.gastos');
    }

    public function exportGastoDia(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        $validatedData = $request->validate([
            'fecha' => 'required', 
        ]);
        $buscar= request ('fecha');
        $Noexiste= DB::table('gastos')->where('fecha', $buscar)->doesntExist();
        if($Noexiste==true)
        {
            return redirect()->back()->with(['message' => 'No existen registros para esta fecha.', 'alert' => 'alert-danger']);
            
        }
        $hoy = Carbon::now();
        $empresa= DB::table('empresas')->where('id_empresa','1')->first();
        $fecha= request ('fecha');
        $gastos = Gasto::where('fecha',$fecha)->orderBy('fecha')->get();
        $total=DB::table('gastos')->where('fecha',$fecha)->sum('total');
        $total= number_format($total, 2);

        $pdf=PDF::loadView('pdf.gastos.gastoDia',compact('gastos','hoy','empresa','total','fecha'));
        return $pdf->download("Gastos Periodo $fecha.pdf");
    }
    
    public function exportGastoRango(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        $validatedData = $request->validate([
            'fecha_inicial' => 'required', 
            'fecha_final' => 'required', 
        ]);

        $fechaInicial= request ('fecha_inicial');
        $fechaFinal= request ('fecha_final');
        $Noexiste= DB::table('gastos')->where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->doesntExist();
        if($Noexiste==true)
        {
            return redirect()->back()->with(['message' => 'No existen registros para esta fecha.', 'alert' => 'alert-danger']);
            
        }

        $hoy = Carbon::now();
        $empresa= DB::table('empresas')->where('id_empresa','1')->first();
        $fechaInicial= request ('fecha_inicial');
        $fechaFinal= request ('fecha_final');

        $gastos = Gasto::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->orderBy('fecha')->get();
        $total = Gasto::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->sum('total');
        
        
        $encontrados=[];
        $categorias= GastoCategoria::all();
        $contador= count($categorias);
        
        for($i=0; $i<$contador; $i++)
        {
           $id= $categorias[$i]->id;
           $d= $categorias[$i]->descripcion;
           
           $total= Gasto::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->sum('total');
           $totalCompra= Gasto::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->where('id_categoria',$id)->sum('total');
           $p= ($totalCompra*100)/$total;
           $p = number_format($p, 2, '.', '');
           $descripcion= "$d | % de Categoria: $p%";   
           $encontrados[$i] = Arr::add(['descripcion' => $descripcion], 'total', $totalCompra);
               

        }
        $columns = array_column($encontrados, 'total');
        array_multisort($columns, SORT_DESC, $encontrados);

        $total= number_format($total, 2);


        $pdf=PDF::loadView('pdf.gastos.gastoRango',compact('encontrados','gastos','hoy','empresa','total','fechaInicial','fechaFinal'));
        $pdf->setPaper('Letter', 'landscape');
        return $pdf->download("Gastos Periodo $fechaInicial al $fechaFinal.pdf");
    }

    
    public function productoPdf()
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }       
        return view('reporte.pdf.productos');
    }
    public function balancePdf()
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }
       
        return view('reporte.pdf.balances');
    }

    public function exportBalanceRango(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        $validatedData = $request->validate([
            'fecha_inicial' => 'required', 
            'fecha_final' => 'required', 
        ]);
        $fechaInicial= request ('fecha_inicial');
        $fechaFinal= request ('fecha_final');
        $Noexiste= DB::table('compras')->where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->doesntExist();
        if($Noexiste==true)
        {
            return redirect()->back()->with(['message' => 'No existen egresos para esta fecha.', 'alert' => 'alert-danger']);
            
        }

        $Noexiste= DB::table('ingresos')->where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->doesntExist();
        if($Noexiste==true)
        {
            return redirect()->back()->with(['message' => 'No existen ingresos para esta fecha.', 'alert' => 'alert-danger']);
            
        }

        $hoy = Carbon::now();
        $empresa= DB::table('empresas')->where('id_empresa','1')->first();
        $fechaInicial= request ('fecha_inicial');
        $fechaFinal= request ('fecha_final');

        $gastos = Gasto::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->sum('total');
        $compras = Compra::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->where('id_estado',1)->sum('total');
        $ingresos = Ingreso::where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->sum('total');
        $balance= $ingresos-($compras+$gastos);

        $egresos= $compras+$gastos;
        $ingresos= $ingresos;
        $p=100;

        $pE= ($egresos*$p)/$ingresos;
        $g= ($balance*$p)/$ingresos;


        $gastos= number_format($gastos, 2);
        $compras= number_format($compras, 2);
        $ingresos= number_format($ingresos, 2);
        $balance= number_format($balance, 2);
        $pE= number_format($pE, 2);
        $g= number_format($g, 2);

        if($g>0){$g= "+$g";}
        if($balance>0) {$balance= "+ $balance";}

        


        $pdf=PDF::loadView('pdf.balances.balanceRango',compact('hoy','pE','g','egresos','ingresos','gastos','compras','ingresos','balance','fechaInicial','fechaFinal','empresa'));
        return $pdf->download("Balance Periodo $fechaInicial al $fechaFinal.pdf");
    }

    public function exportBalanceCaja(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
       
       
        $hoy = Carbon::now();
        $empresa= DB::table('empresas')->where('id_empresa','1')->first();
      

        $gastos = Gasto::all()->sum('total');
        $compras = Compra::all()->sum('total');
        $ingresos = Ingreso::all()->sum('total');
        $balance= $ingresos-($compras+$gastos);

        $egresos= $compras+$gastos;
        $ingresos= $ingresos;
        $p=100;

        $pE= ($egresos*$p)/$ingresos;
        $g= ($balance*$p)/$ingresos;


        $gastos= number_format($gastos, 2);
        $compras= number_format($compras, 2);
        $ingresos= number_format($ingresos, 2);
        $balance= number_format($balance, 2);
        $pE= number_format($pE, 2);
        $g= number_format($g, 2);
        $egresos= number_format($egresos, 2);

        if($g>0){$g= "+$g";}
        if($balance>0) {$balance= "+ $balance";}

        $pdf=PDF::loadView('pdf.balances.balanceCaja',compact('hoy','pE','g','egresos','ingresos','gastos','compras','ingresos','balance','empresa'));
        return $pdf->download('Balance Caja.pdf');
    }

    public function exportBalanceComparativo(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
        $validatedData = $request->validate([
            'primer_mes' => 'required', 
            'segundo_mes' => 'required', 
        ]);

        
        $hoy = Carbon::now();
        $empresa= DB::table('empresas')->where('id_empresa',1)->first();

        $primerMes= request ('primer_mes');
        $segundoMes= request ('segundo_mes');
      
        $inicioMes1= "$primerMes-01";
        $finalMes1= "$primerMes-31";

        $inicioMes2= "$segundoMes-01";
        $finalMes2= "$segundoMes-31";

        if(Ingreso::where('fecha', '>=', $inicioMes1)->where('fecha', '<=', $finalMes1)->exists())
        {
            if(Gasto::where('fecha', '>=', $inicioMes1)->where('fecha', '<=', $finalMes1)->doesntExist())
            {
                return redirect()->back()->with(['message' => 'No existen Gastos para esta fecha.', 'alert' => 'alert-danger']);
            }
            if(Compra::where('fecha', '>=', $inicioMes1)->where('fecha', '<=', $finalMes1)->doesntExist())
            {
                return redirect()->back()->with(['message' => 'No existen Compras para esta fecha.', 'alert' => 'alert-danger']);
            }
            if(Planilla::where('fecha', '>=', $inicioMes1)->where('fecha', '<=', $finalMes1)->doesntExist())
            {
                return redirect()->back()->with(['message' => 'No existen Gastos de Planilla para esta fecha.', 'alert' => 'alert-danger']);
            }
        }

        if(Ingreso::where('fecha', '>=', $inicioMes2)->where('fecha', '<=', $finalMes2)->exists())
        {
            if(Gasto::where('fecha', '>=', $inicioMes2)->where('fecha', '<=', $finalMes2)->doesntExist())
            {
                return redirect()->back()->with(['message' => 'No existen Gastos para esta fecha.', 'alert' => 'alert-danger']);
            }
            if(Compra::where('fecha', '>=', $inicioMes2)->where('fecha', '<=', $finalMes2)->doesntExist())
            {
                return redirect()->back()->with(['message' => 'No existen Compras para esta fecha.', 'alert' => 'alert-danger']);
            }
            if(Planilla::where('fecha', '>=', $inicioMes2)->where('fecha', '<=', $finalMes2)->doesntExist())
            {
                return redirect()->back()->with(['message' => 'No existen Gastos de Planilla para esta fecha.', 'alert' => 'alert-danger']);
            }
   
        }

        //1er Mes
        $gastosPrimerMes = Gasto::where('fecha', '>=', $inicioMes1)->where('fecha', '<=',  $finalMes1)->sum('total');
        $planillasPrimerMes = Planilla::where('fecha', '>=', $inicioMes1)->where('fecha', '<=',  $finalMes1)->sum('total');
        $comprasPrimerMes = Compra::where('fecha', '>=', $inicioMes1)->where('fecha', '<=',  $finalMes1)->sum('total');
        $ingresosPrimerMes = Ingreso::where('fecha', '>=', $inicioMes1)->where('fecha', '<=',  $finalMes1)->sum('total');
        $balancePrimerMes= $ingresosPrimerMes-($comprasPrimerMes+$gastosPrimerMes);

        $egresosPrimerMes= $comprasPrimerMes+$gastosPrimerMes;
        $ingresosPrimerMes= $ingresosPrimerMes;

       
        $p=100;

        $porcEgresos1= ($egresosPrimerMes*$p)/$ingresosPrimerMes;
        $porcGanancia1= ($balancePrimerMes*$p)/$ingresosPrimerMes;

     
        
        //2do Mes
        $gastosSegundoMes = Gasto::where('fecha', '>=', $inicioMes2)->where('fecha', '<=',  $finalMes2)->sum('total');
        $planillasSegundoMes = Planilla::where('fecha', '>=', $inicioMes2)->where('fecha', '<=',  $finalMes2)->sum('total');
        $comprasSegundoMes = Compra::where('fecha', '>=', $inicioMes2)->where('fecha', '<=',  $finalMes2)->sum('total');
        $ingresosSegundoMes = Ingreso::where('fecha', '>=', $inicioMes2)->where('fecha', '<=',  $finalMes2)->sum('total');
        $balanceSegundoMes= $ingresosSegundoMes-($comprasSegundoMes+$gastosSegundoMes);

        $egresosSegundoMes= $comprasSegundoMes+$gastosSegundoMes;
        $ingresosSegundoMes= $ingresosSegundoMes;

       
        $p=100;

        $porcEgresos2= ($egresosSegundoMes*$p)/$ingresosSegundoMes;
        $porcGanancia2= ($balanceSegundoMes*$p)/$egresosSegundoMes;

        $comparativos=[];
        do
        {
            $salir=false;
            $i=0;
            if($ingresosPrimerMes>$ingresosSegundoMes)
            {
                $diferencia=$ingresosPrimerMes-$ingresosSegundoMes;
                $diferencia = number_format($diferencia, 2);
                $descripcion= "Ingresos del Mes $primerMes AUMENTARON ";   
                $comparativos[$i] = Arr::add(['descripcion' => $descripcion], 'diferencia', $diferencia);
                $i++;
            }
            else if($ingresosPrimerMes<$ingresosSegundoMes)
            {
                $diferencia=$ingresosSegundoMes-$ingresosPrimerMes;
                $diferencia = number_format($diferencia, 2);
                $descripcion= "Ingresos del Mes $primerMes DISMINUYERON ";   
                $comparativos[$i] = Arr::add(['descripcion' => $descripcion], 'diferencia', $diferencia);
                $i++;
            }

            if($gastosPrimerMes>$gastosSegundoMes)
            {
                $diferencia=$gastosPrimerMes-$gastosSegundoMes;
                $diferencia = number_format($diferencia, 2);
                $descripcion= "Gastos del Mes $primerMes AUMENTARON ";   
                $comparativos[$i] = Arr::add(['descripcion' => $descripcion], 'diferencia', $diferencia);
                $i++;
            }
            else if($gastosPrimerMes<$gastosSegundoMes)
            {
                $diferencia=$gastosSegundoMes-$gastosPrimerMes;
                $diferencia = number_format($diferencia, 2);
                $descripcion= "Gastos del Mes $primerMes DISMINUYERON ";   
                $comparativos[$i] = Arr::add(['descripcion' => $descripcion], 'diferencia', $diferencia);
                $i++;
            }

            if($comprasPrimerMes>$comprasSegundoMes)
            {
                $diferencia=$comprasPrimerMes-$comprasSegundoMes;
                $diferencia = number_format($diferencia, 2);
                $descripcion= "Compras del Mes $primerMes AUMENTARON ";   
                $comparativos[$i] = Arr::add(['descripcion' => $descripcion], 'diferencia', $diferencia);
                $i++;
            }
            else if($comprasPrimerMes<$comprasSegundoMes)
            {
                $diferencia=$comprasSegundoMes-$comprasPrimerMes;
                $diferencia = number_format($diferencia, 2);
                $descripcion= "Compras del Mes $primerMes DISMINUYERON ";   
                $comparativos[$i] = Arr::add(['descripcion' => $descripcion], 'diferencia', $diferencia);
                $i++;
            }
            $columns = array_column($comparativos, 'diferencia');
          
         
            $salir=true;
        }while($salir=false);
           
        
        $categoriaGastos=[];
        $categorias= GastoCategoria::all();
        $contador= count($categorias);
        
        for($i=0; $i<$contador; $i++)
        {
           $id= $categorias[$i]->id;
           $d= $categorias[$i]->descripcion;
           
           $total= Gasto::where('fecha', '>=', $inicioMes1)->where('fecha', '<=', $finalMes1)->sum('total');
           $totalGasto1= Gasto::where('fecha', '>=', $inicioMes1)->where('fecha', '<=', $finalMes1)->where('id_categoria',$id)->sum('total');
           $totalGasto2= Gasto::where('fecha', '>=', $inicioMes2)->where('fecha', '<=', $finalMes2)->where('id_categoria',$id)->sum('total');

          
           if($totalGasto1>$totalGasto2)
           {
            $diferencia=$totalGasto1-$totalGasto2;
            $diferencia = number_format($diferencia, 2);
            $descripcion= "Gasto de $d AUMENTO en el Mes: $primerMes  ";   
            $categoriaGastos[$i] = Arr::add(['descripcion' => $descripcion], 'diferencia', $diferencia);
           }
           else if($totalGasto1<$totalGasto2)
           {
            $diferencia=$totalGasto1-$totalGasto2;
            $diferencia = number_format($diferencia, 2);
            $descripcion= "Gasto de $d DISMINUYO en el Mes: $primerMes ";   
            $categoriaGastos[$i] = Arr::add(['descripcion' => $descripcion], 'diferencia', $diferencia);
           }
           else if($totalGasto1==$totalGasto2)
           {
               if($totalGasto1==0 && $totalGasto2==0)
               {
               
               }
               else{
                $descripcion= "Gasto de $d fue IGUAL en el Mes: $primerMes ";   
                $categoriaGastos[$i] = Arr::add(['descripcion' => $descripcion], 'diferencia', $totalGasto1);

               }

           }

        }
        $columns = array_column($categoriaGastos, 'diferencia');
        array_multisort($columns, SORT_ASC, $categoriaGastos);

        $categoriaCompras=[];
        $categorias= CompraCategoria::all();
        $contador= count($categorias);
        
        for($i=0; $i<$contador; $i++)
        {
           $id= $categorias[$i]->id;
           $d= $categorias[$i]->descripcion;
           
           $total= Compra::where('fecha', '>=', $inicioMes1)->where('fecha', '<=', $finalMes1)->sum('total');
           $totalCompra1= Compra::where('fecha', '>=', $inicioMes1)->where('fecha', '<=', $finalMes1)->where('id_categoria',$id)->sum('total');
           $totalCompra2= Compra::where('fecha', '>=', $inicioMes2)->where('fecha', '<=', $finalMes2)->where('id_categoria',$id)->sum('total');

          
           if($totalCompra1>$totalCompra2)
           {
            $diferencia=$totalCompra1-$totalCompra2;
            $diferencia = number_format($diferencia, 2);
            $descripcion= "Compras de $d AUMENTARON en el Mes: $primerMes  ";   
            $categoriaCompras[$i] = Arr::add(['descripcion' => $descripcion], 'diferencia', $diferencia);
           }
           else if($totalCompra1<$totalCompra2)
           {
            $diferencia=$totalCompra1-$totalCompra2;
            $diferencia = number_format($diferencia, 2);
            $descripcion= "Compras de $d DISMINUYERON en el Mes: $primerMes ";   
            $categoriaCompras[$i] = Arr::add(['descripcion' => $descripcion], 'diferencia', $diferencia);
           }
           else if($totalCompra1==$totalCompra2)
           {
           
           }


        }
        $columns = array_column($categoriaCompras, 'diferencia');
        array_multisort($columns, SORT_ASC, $categoriaCompras);
     
        
        $planillasPrimerMes = number_format($planillasPrimerMes, 2);
        $ingresosPrimerMes= number_format($gastosPrimerMes, 2);
        $comprasPrimerMes= number_format($comprasPrimerMes, 2);
        $balancePrimerMes= number_format($balancePrimerMes, 2);
        $porcEgresos1= number_format($porcEgresos1, 2);
        $porcGanancia1= number_format($porcGanancia1, 2);
        $egresosPrimerMes= number_format($egresosPrimerMes, 2);
      

        $planillasSegundoMes = number_format($planillasSegundoMes, 2);
        $gastosSegundoMes= number_format($gastosSegundoMes, 2);
        $comprasSegundoMes= number_format($comprasSegundoMes, 2);
        $ingresosSegundoMes= number_format($ingresosSegundoMes, 2);
        $balanceSegundoMes= number_format($balanceSegundoMes, 2);
        $porcEgresos2= number_format($porcEgresos2, 2);
        $porcGanancia2= number_format($porcGanancia2, 2);
        $egresosSegundoMes= number_format($egresosSegundoMes, 2);
       

        $pdf=PDF::loadView('pdf.balances.balanceComparativo',compact('hoy','empresa','gastosPrimerMes','comprasPrimerMes','balancePrimerMes','porcGanancia1','porcEgresos1','ingresosPrimerMes','egresosPrimerMes' ,'inicioMes1','finalMes1'
    ,'gastosSegundoMes','comprasSegundoMes','balanceSegundoMes','porcEgresos2','porcGanancia2','egresosSegundoMes','ingresosSegundoMes','inicioMes2','finalMes2','primerMes','segundoMes'
    ,'planillasPrimerMes','planillasSegundoMes','categoriaGastos','comparativos','categoriaCompras'));
        return $pdf->download('Ingresos y Egresos Comparativo.pdf');
    }
    
    
    public function compraExcel()
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }
       
        return view('reporte.excel.compras');
    }

    public function exportCompraExcel(Request $request)
    {
       

        if(!Auth::check())
        {
            return redirect('/login');
        }
        $validatedData = $request->validate([
            'fecha_inicial' => 'required', 
            'fecha_final' => 'required', 
        ]);
        
        $fechaInicial= request ('fecha_inicial');
        $fechaFinal= request ('fecha_final');
       
        $Noexiste= DB::table('compras')->where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->doesntExist();
        if($Noexiste==true)
        {
            return redirect()->back()->with(['message' => 'No existen registros para esta fecha.', 'alert' => 'alert-danger']);
            
        }
        return Excel::download(new ComprasExport($fechaInicial,$fechaFinal), "Compras Periodo $fechaInicial al $fechaFinal.xlsx");
        
    }

    public function ventaExcel()
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }
       
        return view('reporte.excel.ventas');
    }

    public function exportVentaExcel(Request $request)
    {
       
        if(!Auth::check())
        {
            return redirect('/login');
        }
        $validatedData = $request->validate([
            'fecha_inicial' => 'required', 
            'fecha_final' => 'required', 
        ]);
      
        $fechaInicial= request ('fecha_inicial');
        $fechaFinal= request ('fecha_final');
        $Noexiste= DB::table('ingresos')->where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->doesntExist();
        if($Noexiste==true)
        {
            return redirect()->back()->with(['message' => 'No existen registros para esta fecha.', 'alert' => 'alert-danger']);
            
        }
        return Excel::download(new VentasExport($fechaInicial,$fechaFinal),"Ingresos Periodo $fechaInicial al $fechaFinal.xlsx");
        
    }

    /////////////////////

   
    public function exportProductoActual(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 
    
        $hoy = date("Y-m-d");
        $empresa= DB::table('empresas')->where('id_empresa','1')->first();
        $fecha= date("Y-m-d");
     
        $inventario= Producto::where('id_estado',1)->sum('stock');
        $productos= Producto::where('id_estado',1)->orderBy('descripcion')->get();
        $total_inventario= Producto::where('id_estado',1)->sum('valor');


        $pdf=PDF::loadView('pdf.productos.productosActual',compact('inventario','productos','total_inventario', 'hoy','empresa','fecha'));
        return $pdf->download('inventarioActual.pdf');
    }

    

    public function facturaExcel()
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }
       
        return view('reporte.excel.facturas');
    }

    public function exportFacturaExcel(Request $request)
    {
       
        if(!Auth::check())
        {
            return redirect('/login');
        }
        $validatedData = $request->validate([
            'fecha_inicial' => 'required', 
            'fecha_final' => 'required', 
        ]);
      
        $fechaInicial= request ('fecha_inicial');
        $fechaFinal= request ('fecha_final');
        $Noexiste= DB::table('facturas')->where('fecha', '>=', $fechaInicial)->where('fecha', '<=', $fechaFinal)->doesntExist();
        if($Noexiste==true)
        {
            return redirect()->back()->with(['message' => 'No existen registros para esta fecha.', 'alert' => 'alert-danger']);
            
        }
        return Excel::download(new FacturasExport($fechaInicial,$fechaFinal), 'ventaRango.xlsx');
        
    }

    public function exportFacturaCredito(Request $request)
    {  if(!Auth::check())
        {
            return redirect('/login');
        } 
    
        $hoy = date("Y-m-d");
        $empresa= DB::table('empresas')->where('id_empresa','1')->first();

        $creditos= FacturaCredito::where('id_estado',2)->get();
        $total= FacturaCredito::where('id_estado',2)->sum('saldo');

        $pdf=PDF::loadView('pdf.ventas.facturaCredito',compact('creditos','total','hoy','empresa'));
        return $pdf->download('FacturasCreditos.pdf');
    }


}
