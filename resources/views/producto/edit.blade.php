@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Actualizar: {{$productos->descripcion}} </h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('producto') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Actualizar</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="codigo">Codigo Producto*</label>
                            <input type="text" class="form-control" id="codigo" required name="codigo" value="{{$productos->codigo_producto}}" placeholder="Ingrese Codigo">
                        </div>
                        <form action="{{route('producto.update', $productos->id_producto)}}" method="POST" enctype="multipart/form-data">
                          @method('PATCH')
                          @csrf
               
                          <div class="form-group">
                            <label for="descripcion">Descripcion*</label>
                            <input type="text" class="form-control" id="descripcion" required name="descripcion" value="{{$productos->descripcion}}" placeholder="Ingrese Descripcion">
                            <input type="text" hidden class="form-control" id="codigo_producto" name="codigo_producto" value="{{old('codigo_producto')}}" placeholder="Ingrese Codigo">
                        </div>

                        <div class="form-group">
                          <label for="id_proveedor">*Proveedor Principal</label>
                          <select name="id_proveedor" required  id="id_proveedor" class="form-control">
                            <option value="{{$productos->id_proveedor}}">{{$productos->proveedor->descripcion}}</option>
                            @foreach ($proveedores as $proveedor)
                            <option value="{{$proveedor['id_proveedor']}}"> {{ $proveedor['descripcion'] }} - {{ $proveedor['contacto'] }}</option>
                           @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="tamaño">Tamaño/Medida*</label>
                          <input type="text" id="tamaño" class="form-control" name="tamaño" required value="{{$productos->tamaño}}" placeholder="Ingrese Tamaño o Medida">
                      </div>

                        <div class="form-group"> 
                            <label for="precio_venta">Precio Compra</label>
                        <input class="form-control" type="number" name="precio_compra" value="{{$productos->precio_compra}}" id="precio_venta">   
                        </div>
                        <div class="form-group"> 
                          <label for="precio_venta">Precio Venta</label>
                          <input class="form-control" type="number" name="precio_venta" value="{{$productos->precio_venta}}" id="precio_venta">   
                      </div>
                         
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">     
                            <label for="stock_viejo">Cantidad actual en Inventario </label>
                            <input class="form-control" type="number" name="stock_viejo" readonly value="{{$productos->stock}}" id="stock_viejo">   
                        </div>
                     
                        <div class="form-group">
                            <label for="stock_nuevo">Cantidad Nueva Disponible</label>
                            <input class="form-control" type="number" name="stock_nuevo" id="stock_nuevo" required>   
                        </div>
                     
                        <div class="form-group">
                          <label for="archivo">Imagen:</label><br>
                          <input type="file" name="img" id="img"  focus >
                        </div>
                            
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
</form>
<script>
$(document).ready(function() {

document.getElementById("codigo").focus();
var cod= document.getElementById("codigo").value;
document.getElementById("codigo_producto").value=cod;

$('#codigo').change(function() {
    document.getElementById("descripcion").focus();
    var cod= document.getElementById("codigo").value;
    document.getElementById("codigo_producto").value=cod;
    });
   
 });
</script>

@endsection



