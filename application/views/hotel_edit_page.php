<?php 

include 'header.php';
 ?>
 <div class="container pt-5">
 	
 	<form method="post" action="<?php echo base_url('Main/edit_hotel_data') ?>">
  <div class="form-group">
    <label for="exampleInputEmail1"><strong>Edit Driver</strong></label>
    <input type="text" class="form-control" name="hotel" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter driver Name"  value="<?php echo $hotel->hotel_name; ?>">
   <input type="hidden" name="id" value="<?php echo $hotel->id; ?>">
  </div>
<div class="form-group form-check">
  </div>
  <button type="submit" class="btn btn-primary">Update Hotel</button>
</form>
 </div>