<?php

namespace App\Http\Controllers;

Use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UserFormRequest;
use App\Models\Producto;
use App\Models\Productoo;
use App\Models\Proveedor;
use App\Models\Impuesto;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\ProductoCategoria;
use App\Imports\ProductosImport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use function GuzzleHttp\Promise\each;

class ProductoController extends Controller
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
        $contenido=Producto::where('id_estado',1)->where('stock','>',0)->orderBy('id_producto')->get();
        $num=DB::table('productos')->where('id_estado',1)->where('stock','>',0)->count();
        $valor=0;
        
        for($i=0;$i<$num;$i++)
        {
            $pr=$contenido[$i]->precio_venta;
            $st=$contenido[$i]->stock;
            $valor+=$pr*$st;
        }
        $productos= 
        $contador= Producto::where('id_estado',1)->sum('stock');

        $productos = Producto::where('id_estado',1)->orderBy('id_producto')->get();
     
      
        return view('producto.index', compact('productos','valor','contador'));
    }

    
    public function buscar(Request $request)
    {
        $codigo_producto= request('busqueda');

        $existe= DB::table('productos')->where('codigo_producto', $codigo_producto)->exists();
        if($existe==true)
        {
            $productos = Producto::where('codigo_producto',$codigo_producto)->first();
            return view('producto.busqueda', compact('productos'));
            
            
        }else{
            return view ('producto.noFind');
        }

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
        $proveedores = Proveedor::where('id_estado','1')->get();
        $categorias = ProductoCategoria::all();
        $impuestos = Impuesto::where('id_estado',1)->get();
        return view('producto.create',compact('proveedores','categorias','impuestos'));
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
            'codigo_producto' => 'required',
            'descripcion' => 'required',
            'id_categoria' => 'required',
            'precio_venta' => 'required|numeric|min:1',
            'stock' => 'required|numeric',
            'marca' => 'required',
            'id_impuesto' => 'required',
            'id_proveedor' => 'required',
            
        ]);

        $codigo= request('codigo_producto');
        $existe= DB::table('productos')->where('codigo_producto', $codigo)->exists();
        if($existe==true)
        {
            return redirect()->back()->with(['message' => 'ERROR. Producto ya existe. Cambie el Codigo del Producto.', 'alert' => 'alert-danger']);
            
        }

        DB::beginTransaction();

        try
        {
          
            
            $precio=request ('precio_venta');
            $id_impuesto=request ('id_impuesto');
            $isv=0;
            $exento=0;
            $gravado=0;

            if($id_impuesto=="1")
            {
                $isv=0;
                $gravado=0;
                $exento=$precio;
            }else{
                
                $impuesto=Impuesto::where('id_impuesto',$id_impuesto)->first();
                $val=$impuesto->valor;
                $gravado= $precio / $val;
                $isv= $precio-$gravado;
                $exento=0;
            }
         

            $productos = new Producto();
            $productos-> codigo_producto = request ('codigo_producto');
            $productos-> descripcion = request ('descripcion');
            $productos-> id_categoria = request ('id_categoria');
            $productos-> precio_compra = request ('precio_compra');
            $productos-> precio_venta = request ('precio_venta');
            $productos-> stock = request ('stock');
            $productos-> marca = request ('marca');
            $productos-> tamaño = request ('tamaño');
            $productos-> id_impuesto = $id_impuesto;
            $productos-> gravado = $gravado;
            $productos-> impuesto = $isv;
            $productos-> exento = $exento;
            $productos-> id_estado= 1;
            $productos-> id_proveedor= request('id_proveedor');
            $p= request ('precio_venta');
            $s=request ('stock');
            $nombre= request('descripcion');
           
            $v=$p*$s;
            $productos-> valor=$v;


            DB::Commit();
            $productos->save();
           // return redirect('/producto');
           return redirect()->back()->with(['message' => 'El producto fue creado con exito', 'alert' => 'alert-success']);
           
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
    public function show($codigo_producto)
    {
        $productos = Producto::where('codigo_producto',$codigo_producto)->first();
        return view('producto.show', compact('productos'));
    }


    public function desactivar($id_producto)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        }   

        $productos = Producto::find($id_producto);
        $productos-> id_estado= 2;
        $productos->save();

       return redirect()->back()->with(['message' => 'El producto fue borrado con exito', 'alert' => 'alert-danger']);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_producto)
    {
        if(!Auth::check())
        {
            return redirect('/login');
        } 

        $proveedores = Proveedor::where('id_estado',1)->get();
        $productos= Producto::find($id_producto);

        return view('producto.edit', compact('proveedores','productos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_producto)
    {
          
          
        if(!Auth::check())
        {
            return redirect('/login');
        }   
        $validatedData = $request->validate([

            'precio_venta' => 'required',
            'stock_nuevo' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();
        try
        {

            $imagen = $request->file('img');

            if($imagen!="")
            {
                $nombre = $imagen->getClientOriginalName();
                $random = Str::random(15);
                $nombre = "$random$nombre";
                $path = $request->file('img')->storeAs(
                    'productos',
                    $nombre,
                    'public'
                );
                $url = "/storage/app/public/productos/$nombre";
            }else{$url="";}
          

            $info =  Producto::where('id_producto',$id_producto)->first();
            $id_impuesto= $info->id_impuesto;
            $exento=0;
            $isv=0;


            $sa=request ('stock_nuevo');
            $pv= request ('precio_venta');
            if($id_impuesto=="1")
            {
                $isv=0;
                $gravado=0;
                $exento=$pv;
            }else{
                
                $impuesto=Impuesto::where('id_impuesto',$id_impuesto)->first();
                $val=$impuesto->valor;
                $gravado= $pv / $val;
                $isv= $pv-$gravado;
                $exento=0;
            }

            $val=$pv*$sa;
    
            $productos =  Producto::findOrFail($id_producto);
            $productos-> precio_venta = request ('precio_venta');
            $productos-> precio_compra = request ('precio_compra');
            $productos-> codigo_producto = request ('codigo_producto');
            $productos-> descripcion = request ('descripcion');
            $productos-> id_proveedor = request ('id_proveedor');
            $productos-> tamaño = request ('tamaño');
            $productos-> stock = $sa;
            $productos-> valor=$val;
            $productos-> exento=$exento;
            $productos-> impuesto=$isv;
            $productos-> gravado=$gravado;
            $productos-> ruta_imagen = $url;

            DB::Commit();
            $productos->update();
           return redirect()->back()->with(['message' => 'El producto fue actualizado con exito', 'alert' => 'alert-success']);
          
        }
        catch(\Exception $e)
        {
            DB::Rollback();
            echo 'Error: ' .$e->getMessage();
        }
    }

    public function import(Request $request) 
    {
        $file= $request->file('file');
        Excel::import(new ProductosImport, $file);
        
        return redirect()->back()->with(['message' => 'Los productos fueron importados con exito', 'alert' => 'alert-success']);
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
