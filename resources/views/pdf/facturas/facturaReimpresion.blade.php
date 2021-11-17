<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
                        * 
                {
                    font-size: 12px;
                    font-family: 'Times New Roman';
                }

                td,
                th,
                tr,
                table {
                    border-top: 1px solid black;
                    border-collapse: collapse;
                }

                td.description,
                th.description {
                    width: 75px;
                    max-width: 75px;
                }

                td.quantity,
                th.quantity {
                    width: 40px;
                    max-width: 40px;
                    word-break: break-all;
                }

                td.price,
                th.price {
                    width: 40px;
                    max-width: 40px;
                    word-break: break-all;
                }

                .centered {
                    width: 200px;
                    text-align: center;
                    align-content: center;
                    
                }

                .ticket {
                    width: 155px;
                    max-width: 155px;
                }
        </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
    <title>Factura de Venta  001-001-01-{{ str_pad ($facturas->codigo_factura, 8, '0', STR_PAD_LEFT) }}</title>
    </head>
    <body>
        <div class="ticket">
            <p class="centered"><b>{{$empresa->descripcion}}  
                <br>{{$empresa->razon_social}}</b>
                <br><b>Direccion:</b>{{$empresa->direccion}}
                <br><b>RTN:</b>{{$empresa->codigo_empresa}}
                <br><b>Cai:</b>{{$empresa->cai}}
                <br><b>Correo:</b>{{$empresa->correo}}
                <br><b>Telefono:</b>{{$empresa->telefono}}
                <br>------------------------------
                <br><b>FACTURA DE VENTA</b>
                <br><b>No. Factura:</b> 000-001-01-{{ str_pad ($facturas->codigo_factura, 8, '0', STR_PAD_LEFT) }}
                <br><b>Fecha emitida:</b> {{ $facturas->fechaHora }}
                <br><b>Tipo Factura:</b> {{ $facturas->cuenta->descripcion}}
                <br><b>Cajero:</b> {{ $facturas->user->name}}
                <br>-------------------------------
                <br><b>Cliente:</b>{{ $facturas->cliente->nombre }}
                <br><b>RTN:</b>{{ $facturas->cliente->codigo_cliente }}
                <br>--------------------------------
                <br><b>Datos del Adquiriente Exonerado</b>
                <br>No. Compra Exenta: ______
                <br>No. Constancia Registro Exonerado: ______
                <br>No. Registro de S.A.G:______
                <br>---------------------------------
            </p>
            <table>
                <thead>
                    <tr>
                        <th class="quantity">Cant.</th>
                        <th class="description">Descripcion</th>
                        <th class="price">Precio</th>
                        <th class="price">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detalles as $detalle)
                    <tr>
                        <td class="quantity">{{$detalle->cantidad}}</td>
                        <td class="description">{{$detalle->producto->descripcion}}</td>
                        <td class="price">Lps. {{number_format($detalle->precio_venta, 2)}}</td>
                        <td class="text-right">Lps. {{number_format($detalle->subtotal, 2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right"><b>Descuentos/Rebajas</b></td>
                        <td class="text-right">Lps. {{ number_format($facturas->descuentos, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right"><b>Total Exonerado</b></td>
                        <td class="text-right">Lps. {{ number_format($facturas->exento, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right"><b>Total Gravado 15%</b></td>
                        <td class="text-right">Lps. {{ number_format($facturas->gravado15, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right"><b>Total Gravado 18%</b></td>
                        <td class="text-right">Lps. {{ number_format($facturas->gravado18, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right"><b>Total I.S.V 15%</b></td>
                        <td class="text-right">Lps. {{ number_format($facturas->impuesto15, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right"><b>Total I.S.V 18%</b></td>
                        <td class="text-right">Lps. {{ number_format($facturas->impuesto18, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right"><b>Total</b></td>
                        <td class="text-right">Lps. {{ number_format($facturas->total, 2) }}</td>
                    </tr>
                    </tfoot>
                </table>
              
            <p class="centered"><b>{{$facturas->total_letras}}</b>
                <br><b>Efectivo: {{$facturas->total}}</b>
                <br><b>Su Cambio: 0.00</b>
                <br>---------------------------------
                <br><b>Total Articulos:</b> {{$articulos}}
                <br>---------------------------------
                <br><b>Rango Autorizado:</b>
                <br>000-001-01-{{ str_pad ($folio->inicio, 8, '0', STR_PAD_LEFT) }}
                <br>al 000-001-01-{{ str_pad ($folio->final, 8, '0', STR_PAD_LEFT) }}
                <br><b>Fecha Limite de Emision:</b> {{$folio->fecha_final}} 
                <br><b> ORIGINAL:</b> CLIENTE
                <br><b> COPIA:</b> OBLIGADO TRIBUTARIO
                <br><b>GRACIAS POR SU COMPRA!<b>
            </p>
        </div>
       
    </body>
</html>

