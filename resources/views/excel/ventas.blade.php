<table>
    <thead>
        <tr>
          <th scope="col">Codigo</th>
          <th scope="col">Fecha</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Total</th>
          <th scope="col">Usuario</th>
          
        </tr>
    </thead>
    <tbody>   
      @foreach($ventas as $venta)
      <tr>
        <td>{{$venta->id_venta}}</td>
        <td>{{$venta->fecha}}</td>
        <td>{{$venta->descripcion}}</td>
        <td>{{$venta->total}}</td>
        <td>{{$venta->user->name}}</td>
    </tr>
     @endforeach
     </tbody>
</table>