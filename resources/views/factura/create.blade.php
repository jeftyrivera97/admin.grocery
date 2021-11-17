@extends('layouts.app')
@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Nueva Factura</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{!! url('factura') !!}"  class="btn btn-warning active btn-sm"><i class="fas fa-backward"></i> Regresar</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection 
@section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-2">
          <div class="row">
            <div class="col-sm-12">
              <div class="container" style="border-style: ridge; ">
                <div class="form-group">
                  <label for="id_producto">Producto*</label>
                  <input type="text" class="form-control" id="codigo" name="codigo" value="{{old('codigo')}}" placeholder="">
                  <a href="{!!url('producto')!!}" target="_blank" class="btn btn-light btn-sm active"><i class="fas fa-fw fa-clipboard-list"></i></a>
                </div>
              <form action="{!!route('/facturas/productos')!!}" method="POST" id="form1">
                @csrf     
                <div class="form-group">
                 
                  <input type="text" hidden class="form-control" id="id_producto" name="id_producto" value="{{old('id_producto')}}" placeholder="">
                  <input type="text" hidden class="form-control" id="codigo_producto" name="codigo_producto" value="{{old('codigo_producto')}}" placeholder="">
                  <input type="hidden" name="descripcion" id="descripcion"/>
                  <input type="hidden" name="impuesto15" id="impuesto15" value="0"/>
                  <input type="hidden" name="impuesto18" id="impuesto18" value="0"/>
                  <input type="hidden" name="gravado15" id="gravado15" value="0"/>
                  <input type="hidden" name="gravado18" id="gravado18" value="0"/>
                  <input type="hidden" name="exento" id="exento" value="0"/>
                  <input type="hidden" name="tipo_impuesto" id="tipo_impuesto"/>
                  <input type="hidden" name="codigo_p" id="codigo_p"/>
                  
                </div>
              
              </form> 
              <div class="form-group">
                <label for="precio_venta">*Precio Venta</label>
                <input id="precio_venta" type="text" class="form-control" readonly  name="precio_venta" value="" placeholder="">
              </div>
    
              <div class="form-group">       
                <label for="stock">*Cantidad</label>
                <input id="cantidad" class="form-control" type="number" value="" placeholder="0" name="stock">   
              </div>
              
              <div class="form-group">
                <button id="adicionar" class="btn btn-info btn-sm" type="button"><i class="fas fa-plus"></i></button>
              </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-10"> 
          <div class="container" style="border-style: ridge;">
          <form action="/factura" method="POST" id="form2">
            @csrf
            @include('factura.modal')
          <div class="row">
            <div class="col-sm-3"> 
              <div class="form-group">
                <label for="id_cliente">*Cliente</label>
                    <select name="id_cliente" required input type="text" id="id_cliente" class="form-control">
                        <option value="">--Seleccione--</option>
                        @foreach ($clientes as $cliente)
                        <option value="{{ $cliente['id_cliente'] }}"> {{ $cliente['nombre'] }}  {{ $cliente['codigo_cliente'] }}</option>
                        @endforeach
                    </select>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">       
                <label for="stock">Descuento <span>*Opcional</span></label>
                <input type="text" class="form-control" value="0" name="descuento_total" id="descuento_total" hidden >
                <select name="descuento" id="descuento" class="form-control" disabled>
                  <option value="">--Seleccione--</option>
                  <option value="0.05">5%</option>
                  <option value="0.10">10%</option>
                  <option value="0.15">15%</option>
                  <option value="0.20">20%</option>
                </select>
              </div>
              
            </div>
            <div class="col-sm-3">
              <div class="form-group">       
                <label for="stock">*Gran Total USD</label>
                <input type="text" class="form-control" name="total_dolares" id="total_dolares" type="number" readonly>
              </div>
              
            </div>
            <div class="col-sm-3">
              <div class="form-group">       
                <label for="stock">*Gran Total LPS</label>
                <input type="text" class="form-control" name="total" id="total" type="number" readonly>
                <input type="text" class="form-control" name="total_d" id="total_d" type="number" readonly hidden>
                <input type="text" class="form-control" name="total_numeros" id="total_numeros" type="number" hidden>
                <input type="text" class="form-control" name="total_letras" id="total_letras" type="number" value="" hidden>
              </div>
              <div class="form-group">
                <a href="#" class="btn btn-success active pull-right" data-toggle="modal" data-target="#create" id="ejecutar">
                Ejecutar
                </a> 
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12"> 
              <div class="table-responsive">
                <table class="table" style="width:100%"  id="mytable" >
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col" style="color: white" style="width:40px">N°</th>
                      <th scope="col" style="color: white" style="width:40px">Codigo</th>
                      <th scope="col" style="color: white" style="width:100px">Codigo Barras</th>
                      <th scope="col" style="color: white" style="width:175px">Descripcion</th>
                      <th scope="col" style="color: white" style="width:50px">Cantidad</th>
                      <th scope="col" style="color: white" style="width:80px">Precio</th>
                      <th scope="col" style="color: white" style="width:80px">Exento</th>
                      <th scope="col" style="color: white" style="width:80px">I.G. 15%</th>
                      <th scope="col" style="color: white" style="width:80px">I.G. 18%</th>
                      <th scope="col" style="color: white" style="width:80px">ISV 15%</th>
                      <th scope="col" style="color: white" style="width:80px">ISV 18%</th>
                      <th scope="col" style="color: white" style="width:80px">Subtotal</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          </form>
        </div>
        </div>
      </div>
    </div>
  
