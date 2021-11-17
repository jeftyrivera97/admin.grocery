@extends('layouts.app')
  @section('header')
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Informacion General de la Empresa</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{!! url('/') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
        </ol>
      </div>
    </div>
  </div>
  @endsection 
  @section('content')
  
  <form action="/empresa" method="POST"> 
    @csrf
  <div class="container-fluid">
  <div class="row">
      <div class="col-xl-6 col-lg-12">
          <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">Datos Generales</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                  <div class="row">
                      <div class="form-group col-md-6">
                        <label>Nombre de la Empresa</label>
                        <input type="text" class="form-control input-rounded" required value="{{$empresas->descripcion}}" id="descripcion"  name="descripcion">
                        <input type="text" class="form-control input-rounded" hidden value="{{$empresas->id_empresa}}" id="id_empresa"  name="id_empresa">
                      </div>

                      <div class="form-group col-md-6">
                        <label>Razon Social</label>
                        <input type="text" class="form-control input-rounded" required value="{{$empresas->razon_social}}" id="razon_social"  name="razon_social">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label>Direccion</label>
                        <input type="text" class="form-control input-rounded" required value="{{$empresas->direccion}}" id="direccion"  name="direccion">
                      </div>

                      <div class="form-group col-md-6">
                        <label>Telefono</label>
                        <input type="text" class="form-control input-rounded" required value="{{$empresas->telefono}}" id="telefono"  name="telefono">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label>Correo</label>
                        <input type="text" class="form-control input-rounded" required value="{{$empresas->correo}}" id="correo"  name="correo">
                      </div>

                      <div class="form-group col-md-6">
                        <label>CAI</label>
                        <input type="text" class="form-control input-rounded" required value="{{$empresas->cai}}" id="cai"  name="cai">
                      </div>
                    </div>
              </div>
                <!-- /.card-body -->
              <div class="card-footer">
                  <button type="submit" class="btn btn-info active"><i class="far fa-save"></i> Guardar Cambios</button>
              </div>
          </div>
          <!-- /.card -->
      </div>
  </div>
  </div>
  
  @endsection			