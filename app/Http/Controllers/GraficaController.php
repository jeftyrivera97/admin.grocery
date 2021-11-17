<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Ingreso;
use App\Models\Compra;
use App\Models\Planilla;
use App\Models\Gasto;
use App\Models\Proveedor;
use App\Models\CompraCategoria;
use App\Models\GastoCategoria;
use Illuminate\Support\Arr;
use App\Models\Factura;
use App\Models\FacturaCredito;
use Illuminate\Support\Facades\Auth;

class GraficaController extends Controller
{

    public function facturas(Request $request)
    {

        $fecha_inicial= "2021-05-01";
        $fecha_final="2021-05-30";
       
        $contado=Factura::where('fecha', '>=', $fecha_inicial)->where('fecha', '<=', $fecha_final)->where('tipo_factura','contado')->sum('total');
        $creditos=FacturaCredito::sum('saldo');
        
        $facturas=[];

        $facturas[0] = Arr::add(['descripcion' => 'Facturas a Contado'], 'total', $contado);
        $facturas[1] = Arr::add(['descripcion' => 'Facturas en Creditos'], 'total', $creditos);
        

        return response(json_encode($facturas),200)->header('Content-type','text/plain');
    } 

      
    public function graficasVarias()
    {

        $fecha_inicial="2021-11-01";
        $fecha_final="2021-11-30"; 

        $compras=Compra::where('fecha', '>=', $fecha_inicial)->where('fecha', '<=', $fecha_final)->sum('total');
        $ventas=Ingreso::where('fecha', '>=', $fecha_inicial)->where('fecha', '<=', $fecha_final)->sum('total');
        $gastos=Gasto::where('fecha', '>=', $fecha_inicial)->where('fecha', '<=', $fecha_final)->sum('total');
        $planillas=Planilla::where('fecha', '>=', $fecha_inicial)->where('fecha', '<=', $fecha_final)->sum('total');

        $gastos= number_format($gastos, 2);
        $compras= number_format($compras, 2);
        $ventas= number_format($ventas, 2);
        $planillas= number_format($planillas, 2);

        return view('grafica.index', compact('compras','ventas','gastos','planillas'));

    } 
    public function ventas(Request $request)
    {
        
        $enero=Ingreso::where('fecha', '>=', '2021-01-01')->where('fecha', '<=', '2021-01-31')->sum('total');
        $febrero=Ingreso::where('fecha', '>=', '2021-02-01')->where('fecha', '<=', '2021-02-28')->sum('total');
        $marzo=Ingreso::where('fecha', '>=', '2021-03-01')->where('fecha', '<=', '2021-03-31')->sum('total');
        $abril=Ingreso::where('fecha', '>=', '2021-04-01')->where('fecha', '<=', '2021-04-31')->sum('total');
        $mayo=Ingreso::where('fecha', '>=', '2021-05-01')->where('fecha', '<=', '2021-05-31')->sum('total');
        $junio=Ingreso::where('fecha', '>=', '2021-06-01')->where('fecha', '<=', '2021-06-30')->sum('total');
        $julio=Ingreso::where('fecha', '>=', '2021-07-01')->where('fecha', '<=', '2021-07-31')->sum('total');
        $agosto=Ingreso::where('fecha', '>=', '2021-08-01')->where('fecha', '<=', '2021-08-31')->sum('total');
        $septiembre=Ingreso::where('fecha', '>=', '2021-09-01')->where('fecha', '<=', '2021-09-31')->sum('total');
        $octubre=Ingreso::where('fecha', '>=', '2021-10-01')->where('fecha', '<=', '2021-10-31')->sum('total');
        $noviembre=Ingreso::where('fecha', '>=', '2021-11-01')->where('fecha', '<=', '2021-11-30')->sum('total');
     
        $collection = collect([
           
            ['descripcion' => 'Enero', 'total' => $enero],
            ['descripcion' => 'Febrero', 'total' => $febrero],
            ['descripcion' => 'Marzo', 'total' => $marzo],
            ['descripcion' => 'Abril', 'total' => $abril],
            ['descripcion' => 'Mayo', 'total' => $mayo],
            ['descripcion' => 'Junio', 'total' => $junio],
            ['descripcion' => 'Julio', 'total' => $julio],
            ['descripcion' => 'Agosto', 'total' => $agosto],
            ['descripcion' => 'Septiembre', 'total' => $septiembre],
            ['descripcion' => 'Octubre', 'total' => $octubre],
            ['descripcion' => 'Noviembre', 'total' => $noviembre],

         
        ]);
        
       return response(json_encode($collection),200)->header('Content-type','text/plain');
    } 

    
    public function planillas(Request $request)
    {     
        
        $enero=Planilla::where('fecha', '>=', '2021-01-01')->where('fecha', '<=', '2021-01-31')->sum('total');
        $febrero=Planilla::where('fecha', '>=', '2021-02-01')->where('fecha', '<=', '2021-02-28')->sum('total');
        $marzo=Planilla::where('fecha', '>=', '2021-03-01')->where('fecha', '<=', '2021-03-31')->sum('total');
        $abril=Planilla::where('fecha', '>=', '2021-04-01')->where('fecha', '<=', '2021-04-31')->sum('total');
        $mayo=Planilla::where('fecha', '>=', '2021-05-01')->where('fecha', '<=', '2021-05-31')->sum('total');
        $junio=Planilla::where('fecha', '>=', '2021-06-01')->where('fecha', '<=', '2021-06-30')->sum('total');
        $julio=Planilla::where('fecha', '>=', '2021-07-01')->where('fecha', '<=', '2021-07-31')->sum('total');
        $agosto=Planilla::where('fecha', '>=', '2021-08-01')->where('fecha', '<=', '2021-08-31')->sum('total');
        $septiembre=Planilla::where('fecha', '>=', '2021-09-01')->where('fecha', '<=', '2021-09-31')->sum('total');
        $octubre=Planilla::where('fecha', '>=', '2021-10-01')->where('fecha', '<=', '2021-10-31')->sum('total');
        $noviembre=Planilla::where('fecha', '>=', '2021-11-01')->where('fecha', '<=', '2021-11-30')->sum('total');
      
        $collection = collect([
           
            ['descripcion' => 'Enero', 'total' => $enero],
            ['descripcion' => 'Febrero', 'total' => $febrero],
            ['descripcion' => 'Marzo', 'total' => $marzo],
            ['descripcion' => 'Abril', 'total' => $abril],
            ['descripcion' => 'Mayo', 'total' => $mayo],
            ['descripcion' => 'Junio', 'total' => $junio],
            ['descripcion' => 'Julio', 'total' => $julio],
            ['descripcion' => 'Agosto', 'total' => $agosto],
            ['descripcion' => 'Septiembre', 'total' => $septiembre],
            ['descripcion' => 'Octubre', 'total' => $octubre],
            ['descripcion' => 'Noviembre', 'total' => $noviembre],

         
        ]);
        
       return response(json_encode($collection),200)->header('Content-type','text/plain'); 
    } 

