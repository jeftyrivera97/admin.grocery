<!-- Modal -->
<div class="modal fade" id="conversor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Conversor de Divisas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">       
                <label for="stock">Dolares ($)</label>
                <input class="form-control" id="inputDolares" type="number" placeholder="USD" oninput="dolaresLempiras(this.value)" onchange="dolaresEuros(this.value)">
              </div>
          <div class="form-group">       
            <label for="stock">Lempiras (L.)</label>
            <input class="form-control" id="inputEuros" type="number" placeholder="LPS" oninput="lempirasDolares(this.value)" onchange="eurosDolares(this.value)">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="salir" name="salir" class="btn btn-warning active" data-dismiss="modal">Salir</button>
        </div>
      </div>
    </div>
  </div>

  <script>

    $(document).ready(function() {
      $('#salir').click(function() {
        document.getElementById("inputDolares").value="";
        document.getElementById("inputEuros").value="";
      
      });
    });
    function lempirasDolares(valNum) {
        valNum=valNum/24.50;
        valNum = valNum.toFixed(2);
    document.getElementById("inputDolares").value=valNum;
    }
    function dolaresLempiras(valNum) {
        valNum=valNum*24.50;
        valNum = valNum.toFixed(2);
     document.getElementById("inputEuros").value=valNum;
    }
</script>