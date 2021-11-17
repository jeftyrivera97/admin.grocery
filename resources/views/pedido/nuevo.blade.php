@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Pedido</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('compra') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
<form action="{!!route('crearPedido')!!}" method="POST">
    @csrf
    <div class="container-fluid">
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="id_compra">Total Ingresado:</label>
          <input type="text" class="form-control" name="id_compra" value="L. {{$total}}" readonly>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="codigo_compra">Total Factura:</label>
          <input type="text" class="form-control" name="codigo_compra" value="L. {{$compras->total}}" readonly>
          <input id="id_compra" name="id_compra" type="hidden" value="{{$compras->id_compra}}">
        </div>
      </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-2">
          <div class="form-group">
            <label for="codigo_compra">*N° Factura</label>
            <input type="text" class="form-control" name="codigo_compra" value="{{$compras->codigo_compra}}" readonly>
          </div>
        </div>
  
        <div class="col-sm-4">
          <div class="form-group">
            <label for="id_producto">*Producto</label>
            <select name="id_producto" input type="text" required class="form-control" name="id_producto">
              <option value="">--Seleccione el Producto--</option>
              @foreach ($productos as $producto)
              <option value="{{ $producto['id_producto'] }}">{{$producto['descripcion'] }} -Precio: L.{{$producto['precio_venta'] }}</option>
              @endforeach
            </select>
          </div>
        </div>
        
        <div class="col-sm-1">
          <div class="form-group"> 
            <label for="total">*Cantidad</label>
            <input class="form-control" type="number" required step="any" placeholder="0"name="cantidad" id="cantidad" value="">   
          </div>
        </div>
  
        <div class="col-sm-2">
          <div class="form-group"> 
            <label for="total">*Precio de Compra</label>
            <input class="form-control" type="number" required step="any" placeholder="0.00"name="precio_compra" id="precio_compra" value="">   
          </div>
        </div>
          
        <div class="col-sm-2">
          <div class="form-group"> 
            <label for="total">Precio de Venta</label>
            <input class="form-control" type="number" step="any" placeholder="" name="precio_venta" id="precio_venta" value="">   
          </div>
           
          <div class="form-group">
            <button type="submit" class="btn btn-success active btn-sm"><i class="fas fa-plus"></i> Agregar</button>
          </div>
        </div>
      </div>
</form>
<br>
<div class="row">
    <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
            <th scope="col">Codigo Producto</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio Compra</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Opciones</th>
          </tr>
      </thead>
      <tbody>
        @foreach($pedidos as $pedido)   
        <tr>
          <td>{{$pedido->producto->codigo_producto}}</td>
          <td>{{$pedido->producto->descripcion}}</td>
          <td>{{$pedido->cantidad}}</td>
          <td>L. {{$pedido->precio_compra}}</td>
          <td>L. {{$pedido->subtotal}}</td>
          <td> 
            <form action=" {!!route('eliminarProducto', $pedido->id_pedido) !!}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger active btn-sm"> <i class="fas fa-fw fa-minus"></i>Eliminar</button>
            </form></td>
      </tr>
      @endforeach
      </tbody>
  </table>
    </div>
</div>
</div>

@endsection