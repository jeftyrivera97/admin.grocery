<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Reporte de Compras </title>
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
      <br>
   <h1 style="text-align:center" class="display-4">REPORTE DE CREDITOS</h1>
   <p><b>Fecha:</b> {{$hoy}}</p>
   <p><b>Empresa:</b> {{$empresa->descripcion}}      <b>R.T.N:</b>{{$empresa->codigo_empresa}}</p>     
   <p><b>Direccion:</b> {{$empresa->direccion}}</p>
   <br>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="container">
          <div class="col-md-4">
            <h2><b>TOTAL en Creditos:</b> L. {{$total}} </h2>
          </div>
        </div>
      </div>
        <br>
      <div class="row">
        <div class="col">
          <p><b>Compras de Consulta:</p>
            <table class="center" id="datos">
              <thead>
                <tr>
                  <th scope="col">N° Factura</th>
                  <th scope="col">Categoria</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Tipo de Pago</th>
                  <th scope="col">Proveedor</th>
                  <th scope="col">I.S.V. 15%</th>
                  <th scope="col">Importe Gravado 15%</th>
                  <th scope="col">Total</th>
                  <th scope="col">Usuario</th>
                </tr>
            </thead>
            <tbody>   
              @foreach($compras as $compra)
              <tr>
                <td scope="row">{{$compra->codigo_compra}}</td>
                <td scope="row">{{$compra->compraCategoria->descripcion}}</td>
                <td scope="row">{{$compra->fecha}}</td>
                <td scope="row">{{$compra->tipo}}</td>
                <td scope="row">{{$compra->proveedor->descripcion}}</td>
                <td scope="row">L. {{number_format($compra->gravado15, 2)}}</td>
                <td scope="row">L. {{number_format($compra->impuesto15, 2)}}</td>
                <td scope="row">L. {{number_format($compra->total, 2)}}</td>
                <td scope="row">{{$compra->user->name}}</td>
            </tr>
          @endforeach
            </tbody>
        </table>
        </div>
      </div>
    </div>

  </body>
  
</html>