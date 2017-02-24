
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <title>Fortaleza Suites</title>
    <link href='http://fonts.googleapis.com/css?family=Gilda+Display' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>foundation.min.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>jquery.share.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>common.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>home.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/reservas/css/plugins/colorbox/colorbox.css"/>
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/reservas/css/sales/reserve.css"/>
    <script src="<?php echo base_url().JS; ?>vendor/modernizr.js"></script>
  </head>
  <body>
    
    <div id="container">
        <div id="bg">
            <img class="back" src="<?php echo base_url().IMG; ?>web/home/01.jpg" alt="">
            
        </div>
        
         <?php $this->load->view('vwMenu'); ?>

        <div class="booking">
            <div id="book1">
                THESE ARE FULLY FURNISHED<br/>
                COLONIAL STYLE HIGH CEILINGS
            </div>
            <div id="book2"></div>
            <div id="book3">
                <p class="p1"><span id="noBg">1</span> / 4<p/>
                <p class="p2">FORTALEZA SUITES<p/>
            </div>
        </div>
            
      
    </div>

    <div id="footer">COPYRIGHT &#169; FORTALEZA SUITES PUERTO RICO</div>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/jquery/jquery-1.6.js"></script> 				
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/colorbox/jquery.colorbox.js"></script> 				
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/modal/jquery.modal.js"></script> 				
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/blockui/jquery.blockUI.js"></script>
    <script src="<?php echo base_url().JS; ?>foundation.min.js"></script>
    <script src="<?php echo base_url().JS; ?>jquery.share.js"></script>
    <script src="<?php echo base_url().JS; ?>api/web.js"></script>
  </body>
</html>

<script type="text/javascript">
    var NO_BG = 1;    
    
    function changeBg(){
        if (NO_BG == 4){
                NO_BG = 1;
        }else{
            NO_BG++;  
        }
        // Fade effect
        $(".back").fadeTo(1000,0.30, function() {
            $("#noBg").html(NO_BG);
            $(".back").attr("src", "<?php echo base_url().IMG; ?>web/home/0" + NO_BG + ".jpg");
            setTimeout(changeBg, 7000);
        }).fadeTo(500,1);
        // Repeat
    }
    
    $(function() {

        setTimeout(changeBg, 5000);

    });
    
    

</script>
