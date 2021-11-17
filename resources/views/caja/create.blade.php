@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Abrir Caja</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('caja') }}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regrbbesar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')

<form action="/caja" method="POST">
  @csrf
  <div class="container pt-3">
    <div class="row">
      <div class="col-sm-4">

        <div class="form-group">
          <label for="descripcion">Fecha de Venta</label>
          <input class="form-control" type="text" name="fecha" id="fecha" value="{{$fecha}}" readonly></textarea>
        </div> 

        <div class="form-group">
          <label for="descripcion">Hora de Apertura</label>
          <input class="form-control" type="text" name="fecha" id="fecha" value="{{$hora}}" readonly></textarea>
        </div> 
        
        <div class="form-group">
          <button type="submit" class="btn btn-success active"><i class="far fa-save"></i> Guardar</button>
        </div>
      </div>
      </div>
  </div>
</form>




  

@endsection
