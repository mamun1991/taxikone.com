<?php 

include 'header.php';

?>
<?php

if (isset($_GET['indate'])) {





$date=$_GET['indate'];

$year12 = date('Y', strtotime($date));

$month12 = date('F', strtotime($date));

}else{
// $year12='0';
// $month12='0';
    // date_default_timezone_set("Asia/karachi");
   $date=date('Y-m-d');
    // var_dump($date);
    $year12 = date('Y', strtotime($date));

$month12 = date('F', strtotime($date));

}



 ?>




<div class="container pt-5">

  <form method="get" >

    <table class="table">

  <thead style="

    background-color: cornflowerblue;

">

    <tr>

   



      <th>Date Range</th>

      <th></th>
       <th></th>

    </tr>

  </thead>

  <tbody>



 <tr>


  <td>
        <?php 


// $first_day = date('Y-m-01');


// $newDate = date("Y-m-d");


         ?>

    <input type="month" name="indate" class="form-control "  value="july">

    

  </td>
<!--  <td>
       
  <select name="driver" class="form-control">
      <option>--</option>
    <?php foreach ($driver as $key): ?>

        <option value="<?php echo $key->id;?>"><?php echo $key->drive_name; ?></option>
        
    <?php endforeach ?>
     
  </select>

    

  </td> -->

<!--    <td>
       
  <select name="driver" class="form-control">
      <option>--</option>
    <?php foreach ($hotel as $key): ?>

        <option value="<?php echo $key->id;?>"><?php echo $key->hotel_name; ?></option>
        
    <?php endforeach ?>
     
  </select>

    

  </td> -->

  <td><button type="submit" class="btn btn-primary">Filter</button></td>

 </tr>



   



  </tbody>

</table>

</form>

</div>

        


<div class="container pt-5">

   

  <table class="table table-striped"><thead style="

    background-color: cornflowerblue;

">

    <tr>

      <th scope="col">Driver's</th>

      <th scope="col">Rides</th>

      <th scope="col">Commision</th>
<th></th>
<th></th>
    </tr>

  </thead>

  <tbody>
