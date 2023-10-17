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
  <?php include 'submenu.php'; ?>

<h3>Add Hotel In Category</h3>



	

<form method="post" action="<?php echo base_url('Main/add_hotel_by_cate') ?>">

   <div class="form-group">

    <label for="exampleFormControlSelect1"><strong>♖ Category</strong></label>

    <select class="form-control" id="exampleFormControlSelect1" name="cate_id">
<option>--</option>
    <?php 



foreach ($cate as $key) {


  ?>



<option value="<?php echo $key->id;?>"><?php echo $key->category_name; ?></option>

<?php }

     ?>

    </select>

  </div>



  




<div class="container pt-5">
  <h5>Hotel's</h5>
<?php 

$CI =& get_instance();
$data = $CI->db->query("SELECT hotel_name,id 
FROM hotel 
WHERE NOT EXISTS 
    (SELECT * 
     FROM category_by_hotel 
     WHERE category_by_hotel.hotel_id = hotel.id)")->result();


 ?>
  <?php foreach ($data  as $key) {?>
    
   

  <input type="checkbox" name="hotel_id[]" value="<?php echo $key->id ?>">
  <label><?php echo $key->hotel_name; ?></label><br>
   <?php } ?>
</div>
<div class="form-group form-check">
<button type="submit" class="btn btn-primary">Add </button>
  </div>


</form>
</div>
