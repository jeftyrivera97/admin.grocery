@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Empleados</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('empleado/create') !!}"><button type="button" class="btn btn-primary active btn-sm"> <i class="fas fa-fw fa-plus"></i>Nuevo</button></a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
<div class="container-fluid">
  <br>
  <div class="row">
  <div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
          <th scope="col">Identidad</th>
          <th scope="col">Nombre</th>
          <th scope="col">Puesto</th>
          <th scope="col">Telefono</th>
          <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>   
      @foreach($empleados as $empleado)
      <tr>
        <td>{{$empleado->codigo_empleado}}</td>
        <td>{{$empleado->nombre}}</td>
        <td>{{$empleado->puesto}}</td>
        <td>{{$empleado->telefono}}</td>

      <td>
   
        <a href="{!! route('empleado.edit', $empleado->id_empleado)!!}"><button type="button" class="btn btn-success active btn-sm"> <i class="fas fa-fw fa-sync-alt"></i>Actualizar</button></a>
        
      </td>
    </tr>
  @endforeach
    </tbody>
</table>
</div>
</div>
</div>
@endsection

