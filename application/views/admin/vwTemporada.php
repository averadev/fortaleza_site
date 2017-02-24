<?php
$this->load->view('admin/vwHeader');
?>

<div class="page-header container">
  <h1><small>Temporadas</small></h1>
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
        <div class="panel-heading">Lista de Temporadas <span style='float:right; margin-top: -7px;'><a href='#' title='View' class="btn btn-primary btnAdd"><i class="fam-plus"></i> Temporada  </a></span></div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Fecha Inicio</th>
              <th>Fecha Fin</th>
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
        <p id="alert" class="bg-danger2">La fecha inicio, no puede ser mayor a la fecha fin.</p>
          <p id="inDate" class="bg-danger2">dsfdf</p>
        <input id="hideID" type="hidden" value="0">

        <div class="form-group">
          <label for="txtNombre"><span class="redPoint">*</span>Nombre</label>
          <input type="text" class="form-control" id="txtNombre">
        </div>

        
        <table>
          <tr>
            <td width="280">
              <a href="#" class="btn small" id="startDate" style="padding: 6px 0;" data-date-format="yyyy-mm-dd" data-date="2014-03-03"><span class="redPoint">*</span>Fecha Inicio:</a>
              <span></span>
            </td>
            <td width="60"></td>
            <td width="280">
              <a href="#" class="btn small" id="endDate" style="padding: 6px 0;" data-date-format="yyyy-mm-dd" data-date="2014-03-20"><span class="redPoint">*</span>Fecha Fin:</a>
              <span></span>
            </td>
          </tr>
        </table>
        <br/>

        <a id="btnGuardar" class="btn btn-primary pull-right">Guardar</a>
        <a id="btnCancelar" class="btn btn-danger pull-right">Cancelar</a>
        <br/><br/>
          
          <div class="panel panel-default" >
            <!-- Default panel contents -->
            <div class="panel-heading">Tipos de Habitación</div>

            <!-- Table -->
            <table class="table table-striped table-hover">
              <tbody id="bodyRooms" style="display: block; max-height: 320px; overflow-y: scroll">
              </tbody>
            </table>
          </div>
        <br/><br/>
          
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
<script src="<?php echo base_url().JS; ?>bootstrap-datepicker.js"></script>
<script src="<?php echo base_url().JS; ?>api/common.js"></script>
<script src="<?php echo base_url().JS; ?>api/temporada.js"></script>