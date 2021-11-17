@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Planilla</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('planilla/create') !!}"><button type="button" class="btn btn-primary active btn-sm"> <i class="fas fa-fw fa-plus"></i>Nuevo</button></a></li>
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
        <span class="info-box-icon bg-danger elevation-1"> <i class="fas fa-user-friends"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">Planilla {{$mes}}:</span>
          <span class="info-box-number">
            L. {{$planillaMes}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-warning elevation-1"> <i class="fas fa-user-friends"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">Planilla Anual:</span>
          <span class="info-box-number">
            L. {{$planillaAnual}}
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
        <h3 class="card-title"><b>Planilla {{$mes}}</b></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="planillaSemanal" width="500" height="400"></canvas>
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
        <h3 class="card-title"><b>Planilla Ultimos 6 Meses</b></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="planillaAnual" width="500" height="400"></canvas>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<div class="container-fluid">
  <div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
          <th scope="col">Codigo</th>
          <th scope="col">Fecha de Pago</th>
          <th scope="col">Empleado</th>
          <th scope="col">Total Pagado</th>
          <th scope="col">Usuario</th>
        </tr>
    </thead>
    <tbody>   
      @foreach($planillas as $planilla)
      <tr>
        <td>{{$planilla->id_planilla}}</td>
        <td>{{$planilla->fecha}}</td>
        <td>{{$planilla->empleado->nombre}}</td>
        <td>L. {{$planilla->total}}</td>
        <td>{{$planilla->user->name}}</td>
    </tr>
  @endforeach
    </tbody>
</table>
</div>
</div>
<script>
  var ventas=[];
  var valores=[];

  var planillasAnual=[];
  var valoresAnual=[];


$(document).ready(function() {

 
   $.ajax({
    url: 'planillaSemanal',
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
        GraficaPlanillaSemanal();
    });

    $.ajax({
    url: 'planillaAnual',
    method:'POST',
    data:{
     "_token": "{{ csrf_token() }}",
    }
    }).done(function(res){
        var arreglo= JSON.parse(res);

        for(var x=0;x<arreglo.length; x++)
        {
          planillasAnual.push(arreglo[x].descripcion);
          valoresAnual.push(arreglo[x].total);
        }
        GraficaPlanillaAnual();
    });
});
function GraficaPlanillaSemanal(){
 var ctx = document.getElementById('planillaSemanal').getContext('2d');
 var myChart = new Chart(ctx, {
   type: 'bar',
   data: {
       labels: ventas,
       datasets: [{
           label: 'Planilla Semanal',
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

function GraficaPlanillaAnual(){
 var ctx = document.getElementById('planillaAnual').getContext('2d');
 var myChart = new Chart(ctx, {
   type: 'line',
   data: {
       labels: planillasAnual,
       datasets: [{
           label: 'Planilla Anual',
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

