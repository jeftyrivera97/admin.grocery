@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Nuevo Gasto</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('gasto') }}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')

<form action="/gasto" method="POST">
    @csrf
    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Nuevo Gasto</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="fecha">*Fecha</label>
                            <input class="form-control" required name="fecha" value="{{old('fecha')}}" type="date" data-date-format="aaaa/mm/dd" value="" id="fecha">
                        </div>
            
                        <div class="form-group">
                            <label for="descripcion">* N° Factura/Referencia</label>
                            <input class="form-control" required type="text" name="referencia"  id="referencia" ></textarea>
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
                         
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" required name="descripcion" rows="1" id="descripcion" ></textarea>
                        </div>
                        
                        <div class="form-group">
                                  
                            <label for="total">*Total</label>
                            <input class="form-control" required type="number" step="any" placeholder="0.00" name="total" id="total" value="" >   
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


@endsection
