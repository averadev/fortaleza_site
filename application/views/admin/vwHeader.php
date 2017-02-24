<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo HTTP_CSS_PATH; ?>favicon.png">
    <title>BookMeIn</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo HTTP_JS_PATH; ?>html5shiv.js"></script>
      <script src="<?php echo HTTP_JS_PATH; ?>respond.min.js"></script>
    <![endif]-->
     <link href="<?php echo HTTP_CSS_PATH; ?>icons.css" rel="stylesheet">
     <link href="<?php echo HTTP_CSS_PATH; ?>jquery.bxslider.css" rel="stylesheet">
     <link href="<?php echo HTTP_CSS_PATH; ?>owl.carousel.css" rel="stylesheet">
     <link href="<?php echo HTTP_CSS_PATH; ?>datepicker.css" rel="stylesheet">
     <link href="<?php echo HTTP_CSS_PATH; ?>typeahead.css" rel="stylesheet">
     <link href="<?php echo HTTP_CSS_PATH; ?>admin.css" rel="stylesheet">
  </head>
<body>
    <?php
    $pg = isset($page) && $page != '' ?  $page :'dash'  ;    
    ?>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url().IMG; ?>app/logoM.png" /></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php echo  $pg =='reservacion' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/reservacion">Reservaciones</a></li>
            <li style="background-color: rgba(255, 255, 255, 0.21); width:2px; height:50px">&nbsp;</li>
            <li <?php echo  $pg =='habitacion' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/habitacion">Habitaciones</a></li>
            <li <?php echo  $pg =='temporada' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/temporada">Temporadas</a></li>
            <li <?php echo  $pg =='promocion' ? 'class="active"' : '' ?>><a href="<?php echo base_url(); ?>admin/promocion">Promociones</a></li>
          </ul>
          <ul class="nav navbar-nav logout">
            <li><a href="<?php echo base_url(); ?>admin/home/logout">Salir</a></li>
          </ul>
        </div>
      </div>
    </div>
