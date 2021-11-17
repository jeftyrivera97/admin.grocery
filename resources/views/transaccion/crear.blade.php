@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Abonar Factura</h1>
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


<form action="{!!route('transaccion/guardar')!!}" method="POST">
    @csrf
    <div class="container pt-3">
    <div class="row">
        <div class="col-sm-4">

            <div class="form-group">
                <label for="total">*Cliente </label>
            <input class="form-control" type="text" name="nombre" id="nombre" value="{{$facturas->cliente->nombre}}" readonly>
            <input class="form-control" hidden type="text" name="id_cliente" id="id_cliente" value="{{$facturas->cliente->id_cliente}}" readonly>
            
            </div>

            <div class="form-group">
            <label for="total">* Comprobante Credito </label>
            <input class="form-control" type="text" name="nombre" id="codigo_factura" value="{{$facturas->codigo_factura}}" readonly>
            <input class="form-control" hidden type="text" name="id_factura" id="id_factura" value="{{$facturas->id_factura}}">
            
            </div>

            <div class="form-group">
              <label for="total">*Saldo Factura </label>
              <input class="form-control" type="text" name="nombre" id="codigo_factura" value="L.{{$saldo}}" readonly>            
              </div>

                <div class="form-group">
                    <label for="total">*Total a Pagar </label>
                    <input class="form-control" required type="number" step="any" placeholder="0.00" name="total" id="total">   
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success active"><i class="far fa-save"></i> Guardar</button>  
                </div>
        </div>
        </div>
    </div>
</form>
@endsection



