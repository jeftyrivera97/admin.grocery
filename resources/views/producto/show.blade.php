@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Producto</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('producto') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
<div class="container-fluid">
  <div class="card card-info" style="width: 18rem;">
    <div class="card-header">
      <b>Producto: {{ $productos->descripcion}}</b>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><b>Codigo:</b> {{$productos->codigo_producto}}</li>
    <li class="list-group-item"><b>Descripcion:</b> {{$productos->descripcion}}</li>
    <li class="list-group-item"><b>Categoria:</b> {{$productos->categoria}}</li>
    <li class="list-group-item"><b>Disponible:</b> {{$productos->stock}}</li>
    <li class="list-group-item"><b>Precio de Venta:</b> {{$productos->precio_venta}}</li>
  </ul>
</div>
</div>
@endsection