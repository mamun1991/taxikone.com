<?php include'header.php'; ?>
<div class="container">
<div class=" pt-5">
	<h3>Edit Commission</h3>
</div>
<form method="post" action="<?php echo base_url('Main/edit_comission_details') ?>">
<input type="hidden" name="id" value="<?php echo $comision->id;?>">
	 <div class="form-group">
    <label for="exampleFormControlSelect1"><strong>♖ Hotel</strong></label>
    <select class="form-control" id="exampleFormControlSelect1" name="hotel_id">
    	       <?php   

     $CI =& get_instance();

$data1 = $CI->db->select('*')->where('id',$comision->hotel_id)->get('hotel')->row();
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

$data2 = $CI->db->select('*')->where('id',$comision->dest_id)->get('destination')->row();




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
    <label for="exampleFormControlInput1"><strong>€ Commission (in cents)</strong></label>
    <input type="text" class="form-control" name="rate" id="exampleFormControlInput1" placeholder="Set Rate" value="<?php echo $comision->rate;?>">
  </div>
 
   <button type="submit" class="btn btn-primary">Set Commission</button>
 
</form>

</div>
