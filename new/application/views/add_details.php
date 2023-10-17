<?php include 'header.php'; ?>





<div class="container pt-5">

    <?php if ($error=$this->session->flashdata('msg1')) {?>

      <div class="row">

        <div class="col-lg-6">

          <div class="alert alert-Success">

            <?php echo $error;?>

          </div>

        </div>

      </div>

  <?php  } ?>



    <?php if ($error=$this->session->flashdata('msg')) {?>

      <div class="row">

        <div class="col-lg-6">

          <div class="alert alert-danger">

            <?php echo $error;?>

          </div>

        </div>

      </div>

  <?php  } ?>

</div>

<div class="container pt-5">





	

<form method="post" action="<?php echo base_url('Main/add_hotel') ?>">

  <div class="form-group">

    <label for="exampleInputEmail1"><strong>New Hotel</strong></label>

    <input type="text" class="form-control" name="hotel" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Hotel Name">

   

  </div>

<div class="form-group form-check">

  </div>

  <button type="submit" class="btn btn-primary">Add Hotel</button>

</form>



</div>



<div class="container pt-5">

	

<form method="post" action="<?php echo base_url('Main/add_destiny') ?>">



  <div class="form-group">

    <label for="exampleInputEmail1"><strong>New Destination</strong></label>

    <input type="text" class="form-control" name="destiny" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter New Destination">

   

  </div>

<div class="form-group form-check">

  </div>

  <button type="submit" class="btn btn-primary">Add Destination</button>

</form>



</div>

<div class="container pt-5">

	

<form method="post" action="<?php echo base_url('Main/add_driver') ?>">



  <div class="form-group">

    <label for="exampleInputEmail1"><strong>New Driver</strong></label>

    <input type="text" class="form-control" name="driver" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter driver">

   

  </div>

<div class="form-group form-check">

  </div>

  <button type="submit" class="btn btn-primary">Add Driver</button>

</form>

<div class=" pt-5">

	<h3>New Commission</h3>

</div>

<form method="post" action="<?php echo base_url('Main/add_rate') ?>">



	 <div class="form-group">

    <label for="exampleFormControlSelect1"><strong>♖ Hotel</strong></label>

    <select class="form-control" id="exampleFormControlSelect1" name="hotel_id">

    <?php 



foreach ($hotel as $key) {



	?>



<option value="<?php echo $key->id;?>"><?php echo $key->hotel_name; ?></option>

<?php }

     ?>

    </select>

  </div>

   <div class="form-group">

    <label for="exampleFormControlSelect1"><strong>⚐ Destination</strong></label>

    <select class="form-control" id="exampleFormControlSelect1" name="destiny_id">

         <?php 



foreach ($destiny as $key1) {



	?>



<option value="<?php echo $key1->id;?>"><?php echo $key1->destiny; ?></option>

<?php }

     ?>

    </select>

  </div>

  <div class="form-group">

    <label for="exampleFormControlInput1"><strong>€ Commission (in cents)</strong></label>

    <input type="text" class="form-control" name="rate" id="exampleFormControlInput1" placeholder="Set Rate">

  </div>

 

   <button type="submit" class="btn btn-primary">Set Commission</button>

 

</form>



</div>



<!-- 

<div class="container pt-5">

	<h3>New Payment</h3>

</div>

<div class="container">

  <h5>You can only select a hotel or a driver, not both.</h5>

</div>

<div class="container">

<form method="post" action="<?php echo base_url('Main/add_payment') ?>">



	 <div class="form-group">

    <label for="exampleFormControlSelect1"><strong>♖ Hotel</strong></label>

    <select class="form-control" id="exampleFormControlSelect1" name="hotel_id">

       <option>-</option>

    <?php 



foreach ($hotel as $key) {



	?>



<option value="<?php echo $key->id;?>"><?php echo $key->hotel_name; ?></option>

<?php }

     ?>

    </select>

  </div>

   <div class="form-group">

    <label for="exampleFormControlSelect1"><strong>Driver</strong></label>

    <select class="form-control" id="exampleFormControlSelect1" name="driver_id">

      <option>-</option>

         <?php 



foreach ($driver as $key2) {



	?>



<option value="<?php echo $key2->id;?>"><?php echo $key2->drive_name; ?></option>

<?php }

     ?>

    </select>

  </div>

  <div class="form-group">

    <label for="exampleFormControlInput1"><strong>Month's</strong></label>

   <div class="form-check">

  <input class="form-check-input" name="apr" type="checkbox" value="4" id="flexCheckDefault">

  <label class="form-check-label" for="flexCheckDefault">

    Apr

  </label>

</div>

<div class="form-check">

  <input class="form-check-input" name="may" type="checkbox" value="5" id="flexCheckChecked" >

  <label class="form-check-label" for="flexCheckChecked">

   May

  </label>

</div>

<div class="form-check">

  <input class="form-check-input" name="jun" type="checkbox" value="6" id="flexCheckChecked" >

  <label class="form-check-label" for="flexCheckChecked">

    Jun

  </label>

</div>

<div class="form-check">

  <input class="form-check-input" name="jul" type="checkbox" value="7" id="flexCheckChecked" >

  <label class="form-check-label" for="flexCheckChecked">

   Jul

  </label>

</div>

<div class="form-check">

  <input class="form-check-input" name="aug" type="checkbox" value="8" id="flexCheckChecked" >

  <label class="form-check-label" for="flexCheckChecked">

    Aug

  </label>

</div>

<div class="form-check">

  <input class="form-check-input" name="sep" type="checkbox" value="9" id="flexCheckChecked" >

  <label class="form-check-label" for="flexCheckChecked">

  Sep

  </label>

</div>

  </div>

 

   <button type="submit" class="btn btn-primary">Add Payment</button>

 

</form>



</div> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script type="text/javascript">

        $('.alert').delay(1000).fadeOut('slow');

    </script>

