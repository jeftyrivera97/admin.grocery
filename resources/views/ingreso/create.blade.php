@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Nueva Venta</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('venta') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')

<form action="/venta" method="POST">
  @csrf
  <div class="container pt-3">
    <div class="row">
      <div class="col-sm-4">

        <div class="form-group">
          <label for="descripcion">Fecha de Venta</label>
        <input class="form-control" type="text" required name="fecha" id="fecha" value="{{$fecha}}" readonly></textarea>
      </div> 
        
        <div class="form-group">         
          <label for="total">Total*</label>
          <input class="form-control" type="number" required step="any" placeholder="0.00" name="total" id="total" value="">   
        </div>

        <div class="form-group">
          <label for="descripcion">*Descripcion</label>
          <select id="descripcion" class="form-control" required value="{{old('tipo')}}" name="descripcion" placeholder="Seleccione Tipo">
              <option value="">--Selecione--</option>
              <option value="Corte Turno A">Corte Turno A</option>
              <option value="Corte Turno B">Corte Turno B</option>
              <option value="Corte del Dia">Corte del dia</option>
          </select> 
      </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-success active"><i class="far fa-save"></i> Guardar</button>
          
        </div>

      
      </div> 

      </div>
  </div>
</form>




  

@endsection
