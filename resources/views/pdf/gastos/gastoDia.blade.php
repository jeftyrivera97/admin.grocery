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
    <h1 style="text-align:center" class="display-4">REPORTE DE GASTOS</h1>
    <p><b>Fecha:</b> {{$hoy}}</p>
    <p><b>Empresa:</b> {{$empresa->descripcion}}      <b>R.T.N:</b>{{$empresa->codigo_empresa}}</p>     
    <p><b>Direccion:</b>{{$empresa->direccion}}</p>
    <p><b>Fecha Consulta:</b> {{$fecha}}</p>
    <br>

  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h2><b>TOTAL en Gastos:</b> L. {{$total}} </h2>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <p><b>Gastos de Consulta:</b></p>
          <table class="center" id="datos">
              <thead>
                <tr>
                  <th scope="col">Fecha</th>
                  <th scope="col">N° Factura/Referencia</th>
                  <th scope="col">Categoria</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Total</th>
                  <th scope="col">Usuario</th>
                </tr>
            </thead>
            <tbody>   
              @foreach($gastos as $gasto)
              <tr>
                <td>{{$gasto->fecha}}</td>
                <td>{{$gasto->codigo_gasto}}</td>
                <td>{{$gasto->gastoCategoria->descripcion}}</td>
                <td>{{$gasto->descripcion}}</td>
                <td>L. {{number_format($gasto->total, 2)}}</td>
                <td>{{$gasto->user->name}}</td>
            </tr>
          @endforeach
            </tbody>
        </table>
        </div>
      </div>
    
    </div>

  </body>
</html>
