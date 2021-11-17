@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Proveedores</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"> <a href="{!! url('proveedor/create') !!}"><button type="button" class="btn btn-primary active btn-sm"> <i class="fas fa-fw fa-plus"></i>Nuevo</button></a></li>
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
          <th scope="col">RTN</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Categoria</th>
          <th scope="col">Contacto</th>
          <th scope="col">Telefono</th>
          <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>   
      @foreach($proveedores as $proveedor)
      <tr>
        <td>{{$proveedor->codigo_proveedor}}</td>
        <td>{{$proveedor->descripcion}}</td>
        <td>{{$proveedor->categoria}}</td>
        <td>{{$proveedor->contacto}}</td>
        <td>{{$proveedor->telefono}}</td>
      <td>
   
        <a href="{{ route('proveedor.edit', $proveedor->id_proveedor)}}"><button type="button" class="btn btn-success active btn-sm"> <i class="fas fa-fw fa-sync-alt"></i>Actualizar</button></a>
        
      </td>
    </tr>
  @endforeach
    </tbody>
</table>
</div>
</div>
</div>
@endsection

