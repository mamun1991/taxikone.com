<?php 

include 'header.php'; ?>

<div class="container pt-5">

	

  <a href="<?php echo base_url('Main/add_appionment') ?>"><button class="btn btn-danger">+ New Scdhule</button></a>

</div>

<div class="container pt-5">

    <?php if ($error=$this->session->flashdata('Appoint')) {?>

      <div class="row">

        <div class="col-lg-6">

          <div class="alert alert-Success">

            <?php echo $error;?>

          </div>

        </div>

      </div>

  <?php  } ?>

	<table class="table">

  <thead>

    <tr>

      <th scope="col">#</th>

      <th scope="col">Date and Time</th>

      <th scope="col">From</th>

      <th scope="col">To</th>

     
      <th scope="col">F.Number</th>

      <th scope="col">Mobile Phone</th>
       <th scope="col">Edit</th>

    </tr>

  </thead>

  <tbody>



   <?php 

$i=1;

   foreach ($appoint_data as $key) {?>



   

<tr>

   <td><?php echo $i; ?></td>

  <td>
    
    <?php 
$new_date_format = date('d/m H:i', strtotime($key->date));
  echo $new_date_format; ?>
  </td>

  <td>

    <?php   



     $CI =& get_instance();



$data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row();



echo $data->hotel_name;



 ?>

  </td>

    <td> <?php   



     $CI =& get_instance();



$data = $CI->db->select('destiny')->where('id',$key->destiny_id)->get('destination')->row();



echo $data->destiny;



 ?></td>

 
 <td><?php echo $key->flight_details; ?></td>
  <td><?php echo $key->number; ?></td>
<td><a href="<?php echo base_url();?>Main/edit_scdehule/<?php echo $key->id;?>">Edit</a></td>
</tr>





   <?php $i++; } ?>

  </tbody>

</table>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script type="text/javascript">

        $('.alert').delay(1000).fadeOut('slow');

    </script>