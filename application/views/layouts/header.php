<!doctype html>
  <html lang="en">

  <head>
    <title>Streetmap Editor</title>
    <link rel="shortcut icon" type="<?=base_url();?>image/png" href="images/favicon.jpg" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?=base_url();?>vendor_components/w3_school/css/w3.css">
    <link href="<?=base_url();?>vendor_components/mapbox/css/mapbox-gl.css" rel="stylesheet">
    <!-- <link href="<?=base_url();?>css/googleapis/googleapis.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?=base_url();?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url();?>css/style.css">
    <link rel="stylesheet" href="<?=base_url();?>css/mapstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya&display=swap" rel="stylesheet">
  </head>
  <style>
    .parentDiv {
      position: absolute;
      width: 100%;
      background-color: black;
      color: white;
    }

    .nav {
      text-align: center;
    }
  </style>

  <style>
    .legend {
      background-color: #fff;
      border-radius: 3px;
      bottom: 30px;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
      font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
      padding: 10px;
      position: absolute;
      right: 10px;
      z-index: 1;
    }

    .legend h4 {
      margin: 0 0 10px;
    }

    .legend div span {
      border-radius: 50%;
      display: inline-block;
      height: 10px;
      margin-right: 5px;
      width: 10px;
    }
    /* #map { position: absolute; top: 0; bottom: 0; width: 100%; } */

  </style>

  <body>

  <div class="p-2 announcment_bar">
      <span class="m-0 p-0 announcment_text">Singles Day Sale 🤍 Buy a print + frame and get 15% OFF. This week only!</span>
      <!-- <br>
    <span class="m-0 p-0" style="color:white;font-size:10px;">Not valid for the new Nursery Collection</span> -->
    </div>
    <div class="navbar navbar-expand-lg navbar-light bg-light" style="text-align: center;">
      <!-- <div class="container"> -->
      <div align="center">
        <span class="navbar-brand m-0 p-0" href="#" style="font-family: 'Brush Script MT', cursive !important;"><img
            class="image_style" src="images/logo.png" height="30px" width="50px" /><strong>Map
            Editor</strong></span>
      </div>
    </div>

    <!-- // body content here -->