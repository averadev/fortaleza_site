
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
        
        <div id="bg">
          <img class="back" src="<?php echo base_url().IMG; ?>web/exterior/07.jpg" alt="">
        </div>

        <div id="text">
            <p class="title">INFORMATION</p>
            <hr/>
            <p>Our Condo is located in the Heart of Historic Old San Juan, approximately 10 min. for International Luis Munoz Airport. </p>
            <p>Steps from Capitol building that has a beach right in front with monument, by Taxi line up, 4 blooks from public transportation.</p>
            <p>Walking distance to pier where all Cruise Ships dock and sail out, from San Cristobal Castle and Fort el Morro. Minutes from the Cathedral, Plazas, supermarket, and City Hall. We are located next to the most renowned restaurants and cafe shops in the city.</p>
            
            
            <div id="bookNow"><center><img src="<?php echo base_url().IMG; ?>web/bookNow.jpg"></center></div>
            
        </div>
    
        <?php $this->load->view('vwMenu'); ?>
        
    </div>

    <div id="footer">COPYRIGHT &#169; FORTALEZA SUITES PUERTO RICO</div>
      

    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/jquery/jquery-1.6.js"></script> 				
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
      
  </body>
</html>
