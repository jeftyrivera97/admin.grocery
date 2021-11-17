@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Gasto</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('gasto') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
<div class="container-fluid">
  <div class="card card-info" style="width: 18rem;">
    <div class="card-header">
      <b>Gasto de: {{ $gastos->descripcion}}</b>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><b>Codigo:</b> {{$gastos->id_gasto}}</li>
    <li class="list-group-item"><b>N° Factura/Referencia:</b> {{$gastos->codigo_gasto}}</li>
    <li class="list-group-item"><b>Categoria:</b> {{$gastos->categoria}}</li>
    <li class="list-group-item"><b>Fecha:</b> {{$gastos->fecha}}</li>
    <li class="list-group-item"><b>Descripcion:</b> {{$gastos->descripcion}}</li>
    <li class="list-group-item"><b>Total:</b> L. {{$gastos->total}}</li>
  </ul>
</div>
</div>
@endsection