    public function gastos(Request $request)
    {     
        
        $enero=Gasto::where('fecha', '>=', '2021-01-01')->where('fecha', '<=', '2021-01-31')->sum('total');
        $febrero=Gasto::where('fecha', '>=', '2021-02-01')->where('fecha', '<=', '2021-02-28')->sum('total');
        $marzo=Gasto::where('fecha', '>=', '2021-03-01')->where('fecha', '<=', '2021-03-31')->sum('total');
        $abril=Gasto::where('fecha', '>=', '2021-04-01')->where('fecha', '<=', '2021-04-31')->sum('total');
        $mayo=Gasto::where('fecha', '>=', '2021-05-01')->where('fecha', '<=', '2021-05-31')->sum('total');
        $junio=Gasto::where('fecha', '>=', '2021-06-01')->where('fecha', '<=', '2021-06-30')->sum('total');
        $julio=Gasto::where('fecha', '>=', '2021-07-01')->where('fecha', '<=', '2021-07-31')->sum('total');
        $agosto=Gasto::where('fecha', '>=', '2021-08-01')->where('fecha', '<=', '2021-08-31')->sum('total');
        $septiembre=Gasto::where('fecha', '>=', '2021-09-01')->where('fecha', '<=', '2021-09-31')->sum('total');
        $octubre=Gasto::where('fecha', '>=', '2021-10-01')->where('fecha', '<=', '2021-10-31')->sum('total');
        $noviembre=Gasto::where('fecha', '>=', '2021-11-01')->where('fecha', '<=', '2021-11-30')->sum('total');
     
     
        $collection = collect([
           
            ['descripcion' => 'Enero', 'total' => $enero],
            ['descripcion' => 'Febrero', 'total' => $febrero],
            ['descripcion' => 'Marzo', 'total' => $marzo],
            ['descripcion' => 'Abril', 'total' => $abril],
            ['descripcion' => 'Mayo', 'total' => $mayo],
            ['descripcion' => 'Junio', 'total' => $junio],
            ['descripcion' => 'Julio', 'total' => $julio],
            ['descripcion' => 'Agosto', 'total' => $agosto],
            ['descripcion' => 'Septiembre', 'total' => $septiembre],
            ['descripcion' => 'Octubre', 'total' => $octubre],
            ['descripcion' => 'Noviembre', 'total' => $noviembre],  
        ]);
        
       return response(json_encode($collection),200)->header('Content-type','text/plain');
        
    } 

