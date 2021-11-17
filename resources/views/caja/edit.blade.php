@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Cerrar Caja</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('caja') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')

<form action="{!!route('caja.update', $cajas->id_caja)!!}" method="POST">
    @method('PATCH')
    @csrf
    <div class="container pt-3">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="codigo_compra">*Usuario</label>
                <input type="text" class="form-control" name="codigo_compra" readonly value="{{$cajas->user->name}}" >
            </div>
            
            <div class="form-group">
                <label for="codigo_compra">*Fecha & Hora Apertura de Caja</label>
                <input type="text" class="form-control" name="codigo_compra" readonly value="{{$cajas->fechaHora_inicio}}" >
            </div>
           
            <div class="form-group">
              <label for="codigo_compra">*Total Vendido POS</label>
              <input type="text" class="form-control" name="total_pos" id="total_pos" readonly value="L. {{$pos}}" >
            </div>
            <div class="form-group">
              <label for="codigo_compra">*Total Vendido EFECTIVO</label>
              <input type="text" class="form-control" name="total_efectivo" id="total" readonly value="L. {{$efectivo}}" >
            </div>
           
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="codigo_compra">*Total</label>
            <input type="text" class="form-control" name="total" id="total" readonly value="L. {{$total}}" >
            <input type="text" class="form-control" name="total_e" id="total_e" hidden value="{{$efectivo}}">
            <input type="text" class="form-control" name="total_p" id="total_p" hidden value="{{$pos}}" >
            <input type="text" class="form-control" name="total_caja" id="total_caja" hidden value="{{$total}}" >
          </div>

          <div class="form-group">
            <label for="descripcion">*Descripcion</label>
            <select id="descripcion" class="form-control" value="{{old('descripcion')}}" name="descripcion" placeholder="Seleccione Tipo">
                <option value="">--Selecione--</option>
                <option value="Corte Turno">Corte Turno</option>
                <option value="Corte Turno A">Corte Turno A</option>
                <option value="Corte Turno B">Corte Turno B</option>
                <option value="Corte del Dia">Corte del dia</option>
            </select> 
          </div>

          <div class="form-group">
            <label for="caja">*Total en POS</label>
            <input type="number" class="form-control" placeholder="0.00" name="pos" id="pos" placeholder="Ingrese el monto" >
          </div>
          <div class="form-group">
            <label for="caja">*Total en Efectivo</label>
            <input type="number" class="form-control" placeholder="0.00" name="caja" id="caja" placeholder="Ingrese el monto" >
          </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success active"><i class="far fa-save"></i> Guardar</button>
        </div>
        </div>
           
    </div>
</div>
</form>


@endsection



