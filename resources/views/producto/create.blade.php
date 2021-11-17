@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Nuevo Producto</h1>
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
                  <h3 class="card-title">Nuevo Producto</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="codigo">Codigo Producto*</label>
                            <input type="text" class="form-control" id="codigo" required name="codigo" value="{{old('codigo_producto')}}" placeholder="Ingrese Codigo">
                        </div>
                        <form action="/producto" method="POST">
                            @csrf
            
                        <div class="form-group">
                            <label for="descripcion">Descripcion*</label>
                            <input type="text" class="form-control" id="descripcion" required name="descripcion" value="{{old('descripcion')}}" placeholder="Ingrese Descripcion">
                            <input type="text" hidden class="form-control" id="codigo_producto" name="codigo_producto" value="{{old('codigo_producto')}}" placeholder="Ingrese Codigo">
                        </div>
            
                        <div class="form-group">
                            <label for="descripcion">Marca*</label>
                            <input type="text" class="form-control" name="marca" required value="{{old('marca')}}" placeholder="Ingrese Marca">
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria*</label>
                            <select id="categoria" class="form-control" required value="{{old('id_categoria')}}" name="id_categoria" placeholder="Seleccione Categoria">
                                <option value="">--Selecione--</option>
                                @foreach ($categorias as $categoria)
                              <option value="{{$categoria['id']}}"> {{ $categoria['descripcion'] }}</option>
                             @endforeach
                            </select> 
                        </div>
                        <div class="form-group">
                            <label for="id_proveedor">Proveedor Principal*</label>
                            <select name="id_proveedor" required  id="id_proveedor" class="form-control">
                              <option value="">--Selecione--</option>
                              @foreach ($proveedores as $proveedor)
                              <option value="{{$proveedor['id_proveedor']}}"> {{ $proveedor['descripcion'] }} - {{ $proveedor['contacto'] }}</option>
                             @endforeach
                            </select>
                         </div>
                       
                      </div>
                      <div class="col-sm-6">

                        <div class="form-group">
                          <label for="tamaño">Tamaño/Medida*</label>
                          <input type="text" id="tamaño" class="form-control" name="tamaño" required value="{{old('tamaño')}}" placeholder="Ingrese Tamaño o Medida">
                      </div>

                        <div class="form-group">     
                            <label for="stock">Cantidad Disponible*</label>
                            <input class="form-control" type="number" required step="any" placeholder="0" name="stock" id="stock">
                        </div>
                        
                        <div class="form-group">
                            <label for="id_impuesto"> Tipo Impuesto*</label>
                            <select id="id_impuesto" class="form-control" required value="{{old('id_impuesto')}}" name="id_impuesto" placeholder="Seleccione Presentacion">
                                <option value="">--Selecione--</option>
                                @foreach ($impuestos as $impuesto)
                                <option value="{{$impuesto['id_impuesto']}}"> {{ $impuesto['descripcion'] }} - {{ $impuesto['valor'] }}</option>
                               @endforeach
                            </select> 
                        </div>
                        <div class="form-group">
                                  
                            <label for="precio_compra">Precio Compra</label>
                            <input class="form-control" type="number" step="any" placeholder="0.00" name="precio_compra" id="precio_compra">   
                        </div>
                        <div class="form-group">
                                  
                            <label for="precio_venta">*Precio Venta</label>
                            <input class="form-control" type="number" required step="any" placeholder="0.00" name="precio_venta" id="precio_venta">   
                            
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




<script>
$(document).ready(function() {

document.getElementById("codigo").focus();

$('#codigo').change(function() {
    document.getElementById("descripcion").focus();
    var cod= document.getElementById("codigo").value;
    document.getElementById("codigo_producto").value=cod;
    });
   
 });
</script>

@endsection
