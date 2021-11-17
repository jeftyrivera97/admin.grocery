@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Productos</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('producto/create') !!}"><button type="button" class="btn btn-primary active btn-sm"> <i class="fas fa-fw fa-plus"></i>Nuevo</button></a></li>
      
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
<div class="container-fluid">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-success elevation-1"> <i class="fas fa-clipboard-list"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">En Inventario:</span>
          <span class="info-box-number">
            L. {{$valor}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"> <i class="fas fa-list-ol"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">Cantidad Productos:</span>
          <span class="info-box-number">
            {{$contador}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

  </div>
</div>
<div class="container-fluid">
<div class="row">
  <div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th scope="col">Codigo Barras</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Tamaño/Medida</th>
          <th scope="col">Marca</th>
          <th scope="col">Categoria</th>
          <th scope="col">Proveedor Principal</th>
          <th scope="col">Stock</th>
          <th scope="col">Precio Compra</th>
          <th scope="col">Tipo Impuesto</th>
          <th scope="col">Gravado</th>
          <th scope="col">Impuesto</th>
          <th scope="col">Precio Venta</th>
          <th scope="col">Imagen</th>
          <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>   
      @foreach($productos as $producto)
      <tr>
        <td>{{$producto->codigo_producto}}</td>
        <td>{{$producto->descripcion}}</td>
        <td>{{$producto->tamaño}}</td>
        <td>{{$producto->marca}}</td>
        <td>{{$producto->productoCategoria->descripcion}}</td>
        <td>{{$producto->proveedor->descripcion}}</td>
        <td>{{$producto->stock}}</td>
        <td>L. {{number_format ($producto->precio_compra,2)}}</td>
        <td>{{$producto->tipoImpuesto->descripcion}}</td>
        <td>L. {{number_format ($producto->gravado,2)}}</td>
        <td>L. {{number_format ($producto->impuesto,2)}}</td>
        <td>L. {{number_format ($producto->precio_venta,2)}}</td>
        <td> <img src="{{asset($producto->ruta_imagen)}}" alt="" width="50" height="50"> </td>
      <td>
        <a href="{!! route('producto.edit', $producto->id_producto)!!}"><button type="button" class="btn btn-success active btn-sm"> <i class="fas fa-edit"></i></button></a>
        <a href="{!! route('producto.show', $producto->codigo_producto)!!}"><button type="button" class="btn btn-info active btn-sm"> <i class="fas fa-fw fa-eye"></i></button></a>
        <a href="{!! route('producto-desactivar', $producto->id_producto)!!}"><button type="button" class="btn btn-danger active btn-sm"><i class="fas fa-trash-alt"></i></button></a>
      </td>
    </tr>
  @endforeach
    </tbody>
</table>
</div>
</div>
</div>
<div class="container-fluid">
  <div class="row">
      <div class="col-sm-3">
        <div class="form-group">
          <label for="import">Importar Productos (Excel .xlsx)</label>
        <form action="{{ route('import-excel') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" name="file" class="form-control">
          <button class="btn btn-success active btn-sm">Importar</button>
        </form>
      </div>
      </div>
</div>
</div>

@endsection
