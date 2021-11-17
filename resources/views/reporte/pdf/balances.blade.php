@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Reportes de Ingresos y Egresos</h1>
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

<form action="{!!route('balanceCajaExport')!!}" method="GET">
  @csrf     

  <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-dark">
                <div class="card-header">
                  <h3 class="card-title">Caja Chica</h3>
                </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info active"><i class="far fa-save"></i> Exportar</button>     
                  </div>
              </div>
              <!-- /.card -->
        </div>

    </div>
</div>
</form>
<form action="{!!route('balanceRangoExport')!!}" method="GET">
  @csrf     

  <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-dark">
                <div class="card-header">
                  <h3 class="card-title">Balance General</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <div class="row">
                      <div class="col-sm-6">
                        
                      <div class="form-group">
                        <label for="fecha_inicial">Rango de Fecha (de:)</label>
                        <input class="form-control" id="fecha_inicial" name="fecha_inicial" value="" type="date" data-date-format="aaaa/mm/dd" id="fecha">
                      </div>

                      <div class="form-group">
                        <label for="fecha_final">(a:)</label>
                         <input class="form-control" id="fecha_final" name="fecha_final" value="" type="date" data-date-format="aaaa/mm/dd" id="fecha">
                    </div>
                   </div>                       
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info active"><i class="far fa-save"></i> Exportar</button>     
                  </div>
              </div>
              <!-- /.card -->
        </div>

    </div>
</div>
</form>
<form action="{!!route('balanceComparativoExport')!!}" method="GET">
    @csrf     

    <div class="container-fluid">
      <div class="row">
          <div class="col-sm-12">
              <div class="card card-dark">
                  <div class="card-header">
                    <h3 class="card-title">Balance Comparativo</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6">
                          
                        <div class="form-group">
                          <label for="fecha_inicial">1er Mes</label>
                          <input class="form-control" id="primer_mes" name="primer_mes" value="" type="month">
                        </div>

                        <div class="form-group">
                          <label for="fecha_final">2do Mes</label>
                           <input class="form-control" id="segundo_mes" name="segundo_mes" value="" type="month">
                      </div>
                     </div>                       
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-info active"><i class="far fa-save"></i> Exportar</button>     
                    </div>
                </div>
                <!-- /.card -->
          </div>
  
      </div>
  </div>
  </form>


@endsection