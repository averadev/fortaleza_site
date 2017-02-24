
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <title>Fortaleza Suites</title>
    <link href='http://fonts.googleapis.com/css?family=Gilda+Display' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>foundation.min.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>jquery.share.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>common.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>suites.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/reservas/css/plugins/colorbox/colorbox.css"/>
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/reservas/css/sales/reserve.css"/>
    <link rel="stylesheet" href="<?php echo base_url().JS; ?>fancyBox/jquery.fancybox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo base_url().JS; ?>fancyBox/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
    <script src="<?php echo base_url().JS; ?>vendor/modernizr.js"></script>
  </head>
  <body>
    
    <div id="container">
        
        <?php $this->load->view($page.getLang()); ?>
    
        <?php $this->load->view('vwMenu'.getLang()); ?>
        
    </div>

    <div id="footer">COPYRIGHT &#169; FORTALEZA SUITES PUERTO RICO</div>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/colorbox/jquery.colorbox.js"></script> 				
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/modal/jquery.modal.js"></script> 				
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/blockui/jquery.blockUI.js"></script>
    <script src="<?php echo base_url().JS; ?>foundation.min.js"></script>
    <script src="<?php echo base_url().JS; ?>jquery.share.js"></script>
    <script src="<?php echo base_url().JS; ?>fancyBox/jquery.fancybox.pack.js"></script>
    <script src="<?php echo base_url().JS; ?>fancyBox/helpers/jquery.fancybox-buttons.js"></script>
    <script src="<?php echo base_url().JS; ?>fancyBox/helpers/jquery.fancybox-media.js"></script>
    <script src="<?php echo base_url().JS; ?>api/web.js"></script>
    <script src="<?php echo base_url().JS; ?>api/rooms.js"></script>
    <script type="text/javascript">
        controller = '../ReservacionesController/allReserve';
    </script>
      
  </body>
</html>
