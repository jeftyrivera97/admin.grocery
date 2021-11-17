<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title> Reporte de Balance Comparativo </title>
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
   <h1 style="text-align:center" class="display-4">REPORTE DE BALANCE COMPARATIVO</h1>
   <br>
   <p><b>Fecha de Hoy:</b> {{$hoy}}</p>
   <p><b>Empresa:</b> {{$empresa->descripcion}}      <b>R.T.N:</b>{{$empresa->codigo_empresa}}</p>     
   <p><b>Direccion:</b>{{$empresa->direccion}}</p>
   
   <br>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <p><b>1er Mes: {{$inicioMes1}} a {{$finalMes1}} </p>
        <p><b>2do Mes: {{$inicioMes2}} a {{$finalMes2}} </p>
        <div class="col">
          <table class="center" id="datos">
            <thead>
              <tr>
                <th scope="col">DESCRIPCION</th>
                <th scope="col">{{$primerMes}} </th>
                <th scope="col">{{$segundoMes}}</th>
              </tr>
          </thead>
          <tbody>   
            <tr>
              <td>VENTAS</td>
              <td>L. {{$ventasPrimerMes}}</td>
              <td>L. {{$ventasSegundoMes}}</td>            
          </tr>
          <tr>
            <td>COMPRAS</td>
            <td>L. {{$comprasPrimerMes}}</td>
            <td>L. {{$comprasSegundoMes}}</td>
          </tr>
          <tr>
            <td>GASTOS</td>
            <td>L. {{$gastosPrimerMes}}</td> 
            <td>L. {{$gastosSegundoMes}}</td> 
          </tr>
          <tr>
            <td>PLANILLA</td>
            <td>L. {{$planillasPrimerMes}}</td> 
            <td>L. {{$planillasSegundoMes}}</td> 
          </tr>
          <tr>
            <td id="total">BALANCE (+/-)</td>
            <td id="total">L. {{$balancePrimerMes}}</td>
            <td id="total">L. {{$balanceSegundoMes}}</td>  
          </tr>
          </tbody>
      </table>
      <br>
      <table class="center" id="datos">
        <thead>
          <tr>
            <th scope="col">DESCRIPCION</th>
            <th scope="col">{{$primerMes}} </th>
            <th scope="col">{{$segundoMes}}</th>
          </tr>
      </thead>
      <tbody>   
        <tr>
          <td>INGRESOS TOTAL</td>
          <td>L. {{$ingresosPrimerMes}}</td>
          <td>L. {{$ingresosSegundoMes}}</td>              
      </tr>
      <tr>
        <td>EGRESOS TOTAL</td>
        <td>L. {{$egresosPrimerMes}}</td>
        <td>L. {{$egresosSegundoMes}}</td>
      </tr>
      <tr>
        <td id="c">BALANCE(+/-)</td>
        <td id="c">L. {{$balancePrimerMes}}</td> 
        <td id="c">L. {{$balanceSegundoMes}}</td> 
      </tr>
      </tbody>
  </table>
       <br>
      </div>
      <div class="row">
        <div class="col">
          <table class="center" id="datos">
              <thead>
                <tr>
                  <th scope="col">INGRESOS/EGRESOS</th>
                  <th scope="col">DIFERENCIA(+/-)</th>
                </tr>
            </thead>
            <tbody>   
              @foreach($comparativos as $comparativo)
              <tr>
                <td>{{$comparativo['descripcion']}}</td>
                <td>L. {{$comparativo['diferencia']}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <table class="center" id="datos">
              <thead>
                <tr>
                  <th scope="col">CATEGORIAS DE COMPRAS</th>
                  <th scope="col">DIFERENCIA(+/-)</th>
                </tr>
            </thead>
            <tbody>   
              @foreach($categoriaCompras as $categoriaCompra)
              <tr>
                <td>{{$categoriaCompra['descripcion']}}</td>
                <td>L. {{$categoriaCompra['diferencia']}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <table class="center" id="datos">
              <thead>
                <tr>
                  <th scope="col">CATEGORIAS DE GASTOS</th>
                  <th scope="col">DIFERENCIA(+/-)</th>
                </tr>
            </thead>
            <tbody>   
              @foreach($categoriaGastos as $categoriaGasto)
              <tr>
                <td>{{$categoriaGasto['descripcion']}}</td>
                <td>L. {{$categoriaGasto['diferencia']}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
      </div>
     
    </div>
    </div>

  </body>
</html>
