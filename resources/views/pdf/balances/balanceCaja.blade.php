<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Reporte de Caja Chica </title>
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
   <h1 style="text-align:center" class="display-4">REPORTE DE CAJA</h1>
   <br>
   <p><b>Fecha:</b> {{$hoy}}</p>
   <p><b>Empresa:</b> {{$empresa->descripcion}}      <b>R.T.N:</b>{{$empresa->codigo_empresa}}</p>     
   <p><b>Direccion:</b>{{$empresa->direccion}}</p>
   <p><b>Fecha de Hoy:</b> {{$hoy}}</p>
   <br>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col">
          <table class="center" id="datos">
            <thead>
              <tr>
                <th scope="col">INGRESOS/EGRESOS</th>
                <th scope="col">TOTAL (L.)</th>
              </tr>
          </thead>
          <tbody>   
            <tr>
              <td>VENTAS</td>
              <td>L. {{$ventas}}</td>            
          </tr>
          <tr>
            <td>COMPRAS</td>
            <td>L. {{$compras}}</td>
          </tr>
          <tr>
            <td>GASTOS</td>
            <td>L. {{$gastos}}</td> 
          </tr>
          <tr>
            <td id="total">CAJA (+/-)</td>
            <td id="total">L. {{$balance}}</td> 
          </tr>
          </tbody>
      </table>
      <br>
      <table class="center" id="datos">
        <thead>
          <tr>
            <th scope="col">DESCRIPCION</th>
            <th scope="col">TOTAL (L.)</th>
            <th scope="col">% PORCENTAJE</th>
          </tr>
      </thead>
      <tbody>   
        <tr>
          <td>Ingresos TOTAL</td>
          <td>L. {{$ventas}}</td>
          <td id="centrado">100%</td>               
      </tr>
      <tr>
        <td>Egresos TOTAL</td>
        <td>L. {{$egresos}}</td>
        <td id="centrado">{{$pE}}%</td>
      </tr>
      <tr>
        <td id="c">BALANCE(+/-)</td>
        <td id="c">L. {{$balance}}</td> 
        <td id="c">{{$g}}%</td> 
      </tr>
      </tbody>
  </table>
    
        </div>
      </div>
     
    </div>

  </body>
</html>
