
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<style type="text/css">


  .multiselect-selected-text {
  font-size: 0;
}
.multiselect-selected-text:after {
  font-size: 1rem;
  content: 'Select all';
}
</style>
<?php 

include 'header.php'; ?>





<?php 



if (isset($_GET['indate']) && isset($_GET['outdate'])) {





$fdate=$_GET['indate'];

$Edate=$_GET['outdate'];

if (isset($_GET['hotel'])) {
 $fhotel=$_GET['hotel'];
}else{
  $fhotel='NULL';
 // var_dump($fhotel);die;
}
$fdriver=$_GET['driver'];
}



 ?>



<div class="container pt-5">

	<form method="get" >

    <table class="table">

  <thead style="

    background-color: cornflowerblue;

">

    <tr>

     	<th>Hotel</th>

			<th>Driver</th>

			<th>Date Range</th>

			<th></th>

    </tr>

  </thead>

  <tbody>



 <tr>

 	<td>

 		<select name="hotel[]"  multiple="multiple"  class="row_position" >

<!--  <option>-</option> -->

      <?php 

      

       foreach ($hotel as $key) {?>

    <option value="<?php echo $key->id; ?>"><?php echo $key->hotel_name; ?></option>

     <?php } ?>

 		

 	</select>

 	</td>

 	<td>

 		<select name="driver">

      <option>-</option>

 	 <?php 

      

       foreach ($driver as $key) {?>

    <option value="<?php echo $key->id; ?>"><?php echo $key->drive_name; ?></option>

     <?php } ?>

 	</select>

 </td>

 	<td>
        <?php 


$first_day = date('Y-m-01');


$newDate = date("Y-m-d");


         ?>

 		<input type="date" name="indate" class="form-control "  value="<?php echo $first_day;?>">

 		<input type="date" name="outdate" class="form-control" value="<?php echo $newDate;?>">

 	</td>

 	<td><button type="submit" class="btn btn-primary">Filter</button></td>

 </tr>



   



  </tbody>

</table>

</form>

</div>

<div class="container pt-5">

     

    <table class="table">

      <thead style="

    background-color: cornflowerblue;

