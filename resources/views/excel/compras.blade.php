<table>
    <thead>
        <tr>
          <th scope="col">#Factura</th>
          <th scope="col">Fecha</th>
          <th scope="col">Categoria</th>
          <th scope="col">Proveedor</th>
          <th scope="col">Exento</th>
          <th scope="col">Gravado 15%</th>
          <th scope="col">Gravado 18%</th>
          <th scope="col">Impuesto 15%</th>
          <th scope="col">Impuesto 18%</th>
          <th scope="col">Total</th>
         
        </tr>
    </thead>
    <tbody>   
      @foreach($compras as $compra)
      <tr>
        <td>{{$compra->codigo_compra}}</td>
        <td>{{$compra->fecha}}</td>
        <td>{{$compra->categoria}}</td>
        <td>{{$compra->proveedor->descripcion}}</td>
        <td>{{$compra->exento}}</td>
        <td>{{$compra->gravado15}}</td>
        <td>{{$compra->gravado18}}</td>
        <td>{{$compra->impuesto15}}</td>
        <td>{{$compra->impuesto18}}</td>
        <td>{{$compra->total}}</td>
    </tr>
     @endforeach
     </tbody>
</table>