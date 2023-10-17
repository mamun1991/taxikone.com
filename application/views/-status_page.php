
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
.dropdown-menu{
    width: 295%;
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
<?php if ($this->session->userdata('admin')=='1'){ ?>
    <?php  
 $id=$this->session->userdata('id');
 $CI =& get_instance();
$data = $CI->db->select('cate_id')->where('user_id',$id)->get('manager')->row();

 $data = $CI->db->select('hotel_id')->where('cate_id',$data->cate_id)->get('category_by_hotel')->result();
  // echo $this->db->last_query();exit;
 ?>
 	<td>

 		<select name="hotel[]"  multiple="multiple"  class="row_position" >

<!--  <option>-</option> -->

      <?php 

    
       foreach ($data  as $key) {?>

    <option value="<?php echo $key->hotel_id; ?>"><?php $data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row(); 
echo $data->hotel_name;
?></option>

     <?php } ?>

 		

 	</select>

 	</td>
 <?php } ?>
 <?php if ($this->session->userdata('admin')=='0'){ ?>
    <td>

        <select name="hotel[]"  multiple="multiple"  class="row_position" >

<!--  <option>-</option> -->

<?php
          foreach($hotel_group_list as $hgl => $val){
            // print_r($val);
            // echo $hgl.'<br><br>';
            echo '<option class="customOption" disabled>'.$hgl.'</option>';
            if($val){
              foreach($val as $ll){
                echo '<option class="'.$hgl.'" value="'.$ll->id.'">'.$ll->hotel_name.'</option>';
              // echo $ll->hotel_name.'<br>';
            }
            }
          }

        ?>


        

    </select>

    </td>
 <?php } ?>

 	<td>

 		<select name="driver">

      <option>-</option>

 	 <?php foreach ($driver as $key) {?> <option value="<?php echo $key->id; ?>"><?php echo $key->drive_name; ?></option> <?php } ?>

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

   foreach ($ride as $key) { ?>


   <?php if ($fhotel=='NULL' && $fdriver=='-' && $key->date>=$fdate && $key->date<=$Edate){ 


if (empty($key->comision)) {
   $color="red";
}else{
  $color='#738285';
}
    ?>

     

  

<tr >

   <td style="color:<?php echo $color;?>;"> <?php echo $i; ?></td>

  <td style="color:<?php echo $color;?>;">
    
    <strong><?php 
$new_date_format = date('m.d ', strtotime($key->date));
  echo $new_date_format; ?></strong><br>

  <?php 
$new_date_format = date('h:i', strtotime($key->time));
  echo $key->time; ?>
   



  </td>

  <td style="color:<?php echo $color;?>;">

    <?php   



     $CI =& get_instance();



$data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row();



echo $data->hotel_name;

// echo $key->comision;

 ?>

  </td>

    <td style="color:<?php echo $color;?>;"> <?php   



     $CI =& get_instance();



$data = $CI->db->select('destiny')->where('id',$key->dest_id)->get('destination')->row();



echo $data->destiny;



 ?></td>



 <td style="color:<?php echo $color;?>;">

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
 
    if ($key->hotel_id==$key2 &&  $key->driver_id==$fdriver && $key->date>=$fdate && $key->date<=$Edate){ 

     

if (empty($key->comision)) {
   $color="red";
}else{
  $color="#738285";
}
    ?>

     

  

<tr >
   <td style="color:<?php echo $color;?>;"><?php echo $i; ?></td>

  <td style="color:<?php echo $color;?>;"> <?php echo $key->created_at; ?></td>

  <td style="color:<?php echo $color;?>;">

    <?php   



     $CI =& get_instance();



$data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row();



echo $data->hotel_name;



 ?>

  </td>

    <td style="color:<?php echo $color;?>;"> <?php   



     $CI =& get_instance();



$data = $CI->db->select('destiny')->where('id',$key->dest_id)->get('destination')->row();



echo $data->destiny;



 ?></td>



 <td style="color:<?php echo $color;?>;">

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
   if ($fhotel=='NULL' &&  $key->driver_id==$fdriver && $key->date>=$fdate && $key->date<=$Edate){

    if (empty($key->comision)) {
   $color="red";
}else{
  $color="#738285";
}
    ?>

     

  

<tr >

   <td style="color:<?php echo $color;?>;"><?php echo $i; ?></td>

  <td style="color:<?php echo $color;?>;"><?php echo $key->created_at; ?></td>

  <td style="color:<?php echo $color;?>;">

    <?php   



     $CI =& get_instance();



$data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row();



echo $data->hotel_name;



 ?>

  </td>

    <td style="color:<?php echo $color;?>;"> <?php   



     $CI =& get_instance();



$data = $CI->db->select('destiny')->where('id',$key->dest_id)->get('destination')->row();



echo $data->destiny;



 ?></td>



 <td style="color:<?php echo $color;?>;">

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
 

  foreach ($fhotel as $key2) {
      // var_dump($key2);

   if ($key->hotel_id==$key2 &&  $fdriver=='-' && $key->date>=$fdate && $key->date<=$Edate){

    if (empty($key->comision)) {
   $color="red";
}else{
  $color="#738285";
}
    ?>

     

  

<tr >

   <td style="color:<?php echo $color;?>;"><?php echo $i; ?></td>

  <td style="color:<?php echo $color;?>;"><?php echo $key->date; ?>  <?php echo $key->time; ?></td>

  <td style="color:<?php echo $color;?>;">

    <?php   



     $CI =& get_instance();



$data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row();



echo $data->hotel_name;



 ?>

  </td>

    <td style="color:<?php echo $color;?>;"> <?php   



     $CI =& get_instance();



$data = $CI->db->select('destiny')->where('id',$key->dest_id)->get('destination')->row();



echo $data->destiny;



 ?></td>



 <td style="color:<?php echo $color;?>;">

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

    $(document).ready(function(){
      $('.customOption').find('label').css('color','red');
      $('.customOption').find('label').css('font-size','22px');
    });

    $(document).find('.customOption').on('click',function(){

      var val = $(this).find('label').attr('title');

      $(document).find('.'+val).find('input').attr('checked', 'checked');




      console.log('clicked'+val);
    });


</script>