<?php



include'header.php';

 ?>



<div class="container">

 <div class=" pt-5">

	<h3>Edit Ride</h3>

</div>

<form method="post" action="<?php echo base_url('Main/edit_appointment_ride') ?>">

<input type="hidden" name="id" value="<?php echo $edit_data->id;?>">

	 <div class="form-group">

    <label for="exampleFormControlSelect1"><strong>♖ Hotel</strong></label>

    <select class="form-control" id="exampleFormControlSelect1" name="hotel_id">

    	<?php   



     $CI =& get_instance();



$data1 = $CI->db->select('*')->where('id',$edit_data->hotel_id)->get('hotel')->row();









 ?>

 <option value='<?php echo $data1->id; ?>' selected><?php echo $data1->hotel_name; ?></option>

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



     $CI =& get_instance();



$data2 = $CI->db->select('*')->where('id',$edit_data->dest_id)->get('destination')->row();









 ?>

    	<option value='<?php echo $data2->id; ?>' selected><?php echo $data2->destiny; ?></option>

         <?php 



foreach ($destiny as $key1) {



	?>



<option value="<?php echo $key1->id;?>"><?php echo $key1->destiny; ?></option>

<?php }

     ?>

    </select>

  </div>

    <div class="form-group">

    <label for="exampleFormControlSelect1"><strong>⚇ Driver Sort by ID</strong></label>

    <select class="form-control" id="exampleFormControlSelect1" name="driver_id">

    	  	<?php   



     $CI =& get_instance();



$data3 = $CI->db->select('*')->where('id',$edit_data->driver_id)->get('driver')->row();









 ?>

    	<option value='<?php echo $data3->id; ?>' selected><?php echo $data3->drive_name; ?></option>

    

         <?php 



foreach ($driver as $key2) {



	?>



<option value="<?php echo $key2->id;?>"><?php echo $key2->drive_name; ?></option>

<?php }

     ?>

    </select>

<div class=" pt-4">


</div>

<!-- <div class="form-group">

    <div class="form-check">

  <input class="form-check-input" name="ride_comp" type="checkbox" value="yes" id="flexCheckDefault" <?php if($edit_data->ride_complete=="yes") { ?> checked="checked" <?php } ?>>

  <label class="form-check-label" for="flexCheckDefault">

 <h5>  Tick means YES</h5>

  </label>

</div>

  </div> -->

 

   <button type="submit" class="btn btn-primary">Update Ride</button>

 

</form>

<a class="btn btn-primary" href="<?php echo base_url();?>Main/delete_appoitment/<?php echo  $edit_data->id;?>" onclick="alert('Are You Sure?')" >Delete</a>

</div>