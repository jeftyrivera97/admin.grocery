@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Compras de Productos</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('compra') }}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
<form action="/compra" method="POST">
    @csrf
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Nueva Compra</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                            <label for="codigo_compra">* N° Factura/Referencia</label>
                            <input type="text" required class="form-control" name="codigo_compra" value="{{old('codigo_compra')}}" placeholder="Ingrese # Factura/Referencia">
                        </div>
                        
                        <div class="form-group">
                            <label for="fecha">*Fecha Realizada</label>
                            <input class="form-control" required name="fecha" value="{{old('fecha')}}" type="date" data-date-format="aaaa/mm/dd" value="" id="fecha">
                        </div>
            
                        <div class="form-group">
                            <label for="id_proveedor">*Proveedor</label>
                            <select name="id_proveedor" required id="id_proveedor" class="form-control">
                              <option value="">--Selecione--</option>
                              @foreach ($proveedores as $proveedor)
                             <option value="{{ $proveedor['id_proveedor'] }}"> {{ $proveedor['descripcion'] }}  {{ $proveedor['codigo_proveedor'] }}</option>
                             @endforeach
                            </select>
                         </div>
                         
                         <div class="form-group">
                            <label for="categoria">Categoria*</label>
                            <select id="id_categoria" class="form-control" required value="{{old('id_categoria')}}" name="id_categoria" placeholder="Seleccione Categoria">
                                <option value="">--Selecione--</option>
                                @foreach ($categorias as $categoria)
                              <option value="{{$categoria['id']}}"> {{ $categoria['descripcion'] }}</option>
                             @endforeach
                            </select> 
                        </div>
                        <div class="form-group">
                            <label for="tipo">*Tipo de Pago</label>
                            <select id="tipo" required class="form-control" value="{{old('tipo')}}" name="tipo" placeholder="Seleccione Tipo">
                                <option value="">--Selecione--</option>
                                <option value="Contado">Contado</option>
                                <option value="Credito">Credito</option>
                            </select> 
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                            <label for="fecha_pago">Fecha de Pago <span>*Opcional*</span></label>
                            <input class="form-control" name="fecha_pago" disabled value="{{old('fecha_pago')}}" type="date" data-date-format="aaaa/mm/dd" value="" id="fecha_pago">
                        </div>
                          
                        <div class="form-group">
                            <label for="total">Exento</label>
                            <input class="form-control" type="number" step="any" placeholder="0.00" name="exento" id="exento" value="" >   
                        </div>
                        <div class="form-group">
                            <label for="total">Importe Gravado 15%</label>
                            <input class="form-control" type="number" step="any" placeholder="0.00" name="gravado15" id="gravado15" value="" >   
                        </div>
                        <div class="form-group">
                                  
                            <label for="total">Importe Gravado 18%</label>
                            <input class="form-control" type="number" step="any" placeholder="0.00" name="gravado18" id="gravado18" value="" >   
                        </div>  
                        
                      </div>
                      
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="total">Impuesto 15%</label>
                            <input class="form-control" type="number" step="any" placeholder="0.00" name="impuesto15" id="impuesto15" value="" >   
                        </div>
                        <div class="form-group">
                            <label for="total">Impuesto 18%</label>
                            <input class="form-control" type="number" step="any" placeholder="0.00" name="impuesto18" id="impuesto18" value="" >   
                        </div>
                        <div class="form-group">
                            <label for="total">*Total Compra</label>
                            <input class="form-control" required type="number" step="any" placeholder="0.00" name="total" id="total" value="" >   
                        </div>
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
</div>
</form>
<script>
    $(document).ready(function() {

        $('#tipo').change(function(){

           var tipo= document.getElementById("tipo").value;

           if(tipo=="Contado")
           {
            document.getElementById("fecha_pago").disabled = true;
             document.getElementById("exento").focus();
           }
           if(tipo=="Credito")
           {
             document.getElementById("fecha_pago").disabled = false;
             document.getElementById("fecha_pago").focus();
           }

        });
    });
</script>


@endsection