    public function compras(Request $request)
    {     
        
        $enero=Compra::where('fecha', '>=', '2021-01-01')->where('fecha', '<=', '2021-01-31')->sum('total');
        $febrero=Compra::where('fecha', '>=', '2021-02-01')->where('fecha', '<=', '2021-02-28')->sum('total');
        $marzo=Compra::where('fecha', '>=', '2021-03-01')->where('fecha', '<=', '2021-03-31')->sum('total');
        $abril=Compra::where('fecha', '>=', '2021-04-01')->where('fecha', '<=', '2021-04-31')->sum('total');
        $mayo=Compra::where('fecha', '>=', '2021-05-01')->where('fecha', '<=', '2021-05-31')->sum('total');
        $junio=Compra::where('fecha', '>=', '2021-06-01')->where('fecha', '<=', '2021-06-30')->sum('total');
        $julio=Compra::where('fecha', '>=', '2021-07-01')->where('fecha', '<=', '2021-07-31')->sum('total');
        $agosto=Compra::where('fecha', '>=', '2021-08-01')->where('fecha', '<=', '2021-08-31')->sum('total');
        $septiembre=Compra::where('fecha', '>=', '2021-09-01')->where('fecha', '<=', '2021-09-31')->sum('total');
        $octubre=Compra::where('fecha', '>=', '2021-10-01')->where('fecha', '<=', '2021-10-31')->sum('total');
        $noviembre=Compra::where('fecha', '>=', '2021-11-01')->where('fecha', '<=', '2021-11-30')->sum('total');
        
     
        $collection = collect([
           
            ['descripcion' => 'Enero', 'total' => $enero],
            ['descripcion' => 'Febrero', 'total' => $febrero],
            ['descripcion' => 'Marzo', 'total' => $marzo],
            ['descripcion' => 'Abril', 'total' => $abril],
            ['descripcion' => 'Mayo', 'total' => $mayo],
            ['descripcion' => 'Junio', 'total' => $junio],
            ['descripcion' => 'Julio', 'total' => $julio],
            ['descripcion' => 'Agosto', 'total' => $agosto],
            ['descripcion' => 'Septiembre', 'total' => $septiembre],
            ['descripcion' => 'Octubre', 'total' => $octubre],
            ['descripcion' => 'Noviembre', 'total' => $noviembre],  
        ]);
        
       return response(json_encode($collection),200)->header('Content-type','text/plain');
        
    } 

    
    public function proveedores(Request $request)
    {
        $fecha_inicial="2021-01-01";
        $fecha_final="2021-11-30";
        $compras=[];
        $proveedores= Proveedor::all();
        $contador= count($proveedores);
        
        for($i=0; $i<$contador; $i++)
        {
           $id= $proveedores[$i]->id_proveedor;
           $d= $proveedores[$i]->descripcion;
           
           $total= Compra::where('fecha', '>=', $fecha_inicial)->where('fecha', '<=', $fecha_final)->where('id_proveedor',$id)->sum('total');
           $compras[$i] = Arr::add(['descripcion' => $d], 'total', $total);

        }

        $columns = array_column($compras, 'total');
        array_multisort($columns, SORT_DESC, $compras);
       
        return response(json_encode($compras),200)->header('Content-type','text/plain');
    } 