">

    <tr>

      <th scope="col">#</th>

      <th scope="col">Date and Time</th>

      <th scope="col">From</th>

      <th scope="col">To</th>

      <th scope="col">Taxi</th>

     

    </tr>

  </thead>

  <tbody>



   <?php 

   if (isset($fdate) && isset($Edate)){

   

     

  

$i=1;
$z=0;

   foreach ($ride as $key) {?>


   <?php if ($fhotel=='NULL' && $fdriver=='-' && $key->date>=$fdate && $key->date<=$Edate){ ?>

     

  

<tr>

   <td><?php echo $i; ?></td>

  <td>
    
    <strong><?php 
$new_date_format = date('m.d ', strtotime($key->date));
  echo $new_date_format; ?></strong><br>

  <?php 
$new_date_format = date('h:i', strtotime($key->time));
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



$data = $CI->db->select('destiny')->where('id',$key->dest_id)->get('destination')->row();



echo $data->destiny;



 ?></td>



 <td>

     <?php   



     $CI =& get_instance();



$data = $CI->db->select('drive_name')->where('id',$key->driver_id)->get('driver')->row();



echo $data->drive_name;



 ?>

 </td>

 <!-- <td><a href="<?php echo base_url();?>Main/edit_appoitment/<?php echo $key->id;?>">Edit</a></td> -->

</tr>
  <?php   



     $CI =& get_instance();



$where = array('hotel_id' =>$key->hotel_id ,
'dest_id'=>$key->dest_id );

$data = $CI->db->select('rate')->where($where)->get('comision')->row();
// var_dump($data);
//$result = array_filter($data['rate']);                 
if (!empty($data)) {
     $z+=$data->rate;
}
 

//$z+=$data;



 ?>
 



   <?php $i++;  }
if ($fhotel !='NULL') {
  // code...

  foreach ($fhotel as $key2) {
      // code...
 
    if ($key->hotel_id==$key2 &&  $key->driver_id==$fdriver && $key->date>=$fdate && $key->date<=$Edate){ ?>

     

  

<tr>

   <td><?php echo $i; ?></td>

  <td><?php echo $key->created_at; ?></td>

  <td>

    <?php   



     $CI =& get_instance();



$data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row();



echo $data->hotel_name;



 ?>

  </td>

    <td> <?php   



     $CI =& get_instance();



$data = $CI->db->select('destiny')->where('id',$key->dest_id)->get('destination')->row();



echo $data->destiny;



 ?></td>



 <td>

     <?php   



     $CI =& get_instance();



$data = $CI->db->select('drive_name')->where('id',$key->driver_id)->get('driver')->row();



echo $data->drive_name;



 ?>

 </td>

 <!-- <td><a href="<?php echo base_url();?>Main/edit_appoitment/<?php echo $key->id;?>">Edit</a></td> -->

</tr>
  <?php   



     $CI =& get_instance();



$where = array('hotel_id' =>$key->hotel_id ,
'dest_id'=>$key->dest_id );

$data = $CI->db->select('rate')->where($where)->get('comision')->row();
//$result = array_filter($data['rate']);                 
if (!empty($data)) {
     $z+=$data->rate;
}
 

//$z+=$data;



 ?>
 



   <?php $i++;  }
 }
 }
   if ($fhotel=='NULL' &&  $key->driver_id==$fdriver && $key->date>=$fdate && $key->date<=$Edate){ ?>

     

  

<tr>

   <td><?php echo $i; ?></td>

  <td><?php echo $key->created_at; ?></td>

  <td>

    <?php   



     $CI =& get_instance();



$data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row();



echo $data->hotel_name;



 ?>

  </td>

    <td> <?php   



     $CI =& get_instance();



$data = $CI->db->select('destiny')->where('id',$key->dest_id)->get('destination')->row();



echo $data->destiny;



 ?></td>



 <td>

     <?php   



     $CI =& get_instance();



$data = $CI->db->select('drive_name')->where('id',$key->driver_id)->get('driver')->row();



echo $data->drive_name;



 ?>

 </td>

 <!-- <td><a href="<?php echo base_url();?>Main/edit_appoitment/<?php echo $key->id;?>">Edit</a></td> -->

</tr>
  <?php   



     $CI =& get_instance();



$where = array('hotel_id' =>$key->hotel_id ,
'dest_id'=>$key->dest_id );

$data = $CI->db->select('rate')->where($where)->get('comision')->row();
//$result = array_filter($data['rate']);                 
if (!empty($data)) {
     $z+=$data->rate;
}
 

//$z+=$data;



 ?>
 



   <?php $i++;  }
if ($fhotel !='NULL') {
  // code...

  foreach ($fhotel as $key2) {
      // code...

   if ($key->hotel_id==$key2 &&  $fdriver=='-' && $key->date>=$fdate && $key->date<=$Edate){ ?>

     

  

<tr>

   <td><?php echo $i; ?></td>

  <td><?php echo $key->created_at; ?></td>

  <td>

    <?php   



     $CI =& get_instance();



$data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row();



echo $data->hotel_name;



 ?>

  </td>

    <td> <?php   



     $CI =& get_instance();



$data = $CI->db->select('destiny')->where('id',$key->dest_id)->get('destination')->row();



echo $data->destiny;



 ?></td>



 <td>

     <?php   



     $CI =& get_instance();



$data = $CI->db->select('drive_name')->where('id',$key->driver_id)->get('driver')->row();



echo $data->drive_name;



 ?>

 </td>

 <!-- <td><a href="<?php echo base_url();?>Main/edit_appoitment/<?php echo $key->id;?>">Edit</a></td> -->

</tr>
  <?php   



     $CI =& get_instance();



$where = array('hotel_id' =>$key->hotel_id ,
'dest_id'=>$key->dest_id );

$data = $CI->db->select('rate')->where($where)->get('comision')->row();
//$result = array_filter($data['rate']);                 
if (!empty($data)) {
     $z+=$data->rate;
}
 

//$z+=$data;



 ?>
 



   <?php $i++;  }

 }
}


    } ?>









  </tbody>

</table>

<div>
    <span class="label btn-success">Commission: <?php echo '€'. $z; } ?></span>
</div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

<script type="text/javascript">
  $('select[multiple]').multiselect()
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
    $(".row_position").sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $(".row_position>tr").each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });

    function updateOrder(aData) {
      console.log(aData);
        $.ajax({
            url: 'ajaxPost.php',
            type: 'POST',
            data: {
                allData: aData
            },
            success: function() {
                alert("Your change successfully saved");
            }
        });
    }
</script>