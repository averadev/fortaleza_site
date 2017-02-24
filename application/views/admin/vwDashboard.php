<?php
$this->load->view('admin/vwHeader');
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<div class="page-header container">
    <h1><small>Dashboard</small></h1>
</div>
<div class="container">

    <div id="chart"></div>

</div><!-- /.container -->
<?php
$this->load->view('admin/vwFooter');
?>
<script src="<?php echo base_url().JS; ?>api/dashboard.js"></script>