    public function categoriasG(Request $request)
    {
        $fecha_inicial="2021-01-01";
        $fecha_final="2021-11-30";
        $gastos=[];
        $categorias= GastoCategoria::all();
        $contador= count($categorias);
        
        for($i=0; $i<$contador; $i++)
        {
           $id= $categorias[$i]->id;
           $d= $categorias[$i]->descripcion;
           
           $total= Gasto::where('fecha', '>=', $fecha_inicial)->where('fecha', '<=', $fecha_final)->where('id_categoria',$id)->sum('total');
           $gastos[$i] = Arr::add(['descripcion' => $d], 'total', $total);

        }

        $columns = array_column($gastos, 'total');
        array_multisort($columns, SORT_DESC, $gastos);
       
        return response(json_encode($gastos),200)->header('Content-type','text/plain');
    } 




    public function ventasSemanal(Request $request)
    {

        $mes="nov";
        $numMes="11";
        $year="2021";
        $semana1=Ingreso::where('fecha', '>=', "$year-$numMes-01")->where('fecha', '<=', "$year-$numMes-07")->sum('total');
        $semana2=Ingreso::where('fecha', '>=', "$year-$numMes-08")->where('fecha', '<=', "$year-$numMes-14")->sum('total');
        $semana3=Ingreso::where('fecha', '>=', "$year-$numMes-15")->where('fecha', '<=', "$year-$numMes-21")->sum('total');
        $semana4=Ingreso::where('fecha', '>=', "$year-$numMes-22")->where('fecha', '<=', "$year-$numMes-31")->sum('total');
     

        $collection = collect([
            ['descripcion' => "01/$mes - 07/$mes", 'total' => $semana1],
            ['descripcion' => "08/$mes - 14/$mes", 'total' => $semana2],
            ['descripcion' => "15/$mes - 21/$mes", 'total' => $semana3],
            ['descripcion' => "22/$mes - 31/$mes", 'total' => $semana4],
        ]);
    
       
       return response(json_encode($collection),200)->header('Content-type','text/plain');

    } 
    
    public function comprasSemanal(Request $request)
    {
    
        $mes="nov";
        $numMes="11";
        $year="2021";
        $semana1=Compra::where('fecha', '>=', "$year-$numMes-01")->where('fecha', '<=', "$year-$numMes-07")->sum('total');
        $semana2=Compra::where('fecha', '>=', "$year-$numMes-08")->where('fecha', '<=', "$year-$numMes-14")->sum('total');
        $semana3=Compra::where('fecha', '>=', "$year-$numMes-15")->where('fecha', '<=', "$year-$numMes-21")->sum('total');
        $semana4=Compra::where('fecha', '>=', "$year-$numMes-22")->where('fecha', '<=', "$year-$numMes-31")->sum('total');
     

        $collection = collect([
            ['descripcion' => "01/$mes - 07/$mes", 'total' => $semana1],
            ['descripcion' => "08/$mes - 14/$mes", 'total' => $semana2],
            ['descripcion' => "15/$mes - 21/$mes", 'total' => $semana3],
            ['descripcion' => "22/$mes - 31/$mes", 'total' => $semana4],
        ]);
    

       return response(json_encode($collection),200)->header('Content-type','text/plain');
    }  


