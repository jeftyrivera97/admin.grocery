<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Factura</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="tipo_pago">*Tipo de Pago</label>
                  <select name="tipo_pago" input id="tipo_pago" class="form-control" required>
                    <option value="">--Selecione--</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="POS">POS</option>
                    <option value="Credito">Credito</option>
                  </select>
                </div>
                <div class="form-group">       
                  <label for="stock">N° Recibo POS *Opcional</label>
                  <input type="text" class="form-control" name="codigo_pos" id="codigo_pos" type="number" readonly>
                </div>
                
               
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">       
                  <label for="stock">*Total a Pagar L.</label>
                  <input type="text" class="form-control" name="total_modal" id="total_modal" type="number" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group"> 
                  <label for="stock">*Total a Pagar $</label>      
                  <input type="text" class="form-control" name="total_usd" id="total_usd" type="number" readonly>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">       
                    <label for="stock">*Efectivo</label>
                    <input type="text" class="form-control" name="efectivo" id="efectivo" type="number" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">       
                    <label for="stock">*Cambio</label>
                    <input type="text" class="form-control" name="cambio" id="cambio" type="number" readonly>
                  </div>
                </div>
              </div>
            </div>
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning active" data-dismiss="modal"><i class="fas fa-backward"></i> Cancelar</button>
          <button type="submit" id="guardar" class="btn btn-success active"><i class="far fa-save"></i> Guardar Venta</button>
        </div>
      </div>
    </div>
  </div>

  <script>
$(document).ready(function() {

  $('#tipo_pago').change(function() {
    
    var opcion=document.getElementById("tipo_pago").value;
    
    if(opcion=="POS")
    {
      document.getElementById("efectivo").readOnly=true;
      document.getElementById("codigo_pos").readOnly=false;
      document.getElementById("codigo_pos").focus();
      var x = document.getElementById("codigo_pos").required=true;
      var x = document.getElementById("efectivo").required=false;
      document.getElementById("codigo_pos").value="";
      document.getElementById("cambio").value="";
      document.getElementById("efectivo").value="";
     
    }
    if(opcion=="Efectivo")
    {
      document.getElementById("codigo_pos").readOnly=true;
      document.getElementById("efectivo").readOnly=false;
      document.getElementById("efectivo").focus();
      var x = document.getElementById("efectivo").required=true;
      var x = document.getElementById("codigo_pos").required=false;
      document.getElementById("codigo_pos").value="";
      document.getElementById("cambio").value="";
      document.getElementById("efectivo").value="";
     
    }
    if(opcion=="Credito")
    {
      document.getElementById("codigo_pos").readOnly=true;
      document.getElementById("efectivo").readOnly=true;
      document.getElementById("guardar").focus();
      var x = document.getElementById("codigo_pos").required=false;
      var x = document.getElementById("efectivo").required=false;
      document.getElementById("codigo_pos").value="";
      document.getElementById("cambio").value="";
      document.getElementById("efectivo").value="";
      
    }
  });
 
  $('#efectivo').keyup(function() {
    var total=document.getElementById("total").value;
  var efectivo=document.getElementById("efectivo").value;
   var cambio= efectivo-total;
    document.getElementById("cambio").value=cambio;
  });

  $('#guardar').click(function() {
   

  });
});
  </script>