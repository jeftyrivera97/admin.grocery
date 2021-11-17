<!-- Modal -->
<div class="modal fade" id="productoEncontrado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Producto: {{$productos->descripcion}} </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">       
                <label for="stock">Codigo</label>
                <input class="form-control" id="codigo_producto" type="text" value="{{$productos->codigo_producto}}" readonly>
              </div>
          <div class="form-group">       
            <label for="stock">Categoria</label>
            <input class="form-control" id="id_categoria" type="text" value="{{$productos->productoCategoria->descripcion}}" readonly >
          </div>
          <div class="form-group">       
            <label for="stock">En Inventario</label>
            <input class="form-control" id="stock" type="text" value="{{$productos->stock}}" readonly >
          </div>
          <div class="form-group">       
            <label for="stock">Precio de Venta</label>
            <input class="form-control" id="precio_venta" type="text" value="{{$productos->precio_venta}}" readonly >
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="salir" name="salir" class="btn btn-warning active" data-dismiss="modal">Salir</button>
        </div>
      </div>
    </div>
  </div>

