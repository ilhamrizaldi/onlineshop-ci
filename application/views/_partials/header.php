<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shop Homepage - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url('assets/css/shop-homepage.css') ?>" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
   <!-- SweetALert -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
  <style>
      .judul {
        display: block;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        margin: 0;
        max-height: 38px;
        font-size: 14px;
        font-weight: 600;
        line-height: 19px;
        overflow: hidden;
        color: #4c4c4c;
        word-wrap: break-word;
     }
     .brand {
      display: block;
      width: 100%;
      font-size: 12px;
      height: 20px;
      color: #9e9e9e;
      margin-top: 0;
      text-overflow: ellipsis;
      overflow: hidden;
      transition: margin 0.3s;
    }
    .dropdown {
    position: relative;
    display: inline-block;
  }

.dropdown .dropdown-menu {
    position: absolute;
    top: 100%;
    display: none;
    margin: 0;

    /****************
     ** NEW STYLES **
     ****************/

}

.dropdown:hover .dropdown-menu {
    display: block; 
}

/** Button Styles **/
.dropdown cat {
    margin: 0;
    padding: 0.4em 0.8em;
    color: #fff;
    font-family: arial;
    font-size: 16px;
}

/** List Item Styles **/
.dropdown a {
    display: block;
    padding: 0.2em 0.8em;
    text-decoration: none;
    background: #FFFF;
    color: #333333;
}

/** List Item Hover Styles **/
.dropdown a:hover {
    background: #BBBBBB;
}
.img-slide {
    position: relative;
    display: inline-block;
    height: 100%;
    width: 100%;
    -ms-transform-origin: center;
        transform-origin: center;
    border-radius: 12px;
    -ms-transform: scale(0.9);
        transform: scale(0.9);
    transition: transform 0.2s;

    /* transition-delay: 400ms; */
}
     
  </style>

</head>
