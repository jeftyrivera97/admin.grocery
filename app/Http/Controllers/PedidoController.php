<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use App\Models\Producto;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function crear($id_compra)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 

        $compras=DB::table('compras')->where('id_compra',$id_compra)->first();
        $productos= Producto::where('id_estado','1')->get();
        $pedidos = Pedido::where('id_compra',$id_compra)->orderBy('id_pedido')->get();
        $total = DB::table('pedidos')->where('id_compra',$id_compra)->sum('subtotal');
        return view('pedido.nuevo', compact ('productos','id_compra','pedidos','total','compras'));
    }

    public function guardar(Request $request)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }   
        $validatedData = $request->validate([
            'id_compra' => 'required',
            'id_producto' => 'required',
            'precio_compra' => 'required',
            'cantidad' => 'required',
            
        ]);
        
        $codigo= request('id_producto');
        $existe= DB::table('pedidos')->where('id_producto', $codigo)->exists();
        if($existe==true)
        {
            return redirect()->back()->with(['message' => 'ERROR. Producto ya existe en el pedido.', 'alert' => 'alert-danger']);
            
        }
        DB::beginTransaction();

        try
        {
            
            $id_producto= request('id_producto');
            $id_compra= request('id_compra');
            $info = DB::table('productos')->where('id_producto',$id_producto)->first();
            $compras= DB::table('compras')->where('id_compra',$id_compra)->first();
            $cant= request ('cantidad');
            $precio= request ('precio_compra');
            $tot=$cant*$precio;
            $fechaCompra= $compras->fecha;
           
            $pedidos = new Pedido();
          
            $pedidos-> id_compra = request('id_compra');
            $pedidos-> id_producto = request('id_producto');
            $pedidos-> fecha=$fechaCompra;
            $pedidos-> precio_compra = request('precio_compra');
            $pedidos-> cantidad= request('cantidad');
            $pedidos-> subtotal= $tot;
            DB::Commit();
            $pedidos->save();

            if($pedidos->save())
            {
                
                $id_producto= request('id_producto');
                $id = DB::table('productos')->where('id_producto',$id_producto)->first();
                $precio= request('precio_venta');

                if($precio>0)
                {
                    $precio_venta= $precio;
                    $impuesto= $id->tipo_impuesto;
                    $isv= $precio_venta*$impuesto;
                }else{
                    $precio_venta= $id->precio_venta;
                    $isv= $info->isv;

                }

                $impuesto= $info->impuesto;
                $cantidad= request ('cantidad');
                $valor= $precio_venta*$cantidad;

                $stock = $id->stock;
                $valorActual= $id->valor;
                

                $stockNuevo= $stock+$cantidad;
                $valorNuevo= $stockNuevo*$precio_venta;
              
                $productos =  Producto::findOrFail($id->id_producto);
                $productos-> precio_compra = request ('precio_compra');
                $productos-> precio_venta = $precio_venta;
                $productos-> impuesto = $isv;
                $productos-> stock = $stockNuevo;
                $productos-> valor=$valorNuevo;

                DB::Commit();
                $productos->update();

            }

            return redirect()->back()->with(['message' => 'El producto fue agregado con exito', 'alert' => 'alert-success']);
        }
        catch(\Exception $e)
        {
            DB::Rollback();
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function eliminar($id_pedido)
    {
        
        if(!Auth::check())
        {
            return redirect('/login');
        }
        
        try
        {
            $info = DB::table('pedidos')->where('id_pedido',$id_pedido)->first();
            $id_producto= $info->id_producto;

            $p = DB::table('productos')->where('id_producto',$id_producto)->first();
           
            $cantidadActual= $p->stock;
            $valorActual= $p->valor;
            $precio_venta= $p->precio_venta;

            $cantidadPedido= $info->cantidad;

            $cantidadNueva= $cantidadActual-$cantidadPedido;
            $valorNuevo= $cantidadNueva* $precio_venta;

            DB::beginTransaction();
            $pedidos = Pedido::findOrFail($id_pedido);
            DB::Commit();
            $pedidos->delete();

    
                $productos =  Producto::findOrFail($p->id_producto);
                $productos-> stock = $cantidadNueva;
                $productos-> valor = $valorNuevo;
                DB::Commit();
                $productos->update();
                
            
            return redirect()->back()->with(['message' => 'El producto se ha eliminado del pedido', 'alert' => 'alert-success']);
           
        }
        catch(\Exception $e)
        {
            DB::Rollback();
            echo 'Error: ' .$e->getMessage();
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
