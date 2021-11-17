@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Actualizar Compra</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('compra') }}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')

<form action="{!!route('compra.update', $compras->id_compra)!!}" method="POST">
    @method('PATCH')
    @csrf

    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Compra: {{$compras->codigo_compra}} </h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6">

                          <div class="form-group">
                            <label for="codigo_compra"># Factura</label>
                            <input type="text" class="form-control" name="codigo_compra" readonly value="{{$compras->codigo_compra}}" >
                          </div>

                          <div class="form-group">
                            <label for="codigo_compra">Proveedor</label>
                            <input type="text" class="form-control" name="proveedor" readonly value="{{$compras->proveedor->descripcion}}" >
                          </div>
            
                        <div class="form-group">
                            <label for="estado">*Estado</label>
                                <select id="estado" class="form-control"  name="estado">
                                <option value="{{$compras->estado->id}}">{{$compras->estado->descripcion}}</option>
                                <option value="1">Pagado</option>
                            </select> 
                        </div>

                        <div class="form-group">
                          <label for="fecha">*Fecha Realizada</label>
                          <input class="form-control" name="fecha" required type="date" data-date-format="aaaa/mm/dd" value="{{$compras->fecha}}" id="fecha">
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


@endsection