    public function gastosSemanal(Request $request)
    {     

        $mes="nov";
        $numMes="11";
        $year="2021";
        $semana1=Gasto::where('fecha', '>=', "$year-$numMes-01")->where('fecha', '<=', "$year-$numMes-07")->sum('total');
        $semana2=Gasto::where('fecha', '>=', "$year-$numMes-08")->where('fecha', '<=', "$year-$numMes-14")->sum('total');
        $semana3=Gasto::where('fecha', '>=', "$year-$numMes-15")->where('fecha', '<=', "$year-$numMes-21")->sum('total');
        $semana4=Gasto::where('fecha', '>=', "$year-$numMes-22")->where('fecha', '<=', "$year-$numMes-31")->sum('total');
     

        $collection = collect([
            ['descripcion' => "01/$mes - 07/$mes", 'total' => $semana1],
            ['descripcion' => "08/$mes - 14/$mes", 'total' => $semana2],
            ['descripcion' => "15/$mes - 21/$mes", 'total' => $semana3],
            ['descripcion' => "22/$mes - 31/$mes", 'total' => $semana4],
        ]);
       return response(json_encode($collection),200)->header('Content-type','text/plain');
    }  

    public function planillaSemanal(Request $request)
    {

        $mes="nov";
        $numMes="11";
        $year="2021";
        $semana1=Planilla::where('fecha', '>=', "$year-$numMes-01")->where('fecha', '<=', "$year-$numMes-07")->sum('total');
        $semana2=Planilla::where('fecha', '>=', "$year-$numMes-08")->where('fecha', '<=', "$year-$numMes-14")->sum('total');
        $semana3=Planilla::where('fecha', '>=', "$year-$numMes-15")->where('fecha', '<=', "$year-$numMes-21")->sum('total');
        $semana4=Planilla::where('fecha', '>=', "$year-$numMes-22")->where('fecha', '<=', "$year-$numMes-31")->sum('total');
     

        $collection = collect([
            ['descripcion' => "01/$mes - 07/$mes", 'total' => $semana1],
            ['descripcion' => "08/$mes - 14/$mes", 'total' => $semana2],
            ['descripcion' => "15/$mes - 21/$mes", 'total' => $semana3],
            ['descripcion' => "22/$mes - 31/$mes", 'total' => $semana4],
        ]);
        
       return response(json_encode($collection),200)->header('Content-type','text/plain');
    } 

    
    public function gastosAnual(Request $request)
    {     
    
        $junio=Gasto::where('fecha', '>=', '2021-06-01')->where('fecha', '<=', '2021-06-30')->sum('total');
        $julio=Gasto::where('fecha', '>=', '2021-07-01')->where('fecha', '<=', '2021-07-31')->sum('total');
        $agosto=Gasto::where('fecha', '>=', '2021-08-01')->where('fecha', '<=', '2021-08-31')->sum('total');
        $septiembre=Gasto::where('fecha', '>=', '2021-09-01')->where('fecha', '<=', '2021-09-31')->sum('total');
        $octubre=Gasto::where('fecha', '>=', '2021-10-01')->where('fecha', '<=', '2021-10-31')->sum('total');
        $noviembre=Gasto::where('fecha', '>=', '2021-11-01')->where('fecha', '<=', '2021-11-30')->sum('total');
     
        $collection = collect([
            ['descripcion' => 'Junio', 'total' => $junio],
            ['descripcion' => 'Julio', 'total' => $julio],
            ['descripcion' => 'Agosto', 'total' => $agosto],
            ['descripcion' => 'Septiembre', 'total' => $septiembre],
            ['descripcion' => 'Octubre', 'total' => $octubre],
            ['descripcion' => 'Noviembre', 'total' => $noviembre],
        ]);

       return response(json_encode($collection),200)->header('Content-type','text/plain');  
    }  






