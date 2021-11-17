<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Reporte de Facturas Credito</title>
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
    <h1 style="text-align:center" class="display-4">REPORTE DE FACTURAS CREDITOS</h1>
    <p><b>Fecha:</b> {{$hoy}}</p>
    <p><b>Empresa:</b> {{$empresa->descripcion}}      <b>R.T.N:</b>{{$empresa->codigo_empresa}}</p>     
    <p><b>Direccion:</b>{{$empresa->direccion}}</p>
    <p><b>Fecha Consulta:</b>{{$hoy}}</p>
    <br>

  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <p> <b>TOTAL en Facturas Creditos:</b> Lps. {{$total}} </p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <table class="center">
              <thead>
                <tr>
                  <th scope="col">Codigo Comprobante</th>
                  <th scope="col">Fecha & Hora</th>
                  <th scope="col">Cliente</th>
                  <th scope="col">Tipo Pago</th>
                  <th scope="col">Saldo</th>
                </tr>
            </thead>
            <tbody>   
              @foreach($creditos as $credito)
              <tr>
                <td>{{$credito->factura->codigo_factura}}</td>
                <td>{{$credito->factura->fechaHora}}</td>
                <td>{{$credito->factura->cliente->nombre}}</td>
                <td>{{$credito->factura->tipo_pago}}</td>
                <td>Lps.{{$credito->saldo}}</td>
             </tr>
            @endforeach
            </tbody>
        </table>
        </div>
      </div>
    </div>

  </body>
</html>
