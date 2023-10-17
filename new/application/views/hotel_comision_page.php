<?php 

include 'header.php';

?>
<?php

if (isset($_GET['indate'])) {





$date=$_GET['indate'];

$year12 = date('Y', strtotime($date));

$month12 = date('F', strtotime($date));

}else{
$year12='0';
$month12='0';
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

    </tr>

  </thead>

  <tbody>



 <tr>


  <td>
        <?php 


// $first_day = date('Y-m-01');


// $newDate = date("Y-m-d");


         ?>

    <input type="month" name="indate" class="form-control "  >

    

  </td>

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
$z=0;
 $totaol=0;
foreach ($hotel as $key ) {?>
<?php 
$date=date('Y-m-d');
  $year = date('Y', strtotime($date));

$month = date('F', strtotime($date));
   $CI =& get_instance();

$where= array('hotel_id' => $key->id,'month'=>$month,'year'=>$year );

$data1 = $CI->db->select('*')->where($where)->get('hotel_payment')->row();

if (empty($data1)) {
  $color="white";
}else{
  $color="#56c7548f";
}
 ?>
  <tr style="background-color:<?php echo $color;?>;" >

    <td><?php echo $key->hotel_name; ?></td>

     <td>

       



        <?php   



     $CI =& get_instance();

$where= array('hotel_id' => $key->id,'month'=>$month12,'year'=>$year12 );

$data = $CI->db->select('rides_count')->where($where)->get('hotel_rides')->result();



$rows=count($data);



echo $rows;



 ?>

     </td>

      <td>
<?php 
// $data = $CI->db->select('comision')->where('driver_id',$key->id)->get('ride_booking')->result();

$data = $CI->db->query("select SUM(comision) AS Val_Sum from ride_booking where hotel_id=$key->id AND month='$month12' AND year='$year12'");



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
  
       <form method="POST" action="<?php echo base_url('Main/add_month_payment_hotel') ?>">
        <input type="hidden" name="pay" value="1">
        <input type="hidden" name="hotel_id" value="<?php  echo $key->id ?>">
           <button class="btn btn-primary" onclick="alert('Cnfirm Payment')">Pay</button>
      </form>
<?php }
 ?>


     
    
     </td>
         <td>

      <?php 

if (!empty($data1)) {?>
  
       <form method="POST" action="<?php echo base_url('Main/add_month_unpayment_hotel') ?>">
        <input type="hidden" name="pay" value="1">
        <input type="hidden" name="hotel_id" value="<?php  echo $key->id ?>">
           <button class="btn btn-danger" onclick="alert('UnCnfirm Payment')">Pay</button>
      </form>
<?php }
 ?>

     
    
     </td>

  </tr>

<?php }

 ?>



  </tbody>

</table>

</div>