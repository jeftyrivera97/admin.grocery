@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Reportes de Productos</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('/') }}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
<div class="container pt-3">
<form action="{{route('productoRangoExport')}}" method="GET">
    @csrf
    <div class="container">
        <h5>Productos Vendidos</h5>
        <div class="row">
           
            <div class="col-sm-4">
               
                 <div class="form-group">
                     <label for="fecha_inicial">Rango de Fecha (de:)</label>
                         <input class="form-control" id="fecha_inicial" name="fecha_inicial" value="" type="date" data-date-format="aaaa/mm/dd" id="fecha">
                </div>
              
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="fecha_final">(a:)</label>
                        <input class="form-control" id="fecha_final" name="fecha_final" value="" type="date" data-date-format="aaaa/mm/dd" id="fecha">
               </div>
              
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
            <div class="form-group">
                <button type="submit" class="btn btn-success"><i class="fas fa-file-download"></i> Exportar</button>
        </div>
            </div>
         </div>
              
    </div>

</form>
</div>

<div class="container pt-3">
  <form action="{{route('productoActualExport')}}" method="GET">
      @csrf
      <div class="container">
          <h5>Inventario Actual</h5>
          <div class="row">
              <div class="col-sm-4">
              <div class="form-group">
                  <button type="submit" class="btn btn-success"><i class="fas fa-file-download"></i> Exportar</button>
          </div>
              </div>
           </div>
                
      </div>
  
  </form>
  </div>
@endsection