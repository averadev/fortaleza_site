<?php
$this->load->view('admin/vwHeader');
?>

<div class="page-header container">
  <h1><small>Tipos de Habitación</small></h1>
</div>

<div id="slider" class="owl-carousel">

  <!-- __________ TABLA __________ -->
  <div class="item">
    <div class="container" style="width:900px;">
      <div class="input-group">
        <input id="txtSearch" type="text"placeholder="Busqueda por nombre" class="form-control">
        <span class="input-group-addon btnSearch"><i class="fam-search"></i> Buscar</span>
      </div>
      <br/>
      <p class="bg-info">La información se almaceno satisfactoriamente.</p>
 
      <div class="panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">Lista de Habitaciones <span style='float:right; margin-top: -7px;'><a href='#' title='View' class="btn btn-primary btnAdd"><i class="fam-plus"></i> Habitación  </a></span></div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Disponibilidad</th>
              <th>Precio Estandar</th>
              <th>Adulto Extra</th>
              <th>Niño Extra</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="bodyTable">
          </tbody>
        </table>
      </div>
 
      <ul class="pagination">
     </ul>
    </div><!-- /.container -->
  </div>

  <!-- __________ FORMULARIO __________ -->
  <div class="item">
    <div class="container" style="width:620px;">
      <form role="form">
        <p class="bg-danger">Los campos marcados (<span class="redPoint">*</span>), son obligatorios...</p>

        <input id="hideID" type="hidden" value="0">
        <table>
          <tr>
            <td width="450">
              <div class="form-group">
                <label for="txtNombre"><span class="redPoint">*</span>Nombre</label>
                <input type="text" class="form-control" id="txtNombre">
              </div>
            </td>
            <td width="30"></td>
            <td width="110">
              <div class="form-group">
                <label for="txtNombre"><span class="redPoint">*</span>Disponibilidad</label>
                <input type="text" class="form-control" id="txtDisponibilidad">
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <div class="form-group">
                <label for="txtNombre"><span class="redPoint">*</span>Descripción</label>
               <textarea class="form-control" id="txtDescripcion" rows=3></textarea>
              </div>
            </td>
          </tr>
        </table>

        <table>
          <tr>
            <td>
              <div class="form-group">
                <label for="txtNombre"><span class="redPoint">*</span>Capacidad</label>
                <input type="text" class="form-control" id="txtCapacidad">
              </div>
            </td>
            <td width="50"></td>
            <td>
              <div class="form-group">
                <label for="txtNombre"><span class="redPoint">*</span>Precio Estandar</label>
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="text" class="form-control" id="txtPrecio">
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="form-group">
                <label for="txtNombre"><span class="redPoint">*</span>Costo Adulto Extra</label>
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="text" class="form-control" id="txtAdulto">
                </div>
              </div>
            </td>
            <td></td>
            <td>
              <div class="form-group">
                <label for="txtNombre"><span class="redPoint">*</span>Costo Niño Extra</label>
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="text" class="form-control" id="txtNino">
                </div>
              </div>
            </td>
          </tr>
        </table>

        <a id="btnGuardar" class="btn btn-primary pull-right">Guardar</a>
        <a id="btnCancelar" class="btn btn-danger pull-right">Cancelar</a>
      </form>
    </div>
  </div>
</div>


<!-- __________ HIDE MODAL __________ -->
<div class="modal fade modal-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-body">
        <h4 class="modal-title" id="mySmallModalLabel">¿Desea eliminar el registro?</h4>
        <br/><span id="delNombre"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="btnDeleteModal" type="button" class="btn btn-primary" data-dismiss="modal">Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 
<?php
$this->load->view('admin/vwFooter');
?>
<script src="<?php echo base_url().JS; ?>api/common.js"></script>
<script src="<?php echo base_url().JS; ?>api/habitacion.js"></script>