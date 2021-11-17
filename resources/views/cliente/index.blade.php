@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Clientes</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item">  <a href="{{ url('cliente/create') }}"><button type="button" class="btn btn-primary active btn-sm"> <i class="fas fa-fw fa-plus"></i>Nuevo</button></a> 
          <a href="{!! url('transaccion/create') !!}"><button type="button" class="btn btn-danger active btn-sm"><i class="fas fa-fw fa-plus"></i>Nuevo Credito</button></a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
<div class="container-fluid">
  <div class="row">
  <div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
          <th scope="col">RTN</th>
          <th scope="col">Nombre</th>
          <th scope="col">Telefono</th>
          <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>   
      @foreach($clientes as $cliente)
      <tr>
        <td>{{$cliente->codigo_cliente}}</td>
        <td>{{$cliente->nombre}}</td>
        <td>{{$cliente->telefono}}</td>
      <td>
        <a href="{!! route('transaccion.show', $cliente->id_cliente)!!}"><button type="button" class="btn btn-info active btn-sm"> <i class="fas fa-fw fa-eye"></i>Ver Credito</button></a>
        <a href="{!! route('cliente.edit', $cliente->id_cliente)!!}"><button type="button" class="btn btn-success active btn-sm"> <i class="fas fa-fw fa-sync-alt"></i>Actualizar</button></a>
      </td>
  
    </tr>
  @endforeach
    </tbody>
</table>
</div>
</div>
</div>
@endsection

