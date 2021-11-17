@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Nuevo Folio</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('folio') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')

<form action="/folio" method="POST"> 
  @csrf
<div class="container-fluid">
<div class="row">
    <div class="col-xl-6 col-lg-12">
        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Datos</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                      <label>N° Inicial</label>
                      <input type="number" class="form-control input-rounded" required placeholder="" id="inicio"  name="inicio">
                    </div>
                    <div class="form-group col-md-6">
                        <label>N° Final</label>
                        <input type="number" class="form-control input-rounded" required placeholder="" id="final"  name="final">
                      </div>
              
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label>Fecha Inicial</label>
                        <input type="date" class="form-control input-rounded" required placeholder="" id="fecha_inicial"  name="fecha_inicial">
                      </div>
                      <div class="form-group col-md-6">
                          <label>Fecha Final</label>
                          <input type="date" class="form-control input-rounded" required placeholder="" id="fecha_final"  name="fecha_final">
                        </div>
                  </div>
                    
            </div>
              <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info active"><i class="far fa-save"></i> Guardar</button>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
</div>
</form>
@endsection			