<table>
    <thead>
        <tr>
          <th scope="col">Codigo Factura</th>
          <th scope="col">Fecha</th>
          <th scope="col">Cliente</th>
          <th scope="col">Tipo</th>
          <th scope="col">Descuentos</th>
          <th scope="col">Exento</th>
          <th scope="col">Importe Gravado 15%</th>
          <th scope="col">Impuesto 15%</th>
          <th scope="col">Total</th> 
        </tr>
    </thead>
    <tbody>   
      @foreach($facturas as $factura)
      <tr>
        <td> 000-001-01-{{ str_pad ($factura->codigo_factura, 8, '0', STR_PAD_LEFT) }}</td>
        <td>{{$factura->fecha}}</td>
        <td>{{$factura->cliente->nombre}}</td>
        <td>{{$factura->tipo_pago}}</td>
        <td>{{$factura->descuentos}}</td>
        <td>{{$factura->exento}}</td>
        <td>{{$factura->gravado15}}</td>
        <td>{{$factura->impuesto15}}</td>
        <td>{{$factura->total}}</td>
    </tr>
     @endforeach
     </tbody>
</table>