<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Ingreso;
use App\Models\Gasto;
use App\Models\Compra;
use App\Models\Planilla;
use App\Models\Producto;
use App\Models\FacturaDetalle;
use App\Models\FacturaCredito;
use App\Models\Credito;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserFormRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productos= Producto::all();
        $contador= count($productos);
        $contadorProductos=0;

        for($i=0; $i<$contador; $i++)
        {
        
           $id= $productos[$i]->id_producto;
           $cantidad= DB::table('factura_detalles')->where('id_producto',$id)->sum('cantidad');
           $contadorProductos+=$cantidad;

        }

        $articulos= $contadorProductos;
        
        $hora = Carbon::now(); 
        $fecha_inicial="2021-11-01";
        $fecha_final="2021-11-30";
        $mes= "Noviembre";
        $year="2021";
        $fecha_inicialP="2021-10-01";
        $fecha_finalP="2021-10-31";
        $fecha_inicialAnual="2021-01-01";
       

        $empresas=Empresa::where('id_empresa','1')->first();
        $ingresos=Ingreso::where('fecha', '>=', $fecha_inicial)->where('fecha', '<=', $fecha_final)->sum('total');
        $gastos=Gasto::where('fecha', '>=',  $fecha_inicial)->where('fecha', '<=', $fecha_final)->sum('total');
        $compras=Compra::where('fecha', '>=',  $fecha_inicial)->where('fecha', '<=', $fecha_final)->sum('total');
        $planillas=Planilla::where('fecha', '>=',  $fecha_inicial)->where('fecha', '<=', $fecha_final)->sum('total');
     
       

        $ingresosAnual=Ingreso::where('fecha', '>=', $fecha_inicialAnual)->where('fecha', '<=', $fecha_final)->sum('total');
        $gastosAnual=Gasto::where('fecha', '>=',  $fecha_inicialAnual)->where('fecha', '<=', $fecha_final)->sum('total');
        $comprasAnual=Compra::where('fecha', '>=',  $fecha_inicialAnual)->where('fecha', '<=', $fecha_final)->sum('total');
        $planillasAnual=Planilla::where('fecha', '>=',  $fecha_inicialAnual)->where('fecha', '<=', $fecha_final)->sum('total');
        
        if($ingresos==0){$ingresos=1;}
        if($gastos==0){$gastos=1;}
        if($compras==0){$compras=1;}
        

        $ingresosPasados=Ingreso::where('fecha', '>=', $fecha_inicialP)->where('fecha', '<=', $fecha_finalP)->sum('total');
        $gastosPasados=Gasto::where('fecha', '>=',  $fecha_inicialP)->where('fecha', '<=', $fecha_finalP)->sum('total');
        $comprasPasados=Compra::where('fecha', '>=',  $fecha_inicialP)->where('fecha', '<=', $fecha_finalP)->sum('total');
        $planillasPasados=Planilla::where('fecha', '>=',  $fecha_inicialP)->where('fecha', '<=', $fecha_finalP)->sum('total');
    
        if($ingresosPasados==0){$ingresosPasados=1;}
        if($gastosPasados==0){$gastosPasados=1;}
        if($comprasPasados==0){$comprasPasados=1;}
        if($planillasPasados==0){$planillasPasados=1;}

        //Ingresos
        if($ingresos>$ingresosPasados)
        {
            $descripcionIngresos="Aumentaron";
            $pI= ($ingresos*100)/$ingresosPasados;
        }else
        {
            $descripcionIngresos="Disminuyeron";
            $pI= ($ingresos*100)/$ingresosPasados;
        }
        //Gastos
        if($gastos>$gastosPasados)
        {
            $descripcionGastos="Aumentaron";
            $pG= ($gastos*100)/$gastosPasados;
        }else
        {
            $descripcionGastos="Disminuyeron";
            $pG= ($gastos*100)/$gastosPasados;
        }
        //Compras
        if($compras>$comprasPasados)
        {
            $descripcionCompras="Aumentaron";
            $pC= ($compras*100)/$comprasPasados;
        }else
        {
            $descripcionCompras="Disminuyeron";
            $pC= ($compras*100)/$comprasPasados;
        }
        //Planilla
        if($planillas>$planillasPasados)
        {
            $descripcionPlanilla="Aumentaron";
            $pP= ($planillas*100)/$planillasPasados;
        }else
        {
           
            $descripcionPlanilla="Disminuyeron";
            $pP= ($planillas*100)/$planillasPasados;
            
           
        }
     
        $ingresos = number_format($ingresos, 2);
        $gastos = number_format($gastos, 2);
        $compras = number_format($compras, 2);
        $planillas = number_format($planillas, 2);

        $ingresosAnual = number_format($ingresosAnual, 2);
        $gastosAnual = number_format($gastosAnual, 2);
        $comprasAnual = number_format($comprasAnual, 2);
        $planillasAnual = number_format($planillasAnual, 2);

        
        return view('home',compact('hora','empresas','ingresos','gastos','compras','planillas','mes','year',
        'descripcionIngresos','descripcionGastos','descripcionCompras','descripcionPlanilla','pI','pC','pG','pP',
        'ingresosAnual','gastosAnual','comprasAnual','planillasAnual','articulos'));

        
    }
}
