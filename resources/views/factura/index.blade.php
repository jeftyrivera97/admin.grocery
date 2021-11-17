@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Facturas</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('factura/create') !!}"><button type="button" class="btn btn-primary active btn-sm"> <i class="fas fa-fw fa-plus"></i>Nueva Factura</button></a>
          <a href="{!! route('facturas/creditos') !!}"><button type="button" class="btn btn-success active btn-sm">Comprobantes Creditos</button></a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
<div class="container-fluid">
  <br>
  <div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
          <th scope="col">Codigo Factura</th>
          <th scope="col">Fecha & Hora</th>
          <th scope="col">Cliente</th>
          <th scope="col">Tipo Pago</th>
          <th scope="col">Total</th>
          <th scope="col">Usuario</th>
          <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>   
      @foreach($facturas as $factura)
      <tr>
        <td> 000-001-01-{{ str_pad ($factura->codigo_factura, 8, '0', STR_PAD_LEFT) }}</td>
        <td>{{$factura->fechaHora}}</td>
        <td>{{$factura->cliente->nombre}}</td>
        <td>{{$factura->tipo_pago}}</td>
        <td>Lps.{{$factura->total}}</td>
        <td>{{$factura->user->name}}</td>
        <td><a href="{!! route('facturaImprimir', $factura->id_factura)!!}"><button type="button" class="btn btn-info active btn-sm"><i class="fas fa-print"></i>Imprimir</button></a></td>
    </tr>
  @endforeach
    </tbody>
</table>

</div>
</div>
</div>
@endsection

