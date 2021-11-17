@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Caja</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('abrirCaja') }}"><button type="button" class="btn btn-primary active btn-sm"> <i class="fas fa-fw fa-plus"></i>Abrir Caja</button></a>
        <a href="{{ route('cajas/historial') }}"><button type="button" class="btn btn-info active btn-sm"> <i class="fas fa-fw fa-eye"></i>Ver Historial</button></a></li>
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
          <span class="info-box-icon bg-success elevation-1">  <i class="fas fa-money-bill-alt"></i></span>
  
          <div class="info-box-content">
          <span class="info-box-text">Venta del Turno:</span>
            <span class="info-box-number">
              L. {{$total}}
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <br>
  <div class="row">
  <div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
          <th scope="col">Codigo</th>
          <th scope="col">Fecha</th>
          <th scope="col">Hora de Inicio</th>
          <th scope="col">Usuario</th>
          <th scope="col">Opciones</th>
         
        </tr>
    </thead>
    <tbody>   
      @foreach($cajas as $caja)
      <tr>
        <td>{{$caja->id_caja}}</td>
        <td>{{$caja->fecha}}</td>
        <td>{{$caja->fechaHora_inicio}}</td>
        <td>{{$caja->user->name}}</td>
        <td><a href="{!! route('caja.edit', $caja->id_caja)!!}"><button type="button" class="btn btn-success active btn-sm"><i class="fas fa-check"></i> Cerrar Caja</button></a></td>
    </tr>
  @endforeach
    </tbody>
</table>
</div>
</div>
</div>
@endsection
