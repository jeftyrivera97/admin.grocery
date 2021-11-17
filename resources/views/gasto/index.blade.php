@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Gastos</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"> <a href="{!! url('gasto/create') !!}"><button type="button" class="btn btn-primary active btn-sm"> <i class="fas fa-fw fa-plus"></i>Nuevo</button></a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
<div class="container-fluid">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-danger elevation-1">  <i class="fas fa-money-bill"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">Gastos {{$mes}}:</span>
          <span class="info-box-number">
            L. {{$gastosMes}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-warning elevation-1"> <i class="fas fa-money-bill"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">Gastos Anual:</span>
          <span class="info-box-number">
            L. {{$gastosAnual}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

  </div>
</div>
<div class="row col-8">
  <div class="col-md-6">
    <!-- AREA CHART -->
    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title"><b>Gastos {{$mes}}:</b></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="gastosSemanal" width="500" height="400"></canvas>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <div class="col-md-6">
    <!-- AREA CHART -->
    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title"><b>Gastos Ultimos 6 Meses</b></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="gastosAnual" width="500" height="400"></canvas>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<div class="container-fluid">
<div class="row">
  <div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
          <th scope="col">N° Factura/Referencia</th>
          <th scope="col">Fecha</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Categoria</th>
          <th scope="col">Total</th>
          <th scope="col">Usuario</th>
          <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>   
      @foreach($gastos as $gasto)
      <tr>
        <td>{{$gasto->codigo_gasto}}</td>
        <td>{{$gasto->fecha}}</td>
        <td>{{$gasto->descripcion}}</td>
        <td>{{$gasto->gastoCategoria->descripcion}}</td>
        <td>L. {{$gasto->total}}</td>
        <td>{{$gasto->user->name}}</td>
       
      <td>
        <a href="{{ route('gasto.show', $gasto->id_gasto)}}"><button type="button" class="btn btn-info active btn-sm"> <i class="fas fa-fw fa-eye"></i>Ver</button></a>
      </td>
    </tr>
  @endforeach
    </tbody>
</table>
</div>
</div>
</div>

<script>
  var ventas=[];
  var valores=[];

  var gastosAnual=[];
  var valoresAnual=[];
$(document).ready(function() {

 
   $.ajax({
    url: 'gastosSemanal',
    method:'POST',
    data:{
     "_token": "{{ csrf_token() }}",
    }
    }).done(function(res){
        var arreglo= JSON.parse(res);

        for(var x=0;x<arreglo.length; x++)
        {
          ventas.push(arreglo[x].descripcion);
         valores.push(arreglo[x].total);
        }
        GraficaGastosSemanal();
    });

    $.ajax({
    url: 'gastosAnual',
    method:'POST',
    data:{
     "_token": "{{ csrf_token() }}",
    }
    }).done(function(res){
        var arreglo= JSON.parse(res);

        for(var x=0;x<arreglo.length; x++)
        {
          gastosAnual.push(arreglo[x].descripcion);
         valoresAnual.push(arreglo[x].total);
        }
        GraficaGastosAnual();
    });

  

});
function GraficaGastosSemanal(){
 var ctx = document.getElementById('gastosSemanal').getContext('2d');
 var myChart = new Chart(ctx, {
   type: 'bar',
   data: {
       labels: ventas,
       datasets: [{
           label: 'Gastos del Mes',
           data: valores,
           backgroundColor: ["#9d0191", "#fd3a69","#3cba9f","#e8c3b9","#c45850","#277DA1", "#153e90","#54e346","#3e95cd", "#fffaa4","#583d72","#9f5f80","#ffba93","#ff8e71", 
             "#d35d6e","#efb08c","#f8d49d", "#5aa469","#0a043c","#bbbbbb","#583d72","#9f5f80", "#ffba93","#ff8e71"],
         }]
     },
     options: {
          legend: { display: false },
          title: {
            display: true,
            text: ''
          }
       
        
     }
});
}

function GraficaGastosAnual(){
 var ctx = document.getElementById('gastosAnual').getContext('2d');
 var myChart = new Chart(ctx, {
   type: 'line',
   data: {
       labels: gastosAnual,
       datasets: [{
           label: 'Gastos 2020',
           data: valoresAnual,
             backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
           borderColor: "#0a043c",
           fill: false
         }]
     },
     options: {
          legend: { display: false },
          title: {
            display: true,
            text: ''
          }
       
        
     }
});
}


</script>


@endsection

