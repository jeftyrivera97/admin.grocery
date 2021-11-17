<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Reporte de Ventas </title>
    <style>
      p, table, h1, h3{
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      }
      table, th, td {
        border: 1px solid black;

      }
      table{
        border-collapse: collapse;
      }
      #c{
        text-align: center;
      }
      th {
       height: 15px;
       text-align: center;
       background-color: #4CAF50;
        color: black;
      }

     
      td{
        text-align: left;
        height: 5px;
      }
      td,th{
        padding: 5px;
      }
      tr:nth-child(even){background-color: #f2f2f2}
      table.center {
      margin-left: auto;
      margin-right: auto;
    }
      </style>
    <h1 style="text-align:center" class="display-4">REPORTE DE PRODUCTOS VENDIDOS</h1>
    <p><b>Fecha:</b> {{$hoy}}</p>
    <p><b>Empresa:</b> {{$empresa->descripcion}}      <b>R.T.N:</b>{{$empresa->codigo_empresa}}</p>     
    <p><b>Direccion:</b>{{$empresa->direccion}}</p>
    <p><b>Fecha Consulta:</b> {{$fechaInicial}} - {{$fechaFinal}}</p>
    <br>

  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <p><b>Total N° Articulos Vendidos:</b> {{$total}} <p>
          <p><b>Inventario N° Articulos Actual:</b> {{$inventario}} <p>
            <p><b>Inventario Actual Valor:</b> L.{{$total_inventario}} <p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <table class="center">
              <thead>
                <tr>
                  <th scope="col">Producto</th>
                  <th scope="col">Cantidad</th>
                </tr>
            </thead>
            <tbody>   
              @foreach($encontrados as $encontrado)
              <tr>
                <td>{{$encontrado['descripcion']}}</td>
                <td>{{$encontrado['cantidad']}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
        </div>
      </div>
    </div>

  </body>
</html>


  