    public function planillaAnual(Request $request)
    {     
       
        $junio=Planilla::where('fecha', '>=', '2021-06-01')->where('fecha', '<=', '2021-06-30')->sum('total');
        $julio=Planilla::where('fecha', '>=', '2021-07-01')->where('fecha', '<=', '2021-07-31')->sum('total');
        $agosto=Planilla::where('fecha', '>=', '2021-08-01')->where('fecha', '<=', '2021-08-31')->sum('total');
        $septiembre=Planilla::where('fecha', '>=', '2021-09-01')->where('fecha', '<=', '2021-09-31')->sum('total');
        $octubre=Planilla::where('fecha', '>=', '2021-10-01')->where('fecha', '<=', '2021-10-31')->sum('total');
        $noviembre=Planilla::where('fecha', '>=', '2021-11-01')->where('fecha', '<=', '2021-11-31')->sum('total');
     
        $collection = collect([
            ['descripcion' => 'Junio', 'total' => $junio],
            ['descripcion' => 'Julio', 'total' => $julio],
            ['descripcion' => 'Agosto', 'total' => $agosto],
            ['descripcion' => 'Septiembre', 'total' => $septiembre],
            ['descripcion' => 'Octubre', 'total' => $octubre],
            ['descripcion' => 'Noviembre', 'total' => $noviembre],
        ]);
       return response(json_encode($collection),200)->header('Content-type','text/plain');
        
    }  
    public function ingresosAnual(Request $request)
    {
        $junio=Ingreso::where('fecha', '>=', '2021-06-01')->where('fecha', '<=', '2021-06-30')->sum('total');
        $julio=Ingreso::where('fecha', '>=', '2021-07-01')->where('fecha', '<=', '2021-07-31')->sum('total');
        $agosto=Ingreso::where('fecha', '>=', '2021-08-01')->where('fecha', '<=', '2021-08-31')->sum('total');
        $septiembre=Ingreso::where('fecha', '>=', '2021-09-01')->where('fecha', '<=', '2021-09-31')->sum('total');
        $octubre=Ingreso::where('fecha', '>=', '2021-10-01')->where('fecha', '<=', '2021-10-31')->sum('total');
        $noviembre=Ingreso::where('fecha', '>=', '2021-11-01')->where('fecha', '<=', '2021-11-31')->sum('total');

        $collection = collect([
            ['descripcion' => 'Junio', 'total' => $junio],
            ['descripcion' => 'Julio', 'total' => $julio],
            ['descripcion' => 'Agosto', 'total' => $agosto],
            ['descripcion' => 'Septiembre', 'total' => $septiembre],
            ['descripcion' => 'Octubre', 'total' => $octubre],
            ['descripcion' => 'Noviembre', 'total' => $noviembre],
        ]);
        
        
       return response(json_encode($collection),200)->header('Content-type','text/plain');
        
    } 



    public function balanceAnual(Request $request)
    {

        $fecha_inicial="2021-01-01";
        $fecha_final="2021-11-31";
       
        $ingresos=Ingreso::where('fecha', '>=', $fecha_inicial)->where('fecha', '<=', $fecha_final)->sum('total');
        $compras=Compra::where('fecha', '>=', $fecha_inicial)->where('fecha', '<=', $fecha_final)->sum('total');
        $gastos=Gasto::where('fecha', '>=', $fecha_inicial)->where('fecha', '<=', $fecha_final)->sum('total');
        $egresos=$compras+$gastos;
        
        $collection = collect([
            ['descripcion' => 'Ingresos', 'total' => $ingresos],
            ['descripcion' => 'Egresos', 'total' => $egresos],
           
        ]);
        
       return response(json_encode($collection),200)->header('Content-type','text/plain');
    } 

   