<script>

var subtotal;
  var contador=0;
  var ultimo=0;
  var contador_fila=1;
  var l= 0;
  var contador15= 0;
  var contador18= 0;
  
$(document).ready(function() {
  document.getElementById("form1").reset();
  document.getElementById("form2").reset();

  $('#codigo').change(function(){
      var cod= document.getElementById("codigo").value;
      document.getElementById("codigo_producto").value=cod;
      $.ajax({
      url: '/facturas/productos',
      method:'POST',
      data:$('#form1').serialize()
      }).done(function(res){

        if(res=="NO EXISTE")
        {
          alert("Producto NO EXISTE. Cambie el Codigo");
          document.getElementById("codigo").value="";
          document.getElementById("codigo_producto").value="";
          document.getElementById("id_producto").value="";
          document.getElementById("codigo").focus();

        }else{
        var arreglo= JSON.parse(res);
       $("#precio_venta").val(arreglo[0].precio_venta);
       $("#descripcion").val(arreglo[0].descripcion);
       $("#id_producto").val(arreglo[0].id_producto);
       $("#codigo_p").val(arreglo[0].codigo_producto);

       var id_impuesto= arreglo[0].id_impuesto;
       if(id_impuesto==1)
       { 
         $("#exento").val(arreglo[0].exento);
         $("#impuesto15").val(0);
         $("#impuesto18").val(0);
         $("#gravado15").val(0);
         $("#gravado18").val(0);
       }
       if(id_impuesto==2)
       {
        $("#impuesto15").val(arreglo[0].impuesto);
        $("#gravado15").val(arreglo[0].gravado);
        $("#impuesto18").val(0);
        $("#gravado18").val(0);
        $("#exento").val(0);
       }
       if(id_impuesto==3)
       {
        $("#impuesto18").val(arreglo[0].impuesto);
        $("#gravado18").val(arreglo[0].gravado);
        $("#impuesto15").val(0);
        $("#gravado15").val(0);
        $("#exento").val(0);
       }
       document.getElementById("cantidad").focus();
        }
      });

  });

  $('#id_cliente').change(function() {
    
    document.getElementById("descuento").disabled = false;
   
  });

  $('#descuento').change(function() {
    
    var total= document.getElementById("total_d").value;
    var descuento=document.getElementById("descuento").value;

    var des= total*descuento;
    total= total-des;
    document.getElementById("descuento_total").value=des;
    document.getElementById("total").value=total;
    document.getElementById("total_modal").value=total;
    document.getElementById("total_numeros").value=total;

    $('#total_numeros').val(function(e){
    document.getElementById("total_letras").value=NumeroALetras(this.value);
    });

    var cambio= 24.50;
    var lps= document.getElementById("total_modal").value;
    var usd= lps/cambio;
    usd = usd.toFixed(2);

    document.getElementById("total_usd").value= usd;
    document.getElementById("total_dolares").value= usd;

    document.getElementById("ejecutar").focus();

  });

   $('#adicionar').click(function() {
    
    var codigo = document.getElementById("id_producto").value;
    var cantidad = document.getElementById("cantidad").value;
    var precio = document.getElementById("precio_venta").value;
    var codigoBarras=document.getElementById("codigo_p").value;
    var descripcion = document.getElementById("descripcion").value;
    var impuesto15 = document.getElementById("impuesto15").value*cantidad;
    var impuesto18 = document.getElementById("impuesto18").value*cantidad;
    var gravado15 = document.getElementById("gravado15").value*cantidad;
    var gravado18 = document.getElementById("gravado18").value*cantidad;
    var exento = document.getElementById("exento").value*cantidad;
    var rowCount = $('#myTable').length;
    subtotal= cantidad*precio;
    contador+= subtotal;
    ultimo=subtotal;
    document.getElementById("total").value= contador;
    document.getElementById("total_modal").value= contador;
    document.getElementById("total_d").value= contador;
    document.getElementById("total_numeros").value= contador;
    $('#total_numeros').val(function(e){
    document.getElementById("total_letras").value=NumeroALetras(this.value);
    });

    var cambio= 24.50;
    var lps= document.getElementById("total_modal").value;
    var usd= lps/cambio;
    usd = usd.toFixed(2);

    document.getElementById("total_usd").value= usd;
    document.getElementById("total_dolares").value= usd;

    var i = 1; //contador para asignar id al boton que borrara la fila
    var fila = '<tr id="row' + i + '">'+
    '<td style="width:40px"><input class="form-control" type="text" style="width: 40px" name="productos['+l+'][linea_detalles]" value="'+contador_fila+'" readonly></td>'+ 
    '<td style="width:40px"><input class="form-control" type="text" style="width: 40px" name="productos['+l+'][id_producto]" value="'+codigo+'" readonly></td>'+ 
    '<td style="width:100px"><input class="form-control" type="text" style="width: 100px" name="productos['+l+'][codigo_producto]" value="'+codigoBarras+'" readonly></td>'+ 
    '<td style="width:200px"><input class="form-control" type="text" style="width: 200px" name="productos['+l+'][descripcion]" value="'+descripcion+'" readonly></td>'+ 
    '<td style="width:50px"><input class="form-control" type="text" style="width: 50px" name="productos['+l+'][cantidad]" value="'+cantidad+'" readonly></td>'+ 
    '<td style="width:80px"><input class="form-control" type="text" style="width: 80px" name="productos['+l+'][precio_venta]" value="'+precio+'" readonly></td>'+ 
    '<td style="width:80px"><input class="form-control" type="text" style="width: 80px" name="productos['+l+'][exento]" value="'+exento+'" readonly></td>'+ 
    '<td style="width:80px"><input class="form-control" type="text" style="width: 80px" name="productos['+l+'][gravado15]" value="'+gravado15+'" readonly></td>'+
    '<td style="width:80px"><input class="form-control" type="text" style="width: 80px" name="productos['+l+'][gravado18]" value="'+gravado18+'" readonly></td>'+
    '<td style="width:80px"><input class="form-control" type="text" style="width: 80px" name="productos['+l+'][impuesto15]" value="'+impuesto15+'" readonly></td>'+
    '<td style="width:80px"><input class="form-control" type="text" style="width: 80px" name="productos['+l+'][impuesto18]" value="'+impuesto18+'" readonly></td>'+
    '<td style="width:80px"><input class="form-control" type="text" style="width: 80px" name="productos['+l+'][subtotal]" value="'+subtotal+'" readonly></td>   </tr>'; //esto seria lo que contendria la fila'+   
    i++;
    contador_fila= contador_fila+1;
    l=l+1;

    $('#mytable tr:first').after(fila);
    $("#adicionados").text(""); //esta instruccion limpia el div adicioandos para que no se vayan acumulando
    var nFilas = $("#mytable tr").length;
    $("#adicionados").append(nFilas - 1);
    //le resto 1 para no contar la fila del header
    document.getElementById("cantidad").value ="";
    document.getElementById("id_producto").value = "";
    document.getElementById("codigo_producto").value = "";
    document.getElementById("codigo").value = "";
    document.getElementById("precio_venta").value = "";
    document.getElementById("codigo").focus();
  });
  $(document).on('click', '.btn_remove', function() {
    
    
    contador-=ultimo;
    l=l-1;
    document.getElementById("total").value= contador;
    document.getElementById("total_modal").value= contador;
    document.getElementById("total_numeros").value= contador;
    $('#total_numeros').val(function(e){
    document.getElementById("total_letras").value=NumeroALetras(this.value);
    });

  var button_id = $(this).attr("id");
    //cuando da click obtenemos el id del boton
    $('#row' + button_id + '').remove(); //borra la fila
    //limpia el para que vuelva a contar las filas de la tabla
    $("#adicionados").text("");
    var nFilas = $("#mytable tr").length;
    $("#adicionados").append(nFilas - 1);
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
   data.letrasMonedaSingular="LEMPIRA";
 }else{
   data.letrasMonedaPlural="CENTAVOS";
   data.letrasMonedaSingular="CENTAVO";
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

});


</script>

@endsection