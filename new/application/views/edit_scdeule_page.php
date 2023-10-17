<?php include'header.php'; ?>



<div class="container pt-5">



<div class=" ">

	<h3>New Appoinment</h3>

</div>

<form method="post" action="<?php echo base_url('Main/save_edit_scdeule_data') ?>">

  <div class="form-group">

<input type="hidden" name="id" value="<?php echo $edit_data->id;?>">

    <label for="exampleInputEmail1"><strong>❂ Date & Time</strong></label>

    <input type="datetime-local" class="form-control" name="date" value="<?php if (isset($edit_data->date)){

        echo $edit_data->date;

    } ?>">

   

  </div>

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



$data2 = $CI->db->select('*')->where('id',$edit_data->destiny_id)->get('destination')->row();









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

<div class="form-check">

  <input class="form-check-input" type="radio" name="type" value="Simple" id="flexRadioDefault1"  <?php if($edit_data->type=="Simple") { ?> checked="checked" <?php } ?>>

  <label class="form-check-label" for="flexRadioDefault1">

    Simple

  </label>

</div>

<div class="form-check pb-5">

  <input class="form-check-input" type="radio" name="type"  value="Flight" id="flexRadioDefault2" <?php if($edit_data->type=="Flight") { ?> checked="checked" <?php } ?>>

  <label class="form-check-label" for="flexRadioDefault2">

   Flight

  </label><br>

  <input style="display:none;" type="text" name="details" id="otherAnswer" />

</div>



 

   <button type="submit" class="btn btn-primary ">Save data</button>

 

</form>
<form method="post" action="<?php echo base_url('Main/delete_scd_ride') ?>">
    <input type="hidden" value="<?php echo $edit_data->id;?>" name="id">
    <button class="btn btn-danger">delete</button>
</form>



</div>

<script type="text/javascript">

	

 $(document).ready(function() {

            $("input[type='radio']").change(function() {

                if ($(this).val() == "Flight") {

                    $("#otherAnswer").show();

                } else {

                    $("#otherAnswer").hide();

                }

            });

        });

</script>