    public function egresosAnual(Request $request)
    {

        $junioGasto=Gasto::where('fecha', '>=', '2021-06-01')->where('fecha', '<=', '2021-06-30')->sum('total');
        $julioGasto=Gasto::where('fecha', '>=', '2021-07-01')->where('fecha', '<=', '2021-07-31')->sum('total');
        $agostoGasto=Gasto::where('fecha', '>=', '2021-08-01')->where('fecha', '<=', '2021-08-31')->sum('total');
        $septiembreGasto=Gasto::where('fecha', '>=', '2021-09-01')->where('fecha', '<=', '2021-09-31')->sum('total');
        $octubreGasto=Gasto::where('fecha', '>=', '2021-10-01')->where('fecha', '<=', '2021-10-31')->sum('total');
        $noviembreGasto=Gasto::where('fecha', '>=', '2021-11-01')->where('fecha', '<=', '2021-11-30')->sum('total');

        $junioCompra=Compra::where('fecha', '>=', '2021-06-01')->where('fecha', '<=', '2021-06-30')->sum('total');
        $junioCompra=Compra::where('fecha', '>=', '2021-07-01')->where('fecha', '<=', '2021-07-31')->sum('total');
        $agostoCompra=Compra::where('fecha', '>=', '2021-08-01')->where('fecha', '<=', '2021-08-31')->sum('total');
        $septiembreCompra=Compra::where('fecha', '>=', '2021-09-01')->where('fecha', '<=', '2021-09-31')->sum('total');
        $octubreCompra=Compra::where('fecha', '>=', '2021-10-01')->where('fecha', '<=', '2021-10-31')->sum('total');
        $noviembreCompra=Compra::where('fecha', '>=', '2021-11-01')->where('fecha', '<=', '2021-11-30')->sum('total');

        $junio=$junioCompra+$junioGasto;
        $julio= $junioCompra+$julioGasto;
        $agosto= $agostoCompra+$agostoGasto;
        $septiembre=$septiembreCompra+$septiembreGasto;
        $octubre= $octubreGasto+$octubreCompra;
        $noviembre= $noviembreGasto+$noviembreCompra;

        
        $collection = collect([
            ['descripcion' => 'Junio', 'total' => $junio],
            ['descripcion' => 'Julio', 'total' => $julio],
            ['descripcion' => 'Agosto', 'total' => $agosto],
            ['descripcion' => 'Septiembre', 'total' => $septiembre],
            ['descripcion' => 'Octubre', 'total' => $octubre],
            ['descripcion' => 'Noviembre', 'total' => $noviembre],
        ]);
        
        
       return response(json_encode($collection),200)->header('Content-type','text/plain');
    } 

    
    public function comprasCategorias(Request $request)
    {
       
        $fecha_inicial="2021-09-01";
        $fecha_final="2021-11-30";
       
        $compras=[];
        $categorias= CompraCategoria::all();
        $contador= count($categorias);
        
        for($i=0; $i<$contador; $i++)
        {
           $id= $categorias[$i]->id;
           $d= $categorias[$i]->descripcion;
           
           $total= Compra::where('fecha', '>=',  $fecha_inicial)->where('fecha', '<=',  $fecha_final)->where('id_categoria',$id)->sum('total');
           $compras[$i] = Arr::add(['descripcion' => $d], 'total', $total);

        }
       
        return response(json_encode($compras),200)->header('Content-type','text/plain');
       
     
    }  

    public function comprasProveedores(Request $request)
    {
        $fecha_inicial="2021-09-01";
        $fecha_final="2021-11-30";
        $compras=[];
        $proveedores= Proveedor::all();
        $contador= count($proveedores);
        
        for($i=0; $i<$contador; $i++)
        {
           $id= $proveedores[$i]->id_proveedor;
           $d= $proveedores[$i]->descripcion;
           
           $total= Compra::where('fecha', '>=', $fecha_inicial)->where('fecha', '<=', $fecha_final)->where('id_proveedor',$id)->sum('total');
           $compras[$i] = Arr::add(['descripcion' => $d], 'total', $total);

        }
       
        return response(json_encode($compras),200)->header('Content-type','text/plain');
    } 
}
