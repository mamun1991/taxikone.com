<?php 

include 'header.php';
 ?>
 <div class="container pt-5">
 	
 	<form method="post" action="<?php echo base_url('Main/edit_destiny_data') ?>">
  <div class="form-group">
    <label for="exampleInputEmail1"><strong>Edit Driver</strong></label>
    <input type="text" class="form-control" name="destiny" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter driver Name"  value="<?php echo $destiny->destiny; ?>">
   <input type="hidden" name="id" value="<?php echo $destiny->id; ?>">
  </div>
<div class="form-group form-check">
  </div>
  <button type="submit" class="btn btn-primary">Update Hotel</button>
</form>
 </div>