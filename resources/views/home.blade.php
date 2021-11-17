@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">El Buen Amigo Souvenir </h1> <span>Bienvenido  {{ Auth::user()->name }}, {{$hora}}</span>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
       
        </li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')

<div class="container-fluid">
  <!-- Info boxes -->
<h5 class="mt-4 mb-2">{{$mes}} {{$year}}</code></h5>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fas fa-hand-holding-usd"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ingresos</span>
                <span class="info-box-number">L. {{$ingresos}}</span>

                <div class="progress">
                  <div class="progress-bar" style="width: {{$pI}}%"></div>
                </div>
                <span class="progress-description">
                  {{number_format($pI,2,'.','')}}% {{$descripcionIngresos}} en 30 Dias
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-warning">
              <span class="info-box-icon"> <i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Compras</span>
                <span class="info-box-number">L. {{$compras}}</span>

                <div class="progress">
                  <div class="progress-bar" style="width: {{$pC}}%"></div>
                </div>
                <span class="progress-description">
                  {{number_format($pC,2,'.','')}}% {{$descripcionCompras}} en 30 Dias
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fas fa-money-bill"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Gastos</span>
                <span class="info-box-number">L. {{$gastos}}</span>

                <div class="progress">
                  <div class="progress-bar" style="width: {{$pG}}%"></div>
                </div>
                <span class="progress-description">
                  {{number_format($pG,2,'.','')}}% {{$descripcionGastos}} en 30 Dias
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Planilla</span>
                <span class="info-box-number">L. {{$planillas}}</span>

                <div class="progress">
                  <div class="progress-bar" style="width: {{$pP}}%"></div>
                </div>
                <span class="progress-description">
                  {{number_format($pP,2,'.','')}}% {{$descripcionPlanilla}} en 30 Dias
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <!-- /.row -->
</div>
<div class="container-fluid">
  <div class="row col-12">
    <div class="col-md-3">
      <!-- AREA CHART -->
      <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title"><b>Ingresos Semanal {{$mes}}</b></h3>
  
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="ventasSemanal" width="100%" height="100%" ></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-md-3">
      <!-- AREA CHART -->
      <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title"><b>Compras Semanal {{$mes}}</b></h3>
  
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="comprasSemanal" width="100%" height="100%"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-md-3">
      <!-- AREA CHART -->
      <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title"><b>Gastos Semanal {{$mes}}</b></h3>
  
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="gastosSemanal" width="100%" height="100%"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <div class="col-md-3">
      <!-- AREA CHART -->
      <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title"><b>Planilla Semanal {{$mes}}</b></h3>
  
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="planillaSemanal" width="100%" height="100%"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
</div>
  <h5 class="mt-4 mb-2">Anual {{$year}}</code></h5>
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-success elevation-1"> <i class="fas fa-hand-holding-usd"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Ingresos </span>
            <span class="info-box-number">
              L. {{$ingresosAnual}}
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1">  <i class="fas fa-shopping-cart"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Compras  </span>
          <span class="info-box-number">L. {{$comprasAnual}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
  
      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>
  
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-bill"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Gastos  </span>
          <span class="info-box-number">L. {{$gastosAnual}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">Planilla  </span>
          <span class="info-box-number">L. {{$planillasAnual}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <div class="container-fluid">
    <div class="row col-12">
      <div class="col-md-3">
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title"><b>Ingresos {{$year}} </b></h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="ventasLine" width="100%" height="100%" ></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
   
    <div class="col-md-3">
      <!-- AREA CHART -->
      <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title"><b>Compras {{$year}} </b></h3>
  
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="comprasLine" width="100%" height="100%"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>

    <div class="col-md-3">
      <!-- AREA CHART -->
      <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title"><b>Gastos {{$year}} </b></h3>
  
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="gastosLine" width="100%" height="100%"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>

    <div class="col-md-3">
      <!-- AREA CHART -->
      <div class="card card-light">
        <div class="card-header">
          <h3 class="card-title"><b>Planillas {{$year}}</b></h3>
  
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="chart">
            <canvas id="planillasLine" width="100%" height="100%"></canvas>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    </div>

    <div class="row col-12">

      <div class="col-md-4">
        <!-- AREA CHART -->
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title"><b>Balance {{$year}}</b></h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="balance" width="100%" height="100%"></canvas>
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
            <h3 class="card-title"><b>Categoria de Gastos </b></h3>
    
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="categoriasG" width="100%" height="100%"></canvas>
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
            <h3 class="card-title"><b>Proveedores de Compras </b></h3>
    
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="proveedores" width="100%" height="100%"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>

  </div>



  <script>
    var ingresosSemanal=[];
    var vIngresosSemanal=[];

    var comprasSemanal=[];
    var vComprasSemanal=[];

    var gastosSemanal=[];
    var vGastosSemanal=[];

    var planillasSemanal=[];
    var vPlanillasSemanal=[];

    var ingresosAnual=[];
    var vIngresosAnual=[];

    var comprasAnual=[];
    var vComprasAnual=[];

    var gastosAnual=[];
    var vGastosAnual=[];

    var planillasAnual=[];
    var vPlanillasAnual=[];

    var categoriasG=[];
    var valoresCat=[];

    var proveedores=[];
    var valoresP=[];

    var balance=[];
    var valoresB=[]


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
              ingresosSemanal.push(arreglo[x].descripcion);
              vIngresosSemanal.push(arreglo[x].total);
            }
            GraficaVentasSemanal();
          
        });

        $.ajax({
          url: 'comprasSemanal',
          method:'POST',
          data:{
          "_token": "{{ csrf_token() }}",
          }
          }).done(function(res){
          
              var arreglo= JSON.parse(res);

              for(var x=0;x<arreglo.length; x++)
              {
                comprasSemanal.push(arreglo[x].descripcion);
                vComprasSemanal.push(arreglo[x].total);
              }
              GraficaComprasSemanal();
          
          });

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
                gastosSemanal.push(arreglo[x].descripcion);
                vGastosSemanal.push(arreglo[x].total);
              }
              GraficaGastosSemanal();
          });

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
                planillasSemanal.push(arreglo[x].descripcion);
                vPlanillasSemanal.push(arreglo[x].total);
              }
              GraficaPlanillaSemanal();
          });

          $.ajax({
            url: "{{route ('ventas')}}",
            method:'POST',
            data:{
            "_token": "{{ csrf_token() }}",
            }
            }).done(function(res){
                var arregloI= JSON.parse(res);
        
                for(var x=0;x<arregloI.length; x++)
                {
                  ingresosAnual.push(arregloI[x].descripcion);
                  vIngresosAnual.push(arregloI[x].total);
                }
                GraficaLineIngresosAnual();
            
            });
      
          $.ajax({
            url: 'compras',
            method:'POST',
            data:{
            "_token": "{{ csrf_token() }}",
            }
            }).done(function(res){
            
                var arreglo= JSON.parse(res);

                for(var x=0;x<arreglo.length; x++)
                {
                  comprasAnual.push(arreglo[x].descripcion);
                  vComprasAnual.push(arreglo[x].total);
                }
                GraficaLineComprasAnual();
            
            });

            $.ajax({
              url: 'gastos',
              method:'POST',
              data:{
              "_token": "{{ csrf_token() }}",
              }
              }).done(function(res){
              
                  var arreglo= JSON.parse(res);

                  for(var x=0;x<arreglo.length; x++)
                  {
                    gastosAnual.push(arreglo[x].descripcion);
                    vGastosAnual.push(arreglo[x].total);
                  }
                  GraficaLineGastosAnual();
              
              });

              $.ajax({
                url: 'planillas',
                method:'POST',
                data:{
                "_token": "{{ csrf_token() }}",
                }
                }).done(function(res){
                    var arreglo= JSON.parse(res);
            
                    for(var x=0;x<arreglo.length; x++)
                    {
                      planillasAnual.push(arreglo[x].descripcion);
                      vPlanillasAnual.push(arreglo[x].total);
                    }
                    GarficaLinePlanillaAnual();
                });

                          
              $.ajax({
                url: 'proveedores',
                method:'POST',
                data:{
                "_token": "{{ csrf_token() }}",
                }
                }).done(function(res){
                
                    var arreglo= JSON.parse(res);

                    for(var x=0;x<arreglo.length; x++)
                    {
                      proveedores.push(arreglo[x].descripcion);
                      valoresP.push(arreglo[x].total);
                    }
                    GraficaProveedores();
                
                });

                $.ajax({
                  url: 'categoriasG',
                  method:'POST',
                  data:{
                  "_token": "{{ csrf_token() }}",
                  }
                  }).done(function(res){
                      var arreglo= JSON.parse(res);
              
                      for(var x=0;x<arreglo.length; x++)
                      {
                        categoriasG.push(arreglo[x].descripcion);
                        valoresCat.push(arreglo[x].total);
                      }
                      GraficaCategoriaG();
                  });

                  $.ajax({
                    url: "{{route ('balanceAnual')}}",
                    method:'POST',
                    data:{
                    "_token": "{{ csrf_token() }}",
                    }
                    }).done(function(res){
                        var arregloB= JSON.parse(res);
                
                        for(var x=0;x<arregloB.length; x++)
                        {
                          balance.push(arregloB[x].descripcion);
                          valoresB.push(arregloB[x].total);
                        }
                  
                        GraficaBalanceAnual();
                    
                    });
            });

    //GRAFICAS
    function GraficaVentasSemanal(){
      var ctx = document.getElementById('ventasSemanal').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ingresosSemanal,
            datasets: [{
                label: 'Ventas por Semana',
                data: vIngresosSemanal,
                backgroundColor: ["#0ee500", "#0cce00","#0bb700","#09a000","#088900","#088900"],
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
      function  GraficaComprasSemanal(){
      var ctx = document.getElementById('comprasSemanal').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: comprasSemanal,
            datasets: [{
                label: 'Compras',
                data: vComprasSemanal,
                backgroundColor: ["#ffd728", "#ffdb3d","#ffdf52","#ffe368","#ffe77e","#ffe77e"],
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

      function GraficaGastosSemanal(){
      var ctx = document.getElementById('gastosSemanal').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: gastosSemanal,
            datasets: [{
                label: 'Gastos del Mes',
                data: vGastosSemanal,
                backgroundColor: ["#f2003c", "#d90036","#c10030","#FF0000","#FF6347","#FF4500"],
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

      function GraficaPlanillaSemanal(){
      var ctx = document.getElementById('planillaSemanal').getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: planillasSemanal,
            datasets: [{
                label: 'Planilla Semanal',
                data: vPlanillasSemanal,
                backgroundColor: ["#2f566f", "#2a4d63","#254458","#203c4d","#c45850","#277DA1", "#153e90","#54e346"],
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

      function GraficaLineIngresosAnual(){
        var ctx = document.getElementById('ventasLine').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: ingresosAnual,
              datasets: [{
                  label: 'Ingresos',
                  data: vIngresosAnual,
                  backgroundColor: ["#0ee500", "#0cce00","#0bb700","#09a000","#088900","#088900","#9ACD32", "#556B2F","#7CFC00","#00FF00","#00FA9A","#20B2AA"],
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

    function GraficaLineComprasAnual(){
        var ctx = document.getElementById('comprasLine').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: comprasAnual,
              datasets: [{
                  label: 'Compras Mensual',
                  data: vComprasAnual,
                  backgroundColor: ["#cccc00", "#ffff00","#ffff33","#ffff66","#cccc00","#ffff00", "#ffff33","#ffff66","#ffff99"],
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

        function  GraficaLineGastosAnual(){
          var ctx = document.getElementById('gastosLine').getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: gastosAnual,
                datasets: [{
                    label: 'Gastos Mensual',
                    data: vGastosAnual,
                    backgroundColor: ["#660000", "#990000","#cc0000","#ff0000","#ff3333","#ff3333", "#b30000","#ff6666","#e60000"],
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

  function GarficaLinePlanillaAnual(){
       var ctx = document.getElementById('planillasLine').getContext('2d');
       var myChart = new Chart(ctx, {
        type: 'line',
         data: {
             labels: planillasAnual,
             datasets: [{
                 label: 'Planilla Mensual',
                 data: vPlanillasAnual,
                 backgroundColor: ["#001a66", "#002db3","#0039e6","#1a53ff","#4d79ff","#004d99", "#0066cc","#0080ff","#4da6ff", "#0099cc"],
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

      function GraficaProveedores(){
   var ctx = document.getElementById('proveedores').getContext('2d');
   var myChart = new Chart(ctx, {
     type: 'bar',
     data: {
         labels: proveedores,
         datasets: [{
             label: 'Proveedores',
             data: valoresP,
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

  function GraficaCategoriaG(){
   var ctx = document.getElementById('categoriasG').getContext('2d');
   var myChart = new Chart(ctx, {
     type: 'bar',
     data: {
         labels: categoriasG,
         datasets: [{
             label: 'Categorias',
             data: valoresCat,
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

  function GraficaBalanceAnual(){
   var ctx = document.getElementById('balance').getContext('2d');
   var myChart = new Chart(ctx, {
     type: 'doughnut',
     data: {
         labels: balance,
         datasets: [{
             label: 'Balance',
             data: valoresB,
             backgroundColor: ["#0ee500", "#F94144"],
              borderWidth: 1
         }]
     },
     options: {
       
         scales: {
             yAxes: [{
                 ticks: {
                     beginAtZero: true
                 }
             }]
         }
     }
  });
  }

    </script>
@endsection
