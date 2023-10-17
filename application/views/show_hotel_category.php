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

<h3>Search Hotel In Category</h3>

<?php include 'submenu.php'; ?>

	

<form method="get" >

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
  <div class="form-group form-check">
<button type="submit" class="btn btn-primary">Serach </button>
  </div>
</form>

<div class="container pt-5">
  <?php 
  
  if (isset($_GET['cate_id']) && $_GET['cate_id']!='--') {

     foreach ($hcate as $key ) {
      if ($_GET['cate_id']==$key->cate_id) {
        
     
      




     $CI =& get_instance();



$data = $CI->db->select('*')->where('id',$key->hotel_id)->get('hotel')->row();?>
<?php $ca=$_GET['cate_id']; ?>
<h4><?php echo $data->hotel_name; ?> </h4><a href="<?php echo base_url();?>Main/catedelete_hotel/<?php echo $data->id;?>/<?php echo $ca;?>">Delete</a>

    <?php }  }
   } ?>
</div>