<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!-- Tell the browser to be responsive to screen width -->
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <link rel="shortcut icon" href="{{ asset('dist/img/icono.png') }}" type ="image/x-icon">
 <title>AdminSIE</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>$.widget.bridge('uibutton', $.ui.button)</script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
  <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      
    });
  });
</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('herramientas.conversor')

  
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#conversor" href="#" role="button">
          <i class="fas fa-money-bill"></i> Conversor
        </a>
      
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="dropdown" href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Cerrar Sesion
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
 
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{!!url ('/')!!}" class="brand-link">
      <i class="fas fa-store"></i>
      <span class="brand-text font-weight-light">AdminSIE Web App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/userMain.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('/')}}" class="d-block">
            @guest
            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
            @else
            {{ Auth::user()->name }}
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                style="display: none;">
                @csrf
            </form>
            @endguest
        </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <form action="{{route('buscarProducto')}}" method="POST" >
        @csrf
      <div class="form-inline">
        <div class="input-group" >
          <input class="form-control form-control-sidebar" id="busqueda" name="busqueda" type="search" placeholder="Buscar Producto" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar" type="submit">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
    </form>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <li class="nav-header">CAJERO</li>
               <li class="nav-item has-treeview">
                <a href="{!! url('caja')!!}" class="nav-link">
                  <i class="nav-icon fas fa-cash-register"></i>
                  <p>
                    Caja
                  </p>
                </a>
              </li>
               <li class="nav-item has-treeview menu-close">
                <a href="#" class="nav-link">
                  <i class="fas fa-file-invoice"></i>
                  <p>
                    Facturas
                    <i class="right fas fa-angle-double-down"></i>
                    <span class="badge badge-info right"></span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{!!url('factura/create')!!}" class="nav-link active">
                      <i class="fas fa-plus"></i>
                      <p>
                        Nueva Factura
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{!!url('factura')!!}" class="nav-link active">
                      <i class="fas fa-receipt"></i>
                      <p>
                        Consultar Facturas 
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-header">ADMINISTRACION</li>
               <li class="nav-item has-treeview menu-close">
                <a href="#" class="nav-link">
                  <i class="fas fa-hand-holding-usd"></i>
                  <p>
                    Ingresos
                    <i class="right fas fa-angle-double-down"></i>
                    <span class="badge badge-info right"></span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{!!url('ingreso')!!}" class="nav-link active">
                      <i class="fas fa-piggy-bank"></i>
                      <p>
                        Ventas 
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview menu-close">
                <a href="#" class="nav-link">
                  <i class="fas fa-coins"></i>
                  <p>
                    Egresos
                    <i class="right fas fa-angle-double-down"></i>
                    <span class="badge badge-info right"></span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{!!url('compra')!!}" class="nav-link active">
                      <i class="fas fa-fw fa-cart-plus"></i>
                      <p>
                        Compras 
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{!!url('gasto')!!}" class="nav-link active">
                      <i class="fas fa-fw fa-money-bill"></i>
                      <p>
                        Gastos 
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{!!url('planilla')!!}" class="nav-link active">
                      <i class="fas fa-money-check"></i>
                      <p>
                        Planilla 
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview menu-close">
                <a href="#" class="nav-link">
                  <i class="fas fa-list-ol"></i>
                  <p>
                    Listados
                    <i class="right fas fa-angle-double-down"></i>
                    <span class="badge badge-info right"></span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{!!url('cliente')!!}" class="nav-link active">
                      <i class="fas fa-fw fa-users"></i>
                      <p>
                        Clientes 
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{!!url('empleado')!!}" class="nav-link active">
                      <i class="fas fa-users-cog"></i>
                      <p>
                        Empleados 
                      </p>
                    </a>
                  </li>
              <li class="nav-item">
                <a href="{!!url('producto')!!}" class="nav-link active">
                  <i class="fas fa-fw fa-clipboard-list"></i>
                  <p>
                    Productos 
                  </p>
                </a>
              </li>
                       
          <li class="nav-item">
            <a href="{!!url('proveedor')!!}" class="nav-link active">
              <i class="fas fa-address-book"></i>
              <p>
                Proveedores
              </p>
            </a>
          </li>
          </ul>
        </li>  
        <li class="nav-header">REPORTES</li>     
        <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link">
              <i class="fas fa-file-pdf"></i>
              <p>
                Reportes PDF
                <i class="right fas fa-angle-double-down"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{!!url('reportes/pdf/balances')!!}" class="nav-link active">
                  <i class="far fa-circle"></i>
                  <p>Balance </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!!url('reportes/pdf/compras')!!}" class="nav-link active">
                  <i class="far fa-circle"></i>
                  <p>Compras </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!!url('reportes/pdf/gastos')!!}" class="nav-link active">
                  <i class="far fa-circle"></i>
                  <p>Gastos </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!!url('reportes/pdf/productos')!!}" class="nav-link active">
                  <i class="far fa-circle"></i>
                  <p>Productos</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="{!!url('reportes/pdf/ventas')!!}" class="nav-link active">
                  <i class="far fa-circle"></i>
                  <p>Ventas</p>
                </a>
              </li>   
            </ul>
            <li class="nav-item has-treeview menu-close">
              <a href="#" class="nav-link">
                <i class="fas fa-file-excel"></i>
                <p>
                  Reportes Excel
                  <i class="right fas fa-angle-double-down"></i>
                  <span class="badge badge-info right"></span>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{!!url('reportes/excel/compras')!!}" class="nav-link active">
                    <i class="far fa-circle"></i>
                    <p>Compras </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{!!url('reportes/excel/facturas')!!}" class="nav-link active">
                    <i class="far fa-circle"></i>
                    <p>Facturas </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{!!url('reportes/excel/ventas')!!}" class="nav-link active">
                    <i class="far fa-circle"></i>
                    <p>Ventas </p>
                  </a>
                </li>
              </ul>
              <li class="nav-header">CONFIGURACION</li> 
              <li class="nav-item has-treeview">
                <a href="{!! url('empresa/create')!!}" class="nav-link">
                  <i class="fas fa-address-card"></i>
                  <p>
                    Empresa
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="{!! url('folio')!!}" class="nav-link">
                  <i class="fas fa-file-invoice"></i>
                  <p>
                    Facturacion
                  </p>
                </a>
              </li>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <section class="header">
          @yield('header') <!-- /.content -->
       </section>
      
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
     @if(session()->has('message'))
            <div class="alert {{session('alert') ?? 'alert-info'}}">
                {{ session('message') }}
            </div>
     @endif
        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif
        @yield('content') <!-- /.content -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2021 AdminSIE</a>.</strong>
    Todos los derechos de Autor Reservados
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


</body>
</html>