<?php
if (1==1) {

 $z=0;
 $totaol=0;
foreach ($driver as $key )  {?>

<?php 
if (isset($_GET['indate'])) {

   $in_date=$_GET['indate'];

 

$date = date('F', strtotime($in_date));
$where= array('driver_id' => $key->id,'month'=>$date );

$CI =& get_instance();
$data1 = $CI->db->select('*')->where($where)->get('driver_payment')->row();

}else{


$date=date('Y-m-d');
  $year = date('Y', strtotime($date));

$month = date('F', strtotime($date));
   $CI =& get_instance();

$where= array('driver_id' => $key->id,'month'=>$month,'year'=>$year );

$data1 = $CI->db->select('*')->where($where)->get('driver_payment')->row();
}

// if (isset($_GET['indate'])) {
    
//       $in_date=$_GET['indate'];
// }

 


// $date=date('Y-m-d');
//   $year = date('Y', strtotime($date));

// $month = date('F', strtotime($date));
//    $CI =& get_instance();

// $where= array('driver_id' => $key->id,'month'=>$month,'year'=>$year );

// $data1 = $CI->db->select('*')->where($where)->get('driver_payment')->row();

if (empty($data1)) {
  $color="white";
}else{
  $color="#56c7548f";
}
 ?>
  <tr style="background-color:<?php echo $color;?>;" >

<!-- 
       <td>

        <?php   


//      $CI =& get_instance();

// $where= array('driver_id' => $key->id,'month'=>$month12,'year'=>$year12 );
// $data = $CI->db->select('hotel_id')->where($where)->get('ride_booking')->result();
// foreach ($data as $key33 ) {
//     echo $key33->hotel_id;
// }


 ?>

     </td> -->

    <td><?php echo $key->drive_name; ?></td>

     <td>

       



        <?php   



     $CI =& get_instance();

$where= array('driver_id' => $key->id,'month'=>$month12,'year'=>$year12 );
// var_dump($where);


$data = $CI->db->select('rides_count')->where($where)->get('dirver_rides')->result();



$rows=count($data);



echo $rows;



 ?>

     </td>

      <td>
<?php 
// $data = $CI->db->select('comision')->where('driver_id',$key->id)->get('ride_booking')->result();

$data = $CI->db->query("select SUM(comision) AS Val_Sum from ride_booking where driver_id=$key->id AND month='$month12' AND year='$year12'");



$row = $data->row_array();

if (!empty($row['Val_Sum'])) {
  echo '€'.$row['Val_Sum'];
}else{
  echo '0';
}

 
 ?>
     </td>

     <td>

      <?php 

if (empty($data1)) {?>
  
       <form method="POST" action="<?php echo base_url('Main/add_month_payment') ?>">
        <input type="hidden" name="pay" value="1">
     <?php if (isset($in_date)) {?>
   <input type="hidden" name="month" value="<?php echo $in_date; ?>"> 
<?php } ?>
              
        <input type="hidden" name="driver_id" value="<?php  echo $key->id ?>">
           <button class="btn btn-primary" onclick="alert('Cnfirm Payment')">Pay</button>
      </form>

<?php }
 ?>

     
    
     </td>

          <td>

      <?php 
// var_dump($data1);die;
if (!empty($data1)) {?>
  
       <form method="POST" action="<?php echo base_url('Main/add_month_unpayment') ?>">
        <input type="hidden" name="pay" value="1">
          <?php if (isset($in_date)) {?>
   <input type="hidden" name="month" value="<?php echo $in_date; ?>"> 
<?php } ?>
        <input type="hidden" name="driver_id" value="<?php  echo $key->id ?>">
           <button class="btn btn-danger" onclick="alert('UnCnfirm Payment')">UnPay</button>
      </form>
<?php
}
 ?>

     
    
     </td>

  </tr>





<!--   </tbody>

</table>

</div>
 -->



<?php }
 }else{


$z=0;
 $totaol=0;
foreach ($driver as $key ) {?>
<?php 

if (isset($_GET['indate'])) {

   $in_date=$_GET['indate'];

 

$date = date('F', strtotime($in_date));
$where= array('driver_id' => $key->id,'month'=>$date );

$CI =& get_instance();
$data1 = $CI->db->select('*')->where($where)->get('driver_payment')->row();

}else{


$date=date('Y-m-d');
  $year = date('Y', strtotime($date));

$month = date('F', strtotime($date));
   $CI =& get_instance();

$where= array('driver_id' => $key->id,'month'=>$month,'year'=>$year );

$data1 = $CI->db->select('*')->where($where)->get('driver_payment')->row();
}

if (empty($data1)) {
  $color="white";
}
else{
  $color="#56c7548f";
}
 ?>
  <tr style="background-color:<?php echo $color;?>;" >

    <td><?php echo $key->drive_name; ?></td>

     <td>

       



        <?php   



     $CI =& get_instance();

$where= array('driver_id' => $key->id,'month'=>$month12,'year'=>$year12 );


$data = $CI->db->select('rides_count')->where($where)->get('dirver_rides')->result();



$rows=count($data);



echo $rows;



 ?>

     </td>

      <td>
<?php 
// $data = $CI->db->select('comision')->where('driver_id',$key->id)->get('ride_booking')->result();

$data = $CI->db->query("select SUM(comision) AS Val_Sum from ride_booking where driver_id=$key->id AND month='$month12' AND year='$year12'");



$row = $data->row_array();

if (!empty($row['Val_Sum'])) {
  echo '€'.$row['Val_Sum'];
}else{
  echo '0';
}

 
 ?>
     </td>

     <td>

      <?php 
// var_dump($data1);die;
if (empty($data1)) {?>
  
       <form method="POST" action="<?php echo base_url('Main/add_month_payment') ?>">
        <input type="hidden" name="pay" value="1">

<?php  if (isset($in_date)) {?>
   <input type="hidden" name="month" value="<?php echo $in_date; ?>"> 
<?php } ?>
               
        <input type="hidden" name="driver_id" value="<?php  echo $key->id ?>">
           <button class="btn btn-primary" onclick="alert('Cnfirm Payment')">Pay</button>
      </form>

<?php }
 ?>

     
    
     </td>

          <td>

      <?php 

if (!empty($data1)) {?>
  
       <form method="POST" action="<?php echo base_url('Main/add_month_unpayment') ?>">
        <input type="hidden" name="pay" value="1">
        <input type="hidden" name="driver_id" value="<?php  echo $key->id ?>">
           <button class="btn btn-danger" onclick="alert('UnCnfirm Payment')">UnPay</button>
      </form>
<?php
}
 ?>

     
    
     </td>

  </tr>

<?php }

 ?>




<?php } ?>  </tbody>

</table>

</div>

<script type="text/javascript">
    
    const monthControl = document.querySelector('input[type="month"]');
const date= new Date()
const month=("0" + (date.getMonth() + 1)).slice(-2)
const year=date.getFullYear()
monthControl.value = `${year}-${month}`;
</script>