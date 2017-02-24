
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8">
    <title>Fortaleza Suites</title>
    <link href='http://fonts.googleapis.com/css?family=Gilda+Display' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>foundation.min.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>jquery.share.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>messi.min.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>common.css" />
    <link rel="stylesheet" href="<?php echo base_url().CSS; ?>contacto.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/reservas/css/plugins/colorbox/colorbox.css"/>
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/reservas/css/sales/reserve.css"/>
    <script src="<?php echo base_url().JS; ?>vendor/modernizr.js"></script>
  </head>
  <body onload="initialize()">
      
    <?php $this->load->view('vwMenu'); ?>
      
    <div id="map" class="map"></div>

    <div class="footer">
        
        <div class="contacto">
            <div class="content">
                <div class="contactoL">
                    <p class="title">CONTACT US</p>
                    <p>315 CALLE FORTALEZA<br/>
                    SAN JUAN, SAN JUAN 00901<br/>
                    PUERTO RICO</p>
                    
                    <p> <a href="mailto:fortalezasuites@hotmail.com">FORTALEZASUITES@HOTMAIL.COM</a><br/>
                        787 587 6418</a>
                    </p>    

                    <p>CHECK-IN: 3 PM, CHECK-OUT: 12 PM</p>
                    
                    <p id="social">
                        <a target="_blank" href="https://twitter.com/FortalezaSuite" ><img src="<?php echo base_url().IMG; ?>web/social3.png" /></a>
                        <a target="_blank" href="https://www.facebook.com/pages/Fortaleza-Suites/753375611351771" ><img src="<?php echo base_url().IMG; ?>web/social4.png" /></a>
                        <a target="_blank" href="http://www.tripadvisor.com.mx/VacationRentalReview-g1086394-d6626859-Fortaleza_Suites_at_Old_San_Juan_Unit_5-Jayuya_Puerto_Rico.html" ><img src="<?php echo base_url().IMG; ?>web/social2.png" /></a>
                        <a target="_blank" href="http://www.hoteles.com/hotel/details.html?pa=1&pn=1&ps=1&tab=description&destinationId=1057112&searchDestination=San+Juan&hotelId=457936&rooms[0].numberOfAdults=2&roomno=1&validate=false&previousDateful=false&reviewOrder=date_newest_first" ><img src="<?php echo base_url().IMG; ?>web/social1.png" /></a>
                    </p>
                </div>
                <div class="contactoR">
                    <input type="text" id="txtNombre" />
                    <input type="text" id="txtTelefono" />
                    <input type="text" id="txtEmail" />
                    <textarea id="txtMsg" ></textarea>
                    <a id="btnSend" href="#" class="button radius">SENT</a>
                </div>
            </div>
        </div> 
        
        <div class="foot">
            COPYRIGHT &#169; FORTALEZA SUITES PUERTO RICO
        </div>

    </div>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/jquery/jquery-1.6.js"></script> 				
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/colorbox/jquery.colorbox.js"></script> 				
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/modal/jquery.modal.js"></script> 				
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/reservas/js/plugins/blockui/jquery.blockUI.js"></script>
    <script src="<?php echo base_url().JS; ?>foundation.min.js"></script>
    <script src="<?php echo base_url().JS; ?>jquery.share.js"></script>
<script src="<?php echo base_url().JS; ?>messi.min.js"></script>
    <script src="<?php echo base_url().JS; ?>api/web.js"></script>
<script src="<?php echo base_url().JS; ?>api/contacto.js"></script>
  </body>
</html>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA01vZmL-1IdxCCJevyBdZSEYJ04Wu2EWE&sensor=false"></script>
<script type="text/javascript">
  function initialize() {
    var myLatlng = new google.maps.LatLng(18.465569,-66.113328);
    var mapOptions = {
      center: myLatlng,
      zoom: 17,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map"),
        mapOptions);
    var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      animation: google.maps.Animation.DROP,
      title: 'Fortaleza Suites'
    });
  }
</script>
