<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Reporte de Ventas </title>
    
    <style>
      #datos {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      #datos td, #datos th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      #datos tr:nth-child(even){background-color: #f2f2f2;}

      #datos tr:hover {background-color: #ddd;}

      #datos th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #864040;
        color: white;
      }

      p,h1, h3{
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      }
   
      </style>
    <h1 style="text-align:center" class="display-4">REPORTE DE VENTAS</h1>
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
          <h2><b>TOTAL en Ventas:</b> L. {{$total}} </h2>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <table class="center" id="datos">
            <thead>
              <tr>
                <th scope="col"> Id</th>
                <th scope="col"> Fecha & Hora </th>
                <th scope="col"> Descripcion </th>
                <th scope="col"> Total </th>
                <th scope="col"> Usuario </th>
              </tr>
          </thead>
          <tbody>   
            @foreach($ventas as $venta)
            <tr>
              <td> {{$venta->id_venta}} </td>
              <td> {{$venta->fechaHora}} </td>
              <td> {{$venta->descripcion}} </td>
              <td> L. {{$venta->total}} </td>
              <td> {{$venta->user->name}} </td>
          </tr>
        @endforeach
          </tbody>
        </table>
        </div>
      </div>
    </div>

  </body>

</html>
