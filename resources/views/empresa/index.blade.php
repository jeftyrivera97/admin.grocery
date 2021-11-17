@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Informacion General de la Empresa</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/') }}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
<div class="container pt-3">
    <div class="card" style="width: 30rem;">
    <div class="card-header">
      <b>{{ $empresas->descripcion}}</b>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><b>Plan: </b> SIE-STORE ULTIMATE</li>
      <li class="list-group-item"><b>RTN:</b> {{$empresas->codigo_empresa}}</li>
      <li class="list-group-item"><b>Nombre de la Empresa:</b> {{$empresas->descripcion}}</li>
      <li class="list-group-item"><b>Direccion:</b> {{$empresas->direccion}}</li>
      <li class="list-group-item"><b>Telefono:</b> {{$empresas->telefono}}</li>
    </ul>
  </div>
 
  </div>

  @endsection

