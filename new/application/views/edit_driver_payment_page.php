<?php 

include 'header.php';
 ?>

 <div class="container pt-5">

 	<form method="post" action="<?php echo base_url('Main/update_diver_payemt_details') ?>">
 		<input type="hidden" name="id" value="<?php echo $driver->id ?>">
 			 <div class="form-group">
    <label for="exampleFormControlSelect1"><strong>♖ Driver</strong></label>

    <select class="form-control" id="exampleFormControlSelect1" name="driver_id">
          
    <?php 

foreach ($driver1 as $key) {
var_dump($key);
	?>

<option value="<?php echo $key->id;?>"><?php echo $key->drive_name; ?></option>
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
   <button type="submit" class="btn btn-primary">Update Payment</button>
 	</form>
 </div>