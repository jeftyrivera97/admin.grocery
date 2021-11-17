@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Factura N° {{$compras->codigo_compra}} </h1>
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
<div class="container-fluid">
  <div class="card card-info" style="width: 18rem;">
    <div class="card-header">
    <b>Compra de: {{$compras->compraCategoria->descripcion}}</b>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><b>Codigo:</b> {{$compras->id_compra}}</li>
      <li class="list-group-item"><b>Factura:</b> {{$compras->codigo_compra}}</li>
      <li class="list-group-item"><b>Fecha:</b> {{$compras->fecha}}</li>
      <li class="list-group-item"><b>Tipo de Pago:</b> {{$compras->cuenta->descripcion}}</li>
      <li class="list-group-item"><b>Estado:</b> {{$compras->estado->descripcion}}</li>
      <li class="list-group-item"><b>Fecha de Pago:</b> {{$compras->fecha_pago}}</li>
      <li class="list-group-item"><b>Categoria:</b> {{$compras->compraCategoria->descripcion}}</li>
      <li class="list-group-item"><b>Proveedor:</b> {{$compras->proveedor->descripcion}}</li>
      <li class="list-group-item"><b>Total:</b> L. {{$compras->total}}</li>
  </ul>
</div>

</div>

@endsection