<?php 

include 'header.php';

 ?>
<style type="text/css">

  #DataTables_Table_0_length{
    display: none;
  }
  #DataTables_Table_0_filter{
    display: none;
  }
  #DataTables_Table_0_info{
    display: none;
  }
  .sorting{
    background: none;
  }
</style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  



         

<div class="container">

       <?php if ($error=$this->session->flashdata('Ride_Edit')) {?>

      <div class="row">

        <div class="col-lg-6">

          <div class="alert alert-Success">

            <?php echo $error;?>

          </div>

        </div>

      </div>

  <?php  } ?>

      <?php if ($error=$this->session->flashdata('del_msg')) {?>

      <div class="row">

        <div class="col-lg-6">

          <div class="alert alert-danger">

            <?php echo $error;?>

          </div>

        </div>

      </div>

  <?php  } ?>
<!-- <h3>All Rides Data</h3> -->
    <table class="table">

  <thead style="background-color: cornflowerblue;">

    <tr>

      <th scope="col">#</th>

      <th style="background: none;" scope="col">Date </th>

      <th style="background: none;" scope="col">From</th>

      <th style="background: none;" scope="col">To</th>

      <th style="background: none;" scope="col">Taxi</th>
      <?php if ($this->session->userdata('admin')=='0'){?>
      <th  style="background: none;" scope="col">Edit</th>
      <?php }?>
    </tr>
  </thead>
  <tbody>

   <?php 
    $i=1;

   foreach ($ride as $key) {?>

<tr style="border-top: 1px solid #dee2e6;">
  <td><?php echo $i; ?></td>
  <td><strong>
    <?php 
      $new_date_format = date('d/m ', strtotime($key->date));
      echo $new_date_format; ?></strong><br>

    <?php 
      $new_date_format = date('H:i', strtotime($key->time));
      echo $new_date_format; 
    ?>
  </td>

  <td>
    <?php   
      $CI =& get_instance();
      $data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row();
      echo $data->hotel_name;
    ?>
  </td>
  <td> 
    <?php   
      $CI =& get_instance();
      $data = $CI->db->select('destiny')->where('id',$key->dest_id)->get('destination')->row();
      echo $data->destiny;
    ?>
  </td>

 <?php if ($this->session->userdata('admin')=='1'){

     $CI =& get_instance();
$id=$this->session->userdata('id');
$data = $CI->db->select('cate_id')->where('user_id',$id)->get('manager')->row();

if($data){
  $data = $CI->db->select('hotel_id')->where('cate_id',$data->cate_id)->get('category_by_hotel')->result();
    foreach ($data as $ass ) {
  
        if ($ass->hotel_id==$key->hotel_id){?>
        <td>
          <?php
      $data = $CI->db->select('drive_name')->where('id',$key->driver_id)->get('driver')->row();

      echo $data->drive_name;?> </td>
      <td><a href="<?php echo base_url();?>Main/edit_appoitment/<?php echo $key->id;?>">Edit</a></td>
      <?php   
      }

      } 
      
    } 
 } 
 ?>


<?php if ($this->session->userdata('admin')=='0'){?>

 <td>  <?php
     $CI =& get_instance();
  
$data = $CI->db->select('drive_name')->where('id',$key->driver_id)->get('driver')->row();

echo $data->drive_name;?> </td>
 <td><a href="<?php echo base_url();?>Main/edit_appoitment/<?php echo $key->id;?>">Edit</a></td>
  
<?php } ?>
    







 

</tr>





   <?php $i++; } ?>

  </tbody>

</table>

 <p><?php echo $links; ?></p>
<?php 

  $date= date('Y-m-d');
  $time=date('h:i:sa');
$month = date('F', strtotime($date));


     $CI =& get_instance();
$data1 = $CI->db->select('*')->where('month',$month)->get('ride_booking')->num_rows();
$data2 = $CI->db->select('*')->where('date',$date)->get('ride_booking')->num_rows();





 ?>

<div class=" container" style="border: 2px solid;">
<?php echo $total_rows; ?> calls total (since May 20th, 2019)<br>
<?php echo $data1; ?> complete this Month <br>
<?php echo $data2; ?> completed today
  
</div>
<div class="pb-5"></div>
</div>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
  <script type="text/javascript">

        $('.alert').delay(1000).fadeOut('slow');

        $(document).ready( function () {

    $('.table').DataTable();
} );

    </script> -->