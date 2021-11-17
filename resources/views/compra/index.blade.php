@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Compras</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('compra/create') !!}"><button type="button" class="btn btn-primary active btn-sm"> <i class="fas fa-fw fa-plus"></i>Nueva</button></a></li>
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
        <span class="info-box-icon bg-danger elevation-1">  <i class="fas fa-shopping-cart"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">Creditos {{$mes}}:</span>
          <span class="info-box-number">
            L. {{$comprasCredito}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-warning elevation-1">  <i class="fas fa-shopping-cart"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">Contado {{$mes}}:</span>
          <span class="info-box-number">
            L. {{$comprasMes}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-success elevation-1">  <i class="fas fa-shopping-cart"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">Compras Anual:</span>
          <span class="info-box-number">
            L. {{$comprasAnual}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div>
</div>
<div class="row col-12">
  <div class="col-md-4">
    <!-- AREA CHART -->
    <div class="card card-light">
      <div class="card-header">
        <h3 class="card-title"><b>Compras {{$mes}}</b></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="comprasSemanal" width="500" height="400"></canvas>
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
        <h3 class="card-title"><b>Categorias Proveedores {{$mes}}</b></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="comprasCategorias" width="500" height="400"></canvas>
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
        <h3 class="card-title"><b>Proveedores {{$mes}}</b></h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="comprasProveedores" width="500" height="400"></canvas>
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
          <th scope="col">Proveedor</th>
          <th scope="col">Categoria</th>
          <th scope="col">Tipo de Pago</th>
          <th scope="col">Estado</th>
          <th scope="col">Fecha de Pago</th>
          <th scope="col">Total</th>
          <th scope="col">Usuario</th>
          <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>   
      @foreach($compras as $compra)
      <tr>
        <td>{{$compra->codigo_compra}}</td>
        <td>{{$compra->fecha}}</td>
        <td>{{$compra->proveedor->descripcion}}</td>
        <td>{{$compra->compraCategoria->descripcion}}</td>
        <td>{{$compra->cuenta->descripcion}}</td>
        <td>{{$compra->estado->descripcion}}</td>
        <td>{{$compra->fecha_pago}}</td>
        <td>L. {{$compra->total}}</td>
        <td>{{$compra->user->name}}</td>
      <td>
        <a href="{{ route('compra.edit', $compra->id_compra)}}"><button type="button" class="btn btn-success active btn-sm"> <i class="fas fa-fw fa-sync-alt"></i>Actualizar</button></a>
        <a href="{{ route('compra.show', $compra->id_compra)}}"><button type="button" class="btn btn-info active btn-sm"> <i class="fas fa-fw fa-eye"></i>Ver</button></a>
        <a href="{{ route('pedidos/crear', $compra->id_compra)}}"><button type="button" class="btn btn-danger active btn-sm"><i class="fas fa-fw fa-clipboard-list"></i>Pedido</button></a>
      </td>
    </tr>
  @endforeach
    </tbody>
</table>
</div>
</div>
</div>
<script>

  var compras=[];
    var valores=[];
  
    var categorias=[];
    var valoresC=[];
  
    var proveedores=[];
    var valoresP=[];
  
  
  $(document).ready(function() {
  
   
     $.ajax({
      url: 'comprasCategorias',
      method:'POST',
      data:{
       "_token": "{{ csrf_token() }}",
      }
      }).done(function(res){
      
          var arreglo= JSON.parse(res);
  
          for(var x=0;x<arreglo.length; x++)
          {
            categorias.push(arreglo[x].descripcion);
            valoresC.push(arreglo[x].total);
          }
          GraficaComprasCategorias();
      
      });
  
      $.ajax({
      url: 'comprasProveedores',
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
          GraficaComprasProveedores();
      
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
            compras.push(arreglo[x].descripcion);
            valores.push(arreglo[x].total);
          }
          GraficaComprasSemanal();
      
      });
      
  });
  
  function GraficaComprasCategorias(){
     var ctx = document.getElementById('comprasCategorias').getContext('2d');
     var myChart = new Chart(ctx, {
       type: 'bar',
       data: {
           labels: categorias,
           datasets: [{
               label: 'Categorias',
               data: valoresC,
               backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                borderWidth: 1
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
  
    function GraficaComprasProveedores(){
     var ctx = document.getElementById('comprasProveedores').getContext('2d');
     var myChart = new Chart(ctx, {
       type: 'pie',
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
  
    function  GraficaComprasSemanal(){
     var ctx = document.getElementById('comprasSemanal').getContext('2d');
     var myChart = new Chart(ctx, {
       type: 'bar',
       data: {
           labels: compras,
           datasets: [{
               label: 'Compras',
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
  </script>
@endsection
