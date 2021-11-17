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
        
    <title>REPORTE DE VENTA: {{ $fecha}}</title>
    </head>
    <body>
        <div class="ticket">
            <p class="centered"><b>REPORTE DE VENTA</b>
                <br><b>{{$empresa->descripcion}}  
                <br>{{$empresa->razon_social}}</b>
                <br><b>Direccion:</b>{{$empresa->direccion}}
                <br><b>RTN:</b>{{$empresa->codigo_empresa}}
                <br><b>Cai:</b>{{$empresa->cai}}
                <br><b>Correo:</b>{{$empresa->correo}}
                <br><b>Telefono:</b>{{$empresa->telefono}}
                <br>
                <br><b>-------------DETALLES----------------</b>
                <br>
                <br><b>Fecha:</b> {{ $fecha}}
                <br><b>Fecha Apertura:</b> {{ $HoraInicio}}
                <br><b>Fecha Cierre:</b> {{ $HoraFinal}}
                <br><b>Cajero:</b> {{ $usuario}}
                <br>--------------------------------
                <br><b>TOTAL EFECTIVO:</b>LPS. {{$efectivo}}
                <br><b>TOTAL POS:</b>LPS. {{ $pos}}
                <br>---------------------------------
                <br><b>CAJA EFECTIVO:</b>LPS. {{ $e}}
                <br><b>CAJA POS:</b>LPS. {{$p}}
                <br><b>TOTAL CAJA:</b>LPS. {{ $tot}}
                <br>---------------------------------
                <br><b>FALTANTE:</b>LPS. -{{ $faltante}}
                <br><b>TOTAL VENDIDO</b>LPS. {{$total}}
                <br>
                <br><b>---------------UL------------------</b>
            </p>
        </div>
       
    </body>
</html>

