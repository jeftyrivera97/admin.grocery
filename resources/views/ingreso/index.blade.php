@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Ventas </h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
     
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
        <span class="info-box-icon bg-success elevation-1"> <i class="fas fa-hand-holding-usd"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">Ventas Anual</span>
          <span class="info-box-number">
            L. {{$ventasAnual}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"> <i class="fas fa-hand-holding-usd"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">Ventas {{$mes}} </span>
          <span class="info-box-number">
            L. {{$ventasMes}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    
    <!-- /.col -->
  </div>
</div>
<div class="row col-12">
  <div class="col-md-4">
    <!-- AREA CHART -->
    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title"><b>Ingresos {{$mes}}</b></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="ventasSemanal" width="500" height="400" ></canvas>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <div class="col-md-4">
    <!-- AREA CHART -->
    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title"><b>Ingresos Ultimos 6 Meses</b></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="ventasAnual" width="500" height="400" ></canvas>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
  <br>
  <div class="row">
    <div class="col-sm-12">
      <div class="table-responsive">
    <table id="example1" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
          <th scope="col">Fecha y Hora</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Total</th>
          <th scope="col">Usuario</th>
         
        </tr>
    </thead>
    <tbody>   
      @foreach($ventas as $venta)
      <tr>
        <td>{{$venta->fechaHora}}</td>
        <td>{{$venta->descripcion}}</td>
        <td>L.{{$venta->total}}</td>
        <td>{{$venta->user->name}}</td>
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

  var ingresos=[];
    var valoresI=[];
$(document).ready(function() {
   $.ajax({
    url: 'ventasSemanal',
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
        GraficaVentasSemanal();
       
    });
});

$.ajax({
      url: 'ingresosAnual',
      method:'POST',
      data:{
       "_token": "{{ csrf_token() }}",
      }
      }).done(function(res){
          var arregloI= JSON.parse(res);
  
          for(var x=0;x<arregloI.length; x++)
          {
            ingresos.push(arregloI[x].descripcion);
            valoresI.push(arregloI[x].total);
          }
          GraficaVentasAnual();
      
      });

function GraficaVentasSemanal(){
 var ctx = document.getElementById('ventasSemanal').getContext('2d');
 var myChart = new Chart(ctx, {
   type: 'bar',
   data: {
       labels: ventas,
       datasets: [{
           label: 'Ventas por Semana',
           data: valores,
           backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
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
function GraficaVentasAnual(){
 var ctx = document.getElementById('ventasAnual').getContext('2d');
 var myChart = new Chart(ctx, {
   type: 'line',
   data: {
       labels: ingresos,
       datasets: [{
           label: 'Ventas del Mes',
           data: valoresI,
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
