<!DOCTYPE html>
<html lang="en">
<head>
<title>Rides</title>

<meta name="google-site-verification" content="ijg98qtAbXEni7a5xAY2lpVXl8FaS4WyCL5RYPpowL8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Taxi Rides">
<meta name="keywords" content="booking taxi details">
<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<style type="text/css">
  
  @media (min-width: 768px) {
  .navbar-toggler {
      display:none
  }

  .collapse {
    display: contents;;
  }

  .floatRight{
    float: right !important;
  }

}


</style>

</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <a class="navbar-brand" style="width:100%" href="<?php echo base_url('Main') ?>"><span style="color: red; float: left;"><?php echo $this->session->userdata('user')?></span></a>

  <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>

  </button> -->



  <div class="collapse navbar-collapse show" id="navbarSupportedContent" style="width:100%">
    <ul class="navbar-nav mr-auto"></ul>

   
    <div class="menu form-inline my-2 my-lg-0 floatRight">
      <a href="<?php echo base_url('Main/new_ride') ?>" class="btn btn-danger">✆ New</a>&nbsp;
      <a href="<?php echo base_url('Main/scdule') ?>" class="btn btn-primary">✈</a>&nbsp;
      <a href="<?php echo base_url('Main/status') ?>" class="btn btn-warning">✇</a>&nbsp;

      <?php if ($this->session->userdata('admin')=='0'): ?>
        <a href="<?php echo base_url('Main/index22') ?>" class="btn btn-success">✚</a>&nbsp;
        <a href="<?php echo base_url('Main/status_details') ?>" class="btn btn-success">Status</a>&nbsp;
        <a href="<?php echo base_url('Main/db_page_show')?>" class="btn btn-secondary">❖</a>&nbsp;
      <?php endif ?>

        <a href="<?php echo base_url('Main/drivers_comision_page') ?>" class="btn btn-primary">📁</a>&nbsp;
        <a href="<?php echo base_url('Main/hotel_comision_page') ?>" class="btn btn-warning">📁</a>&nbsp;
        <a href="<?php echo base_url('Login/logout') ?>" class="btn btn-secondary"><i class="fa fa-sign-out" style="font-size:26px"></i></a>&nbsp;

      <?php
        if ($this->session->userdata('super_admin')==1){ 
          $sa = $this->session->userdata('admin');
          ?>
            <a href="<?php echo base_url('Main/superAdmin')?>" id="changeAdmin" class="btn btn-danger"><?= $sa == 0 ? 'Admin' : 'User' ?></a>&nbsp;
          <?php 
        } 
      ?>
    </div>
  </div>

</nav>
