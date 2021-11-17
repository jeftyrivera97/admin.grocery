@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Historial de Caja</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('caja') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
<div class="container-fluid">
  <br>
  <div class="row">
  <div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
          <th scope="col">Codigo</th>
          <th scope="col">Fecha</th>
          <th scope="col">Hora de Inicio</th>
          <th scope="col">Hora de Cierre</th>
          <th scope="col">Faltante</th>
          <th scope="col">Usuario</th>
        </tr>
    </thead>
    <tbody>   
      @foreach($cajas as $caja)
      <tr>
        <td>{{$caja->id_caja}}</td>
        <td>{{$caja->fecha}}</td>
        <td>{{$caja->fechaHora_inicio}}</td>
        <td>{{$caja->fechaHora_cierre}}</td>
        <td>Lps.{{$caja->faltante}}</td>
        <td>{{$caja->user->name}}</td>
    </tr>
  @endforeach
    </tbody>
</table>
</div>
</div>
</div>
@endsection
