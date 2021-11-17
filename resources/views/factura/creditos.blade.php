@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Comprobantes Creditos</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('factura') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
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
        <span class="info-box-icon bg-warning elevation-1">  <i class="fas fa-file-invoice-dollar"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">Total Creditos:</span>
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
          <th scope="col">Codigo Comprobante</th>
          <th scope="col">Fecha & Hora</th>
          <th scope="col">Cliente</th>
          <th scope="col">Tipo Pago</th>
          <th scope="col">Saldo</th>
          <th scope="col">Usuario</th>
          <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>   
      @foreach($creditos as $credito)
      <tr>
        <td>{{$credito->factura->codigo_factura}}</td>
        <td>{{$credito->factura->fechaHora}}</td>
        <td>{{$credito->factura->cliente->nombre}}</td>
        <td>{{$credito->factura->tipo_pago}}</td>
        <td>L. {{$credito->saldo}}</td>
        <td>{{$credito->factura->user->name}}</td>
        <td> <a href="{{ route('transaccion/abonar', $credito->factura->id_factura)}}"><button type="button" class="btn btn-success active btn-sm"> <i class="fas fa-fw fa-sync-alt"></i>Actualizar</button></a></td>
        
     </td>
    </tr>
  @endforeach
    </tbody>
</table>

</div>
</div>
</div>
@endsection

