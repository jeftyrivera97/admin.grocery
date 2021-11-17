@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Historial de Transacciones</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"> <a href="{!! url('cliente') !!}" class="btn btn-warning active  btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3">
      <div class="form-group">
        <label for="codigo_compra">Cliente:</label>
        <input type="text" class="form-control" name="nombre" value="{{$nombres->nombre}} " readonly>
      </div>
     
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <label for="codigo_compra">Saldo:</label>
        <input type="text" class="form-control" name="nombre" value="L. {{$creditos->saldo}} " readonly>
      </div>
     
    </div>
  </div>
  <div class="row">
    <div class="table-responsive">
      <table id="example1" class="table table-striped table-bordered" style="width:100%">
      <thead>
          <tr>
            <th scope="col">Codigo</th>
            <th scope="col">Fecha</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Tipo Transaccion</th>
            <th scope="col">Monto</th>
            <th scope="col">Saldo</th>
            <th scope="col">Usuario</th>
          </tr>
      </thead>
      <tbody>
        @foreach($transacciones as $transaccion)   
        <tr>
          <td>{{$transaccion->id_transaccion}}</td>
          <td>{{$transaccion->fecha}}</td>
          <td>{{$transaccion->descripcion}}</td>
          <td>{{$transaccion->tipo_transaccion}}</td>
          <td>L. {{$transaccion->total}}</td>
          <td>{{$transaccion->saldo}}</td>
          <td>{{$transaccion->user->name}}</td>
      </tr>
      @endforeach
      </tbody>
  </table>
  </div>
</div>
  </div>
  @endsection


