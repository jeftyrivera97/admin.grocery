<html>
    <head>
        <style>
            .header{background:#eee;color:#444;border-bottom:1px solid #ddd;padding:10px;}

            .client-detail{background:#ddd;padding:10px;}
            .client-detail th{text-align:left;}

            .items{border-spacing:0;}
            .items thead{background:#ddd;}
            .items tbody{background:#eee;}
            .items tfoot{background:#ddd;}
            .items th{padding:10px;}
            .items td{padding:10px;}

            h1 small{display:block;font-size:16px;color:#888;}

            table{width:100%;}
            .text-right{text-align:right;}
        </style>
    </head>
    <body>

    <div class="header">
            <h1>
                {{$empresa->descripcion}}      
                <small>
                    <p><b>RTN:</b>{{$empresa->codigo_empresa}}      <b>Direccion:</b>{{$empresa->direccion}}</p>
                    <p><b>Cai:</b>{{$empresa->cai}}</p>
                    <p><b>Correo:</b>{{$empresa->correo}}</p>
                    <p><b>Telefono:</b>{{$empresa->telefono}}</p>
                </small>
            </h1>
    </div>
    <div class="header">
        <h2>
            <h4 style="text-align: center">FACTURA DE VENTA</h4>
            <br>
            No. Factura: 001-001-01-{{ str_pad ($facturas->id_factura, 8, '0', STR_PAD_LEFT) }}
            <br>
            <small>
                Fecha emitida: {{ $facturas->fechaHora }}
                <br>
                Cajero: {{ $facturas->user->name}}
            </small>
        </h2>
    </div>
    <table class="client-detail">
        <tr>
            <th style="width:100px;">
                Cliente:
            </th>
            <td>{{ $facturas->cliente->nombre }}</td>
        </tr>
        <tr>
            <th>RTN:</th>
            <td>{{ $facturas->cliente->codigo_cliente }}</td>
        </tr>
    </table>
    <table class="client-detail">
        <tr>
            <th style="width:100px;">
               <p><b>Datos del Adquiriente Exonerado</b></p>
            </th>
        </tr>
        <tr>
            <th>No. Compra Exenta: ______</th>
        </tr>
        <tr>
            <th>No. Constancia Registro Exonerado: ______</th>
        </tr>
        <tr>
            <th>No. Registro de S.A.G:______</th>
        </tr>
    </table>
    <hr />

    <table class="items">
        <thead>
            <tr>
                <th class="text-left">Codigo</th>
                <th class="text-right" style="width:100px;">Descripcion</th>
                <th class="text-right" style="width:100px;">Cantidad</th>
                <th class="text-right" style="width:100px;">P.U</th>
                <th class="text-right" style="width:100px;">Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach($detalles as $detalle)
            <tr>
                <td>{{$detalle->producto->codigo_producto}}</td>
                <td class="text-right">{{$detalle->producto->descripcion}}</td>
                <td class="text-right">{{$detalle->cantidad}}</td>
                <td class="text-right">Lps. {{number_format($detalle->precio_venta, 2)}}</td>
                <td class="text-right">Lps. {{number_format($detalle->subtotal, 2)}}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        
        <tr>
            <td colspan="4" class="text-right"><b>Descuentos/Rebajas</b></td>
            <td class="text-right">Lps. {{ number_format(0, 2) }}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>Total Exonerado</b></td>
            <td class="text-right">Lps. {{ number_format($facturas->exento, 2) }}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>Total Gravado 15%</b></td>
            <td class="text-right">Lps. {{ number_format($facturas->gravado15, 2) }}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>Total Gravado 18%</b></td>
            <td class="text-right">Lps. {{ number_format($facturas->gravado18, 2) }}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>Total I.S.V 15%</b></td>
            <td class="text-right">Lps. {{ number_format($facturas->impuesto15, 2) }}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>Total I.S.V 18%</b></td>
            <td class="text-right">Lps. {{ number_format($facturas->impuesto18, 2) }}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><b>Total</b></td>
            <td class="text-right">Lps. {{ number_format($facturas->total, 2) }}</td>
        </tr>
        </tfoot>
    </table>
    <hr />
    <table class="client-detail">
        <tr>
            <th style="width:100px;">
                Total Articulos: 
            </th>
            <td>{{$articulos}}</td>
        </tr>
        <tr>
            <th>Rango Autorizado:</th>
            <td>000-001-01-00020001 al 000-001-01-00120000 </td>
        </tr>
    </table>
    <div class="header">
        <h2> 
            Fecha Limite de Emision: 07/11/2020
            <br>
           
            <small>
                ORIGINAL: CLIENTE
                <br>
                COPIA: OBLIGADO TRIBUTARIO

            </small>
        </h2>
    </div>
    </body>
</html>

<script>
    document.getElementById("numero").addEventListener("input",function(e){
        document.getElementById("texto").innerHTML=NumeroALetras(this.value);
    });
  
     
     
    function Unidades(num){
     
      switch(num)
      {
        case 1: return "UN";
        case 2: return "DOS";
        case 3: return "TRES";
        case 4: return "CUATRO";
        case 5: return "CINCO";
        case 6: return "SEIS";
        case 7: return "SIETE";
        case 8: return "OCHO";
        case 9: return "NUEVE";
      }
     
      return "";
    }
     
    function Decenas(num){
     
      decena = Math.floor(num/10);
      unidad = num - (decena * 10);
     
      switch(decena)
      {
        case 1:
          switch(unidad)
          {
            case 0: return "DIEZ";
            case 1: return "ONCE";
            case 2: return "DOCE";
            case 3: return "TRECE";
            case 4: return "CATORCE";
            case 5: return "QUINCE";
            default: return "DIECI" + Unidades(unidad);
          }
        case 2:
          switch(unidad)
          {
            case 0: return "VEINTE";
            default: return "VEINTI" + Unidades(unidad);
          }
        case 3: return DecenasY("TREINTA", unidad);
        case 4: return DecenasY("CUARENTA", unidad);
        case 5: return DecenasY("CINCUENTA", unidad);
        case 6: return DecenasY("SESENTA", unidad);
        case 7: return DecenasY("SETENTA", unidad);
        case 8: return DecenasY("OCHENTA", unidad);
        case 9: return DecenasY("NOVENTA", unidad);
        case 0: return Unidades(unidad);
      }
    }//Unidades()
     
    function DecenasY(strSin, numUnidades){
      if (numUnidades > 0)
        return strSin + " Y " + Unidades(numUnidades)
     
      return strSin;
    }//DecenasY()
     
    function Centenas(num){
     
      centenas = Math.floor(num / 100);
      decenas = num - (centenas * 100);
     
      switch(centenas)
      {
        case 1:
          if (decenas > 0)
            return "CIENTO " + Decenas(decenas);
          return "CIEN";
        case 2: return "DOSCIENTOS " + Decenas(decenas);
        case 3: return "TRESCIENTOS " + Decenas(decenas);
        case 4: return "CUATROCIENTOS " + Decenas(decenas);
        case 5: return "QUINIENTOS " + Decenas(decenas);
        case 6: return "SEISCIENTOS " + Decenas(decenas);
        case 7: return "SETECIENTOS " + Decenas(decenas);
        case 8: return "OCHOCIENTOS " + Decenas(decenas);
        case 9: return "NOVECIENTOS " + Decenas(decenas);
      }
     
      return Decenas(decenas);
    }//Centenas()
     
    function Seccion(num, divisor, strSingular, strPlural){
      cientos = Math.floor(num / divisor)
      resto = num - (cientos * divisor)
     
      letras = "";
     
      if (cientos > 0)
        if (cientos > 1)
          letras = Centenas(cientos) + " " + strPlural;
        else
          letras = strSingular;
     
      if (resto > 0)
        letras += "";
     
      return letras;
    }//Seccion()
     
    function Miles(num){
      divisor = 1000;
      cientos = Math.floor(num / divisor)
      resto = num - (cientos * divisor)
     
      strMiles = Seccion(num, divisor, "MIL", "MIL");
      strCentenas = Centenas(resto);
     
      if(strMiles == "")
        return strCentenas;
     
      return strMiles + " " + strCentenas;
     
      //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);
    }//Miles()
     
    function Millones(num){
      divisor = 1000000;
      cientos = Math.floor(num / divisor)
      resto = num - (cientos * divisor)
     
      strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
      strMiles = Miles(resto);
     
      if(strMillones == "")
        return strMiles;
     
      return strMillones + " " + strMiles;
     
      //return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);
    }//Millones()
     
    function NumeroALetras(num,centavos){
      var data = {
        numero: num,
        enteros: Math.floor(num),
        centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
        letrasCentavos: "",
      };
      if(centavos == undefined || centavos==false) {
        data.letrasMonedaPlural="LEMPIRAS";
        data.letrasMonedaSingular="LEMPIRAS";
      }else{
        data.letrasMonedaPlural="CENTAVOS";
        data.letrasMonedaSingular="CENTAVOS";
      }
     
      if (data.centavos > 0)
        data.letrasCentavos = "CON " + NumeroALetras(data.centavos,true);
     
      if(data.enteros == 0)
        return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
      if (data.enteros == 1)
        return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
      else
        return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
    }//NumeroALetras()

    </script>