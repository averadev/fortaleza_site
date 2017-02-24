<?php
$this->load->view('admin/vwHeader');
?>

<div class="page-header container">
  <h1><small>Reservaciones</small></h1>
</div>

<!-- __________ TABLA __________ -->
  <div class="item">
    <div class="container">
      <div class="input-group">
        <input id="txtSearch" type="text" placeholder="Busqueda por cliente o codigo" class="form-control">
        <span class="input-group-addon btnSearch"><i class="fam-search"></i> Buscar</span>
      </div>
      <div class="input-group" style="margin-top:10px;">
          <div class="xFiltro">
            <label>Fecha Inicio</label>
            <input type="date" id="txtFechaIni" />
          </div>
          <div class="xFiltro">
            <label>Fecha Fin</label>
            <input type="date" id="txtFechaFin" />
          </div>
          <div class="xFiltro">
            <input type="checkbox" id="txtShowCo"><label for="txtShowCo">&nbsp;Mostrar CheckOuts</label>
          </div>
      </div>
      <br/>
      <p class="bg-info">La información se almaceno satisfactoriamente.</p>
 
      <div class="panel panel-default" >
        <!-- Default panel contents -->
        <div class="panel-heading">Lista de Reservaciones</div>

        <!-- Table -->
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Cliente</th>
              <th>Estado</th>
              <th>Llegada</th>
              <th>Salida</th>
              <th>Habitacion(es)</th>
              <th>Total</th>
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

<!-- __________ HIDE MODAL __________ -->
<div class="modal fade modal-edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-body">
        <h4 class="modal-title" id="mySmallModalLabel">Información del Registro</h4>
        <br/>
          
        <table style="margin-left: 30px;">
          <tr>
            <td>
              <label id="txtNombre" style="font-size: xx-large;"></label>
            </td>
          </tr>
          <tr>
            <td >
              <label id="txtLlegadaSalida" style="font-size: large; margin-bottom:20px;"></label>
            </td>
          </tr>
          <tr>
            <td >
              <label id="txtHabitaciones" style="font-size: medium;"></label>
            </td>
          </tr>
          <tr>
            <td >
              <label id="txtTotal" style="font-size: large; margin-bottom:20px;"></label>
            </td>
          </tr>
          <tr>
            <td >
                <label class="custom-select">
                    <select id="selEstado">
                      <option value="1">Tentativo</option>
                      <option value="2">Pagado</option>
                      <option value="3">CheckIn</option>
                      <option value="4">CheckOut</option>
                  </select>
                </label>
            </td>
          </tr>
        </table>
          
          <span id="delNombre"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button id="btnUpdateModal" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  
<?php
$this->load->view('admin/vwFooter');
?>
<script src="<?php echo base_url().JS; ?>api/common.js"></script>
<script src="<?php echo base_url().JS; ?>api/reservacion.js"></script>