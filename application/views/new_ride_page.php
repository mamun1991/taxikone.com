<?php 



include'header.php';

 ?>



<div class="container">

 <div class=" pt-5">

	<h3>New Ride</h3>

</div>

<form method="post" action="<?php echo base_url('Main/add_ride') ?>">

 <?php if ($this->session->userdata('admin')=='0'){ ?>

	 <div class="form-group">

    <label for="exampleFormControlSelect1"><strong> Hotel</strong></label>

    <select class="form-control" id="exampleFormControlSelect1" name="hotel_id">

    <?php 
      foreach ($hotel as $key) { ?>
        <option value="<?php echo $key->id;?>"><?php echo $key->hotel_name; ?></option>

    <?php } ?>

    </select>

  </div>
<?php } ?>
 <?php if ($this->session->userdata('admin')=='1'){ ?>

      <div class="form-group">

    <label for="exampleFormControlSelect1"><strong> Hotel</strong></label>

    <select class="form-control" id="exampleFormControlSelect1" name="hotel_id">
        <?php  
    $id=$this->session->userdata('id');
    $CI =& get_instance();
    $data = $CI->db->select('cate_id')->where('user_id',$id)->get('manager')->row();
    $data = $CI->db->select('hotel_id')->where('cate_id',$data->cate_id)->get('category_by_hotel')->result();
     
    foreach ($data as $key) { ?>
    <option value="<?php echo $key->hotel_id; ?>"><?php $data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row(); 
    echo $data->hotel_name;
    ?></option>
    <?php  } ?>
    </select>

      </div>
    <?php } ?>

   <div class="form-group">

    <label for="exampleFormControlSelect1"><strong> Destination</strong></label>

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

    <label for="exampleFormControlSelect1"><strong> Driver </strong></label>

    <select class="form-control" id="exampleFormControlSelect1" name="driver_id">

         <?php 



foreach ($driver as $key2) {



	?>



<option value="<?php echo $key2->id;?>"><?php echo $key2->drive_name; ?></option>

<?php }

     ?>

    </select>

  </div>

 

   <button type="submit" class="btn btn-primary">Save Ride</button>

 

</form>



</div>