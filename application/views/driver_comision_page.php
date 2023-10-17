<?php 

include 'header.php';

?>
<?php

$ajax_url = base_url('Main/add_month_payment_ajax');
$ajax_urlUn = base_url('Main/add_month_unpayment_ajax');

  if (isset($_GET['indate'])) {

    $date = $_GET['indate'];

    $year12 = date('Y', strtotime($date));

    $month12 = date('F', strtotime($date));

  } else {
    // $year12='0';
  // $month12='0';
    // date_default_timezone_set("Asia/karachi");
    $date = date('Y-m-d');
    // var_dump($date);
    $year12 = date('Y', strtotime($date));

    $month12 = date('F', strtotime($date));

  }



 ?>




<div class="container pt-5">

  <form method="get" >

    <table class="table">
      <thead style="background-color: cornflowerblue;">
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

    <input type="month" name="indate" class="form-control "  value="">
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
if (1 == 1) {

  $z = 0;
  $totaol = 0;
  foreach ($driver as $key) { ?>

    <?php
    if (isset($_GET['indate'])) {

      $in_date = $_GET['indate'];



      $date = date($in_date);
      $year = date('Y', strtotime($date));
      $month = date('F', strtotime($date));

      $CI =& get_instance();
      $where = array('driver_id' => $key->id, 'month' => $month, 'year' => $year);
      $data1 = $CI->db->select('*')->where($where)->get('driver_payment')->row();

    } else {


      $date = date('Y-m-d');
      $year = date('Y', strtotime($date));
      $month = date('F', strtotime($date));
      $CI =& get_instance();

      $where = array('driver_id' => $key->id, 'month' => $month, 'year' => $year);
      $data1 = $CI->db->select('*')->where($where)->get('driver_payment')->row();
    }

    // print_r($where);

    // echo '<pre>'.$key->id; print_r($data1);

    if (empty($data1)) {
      $color = "white";
    } else {
      $color = "#56c7548f";
    }
    ?>
  <tr style="background-color:<?php echo $color;?>;" >
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
  
       <form method="POST">
        <input type="hidden" name="pay" value="1">
        <?php if (isset($in_date)) {?>
            <input type="hidden" id="getMonth" name="month" value="<?php echo $in_date; ?>"> 
        <?php } ?>
              
        <input type="hidden" id="get_driver_id" name="driver_id" value="<?php  echo $key->id ?>">
        <button type="button" id="confirmPay" class="btn btn-primary">Pay</button>
      </form>

<?php }
 ?>

     
    
     </td>

          <td>

      <?php 
// var_dump($data1);die;
if (!empty($data1)) {?>
  
       <form method="POST">
        <input type="hidden" name="pay" value="1">
          <?php if (isset($in_date)) {?>
            <input type="hidden" id="getMonth_un" name="month" value="<?php echo $in_date; ?>"> 
          <?php } ?>
        <input type="hidden" id="get_driver_id_un" name="driver_id" value="<?php  echo $key->id ?>">
           <button type="button" id="confirmPayUn" class="btn btn-danger">UnPay</button>
      </form>
<?php
}
 ?>

     </td>

  </tr>


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
           <button id="confirmPay" class="btn btn-primary">Pay</button>
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


<!-- pay modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Confirmation Modal</h3>
          <button type="button" class="close" data-dismiss="modal" id="payHide" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          
        </div>
        <div class="modal-body">
          <h4>Are you sure ?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="payHide">No</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="confirmPayment" >Yes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- unpay modal -->
  <div class="modal fade" id="myModalUn" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Confirmation Modal</h3>
          <button type="button" class="close" id="unPayHide" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          
        </div>
        <div class="modal-body">
          <h4>Are you sure ?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="unPayHide">No</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="confirmPaymentUn" >Yes</button>
        </div>
      </div>
    </div>
  </div>

  <style>
    .modal-title {
      width: 100%;
      text-align: center;
    }
  </style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- Include Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php 
  if(isset($_GET['indate'])){
    ?>
      <script type="text/javascript">
        const monthControl = document.querySelector('input[type="month"]');
        console.log(monthControl);
        const date= new Date()
        const month=("0" + (date.getMonth() + 1)).slice(-2)
        const year=date.getFullYear();
        console.log(month+year);
        monthControl.value = "<?=$_GET['indate']?>";
      </script>
    <?php
  } else {
    ?>
      <script type="text/javascript">
        const monthControl = document.querySelector('input[type="month"]');
        console.log(monthControl);
        const date= new Date()
        const month=("0" + (date.getMonth() + 1)).slice(-2)
        const year=date.getFullYear();
        console.log(month+year);
        monthControl.value = `${year}-${month}`;
      </script>
    <?php
  }
?>



<script type="text/javascript">
    
    


    // this code for pay drivers
  $(document).on('click', '#confirmPay', function(){

    $(this).addClass('payNow');
    
    $("#myModal").modal('show');
    
  });

  $(document).on('click', '#payHide', function(){
    $(".payNow").removeClass('payNow');
  });

  
  $(document).on('click', '#confirmPayment', function(){
    
    var siteUrl = '<?=$ajax_url?>';

    var monthGet = $(".payNow").closest("td").find('#getMonth').val();
    var get_driver_id = $(".payNow").closest('td').find("#get_driver_id").val();

    // console.log('click pay 2'+ siteUrl+'::'+monthGet+'::'+get_driver_id);

    $.ajax({
          url: siteUrl, // URL to send the request
          type: 'POST', // HTTP method
          data: {month: monthGet, get_driver_id: get_driver_id}, // Data to send
          dataType: 'json', // Expected response data type
          success: function(response) {
            // Handle successful response

            //$('.payNow').pa
            $('.payNow').closest('tr').css('background-color', '#56c7548f');
            
            $(".payNow").closest('td').next('td').html('<button type="button" id="confirmPayUn" class="btn btn-danger">Un Pay</button><input type="hidden" id="getMonth_un" name="month" value="'+monthGet+'"><input type="hidden" id="get_driver_id_un" name="driver_id" value="'+get_driver_id+'">');
            $(".payNow").remove();

            $('#confirmPay').removeClass('payNow');


            // console.log('data return: ' + response);
          },
          error: function(xhr, status, error) {
            // Handle error response
            $('#ajaxResponse').text('Error: ' + error);
          }
        });


  });


  // this code for unpay drivers
  $(document).on('click', '#confirmPayUn', function(){

    if($(this).hasClass('unpayNow')){
      $(this).removeClass('unpayNow');
    } else {
      $(this).addClass('unpayNow');
    }

    $("#myModalUn").modal('show');

  });

  $(document).on('click', '#unPayHide', function(){
    $(".unpayNow").removeClass('unpayNow');
  });

  $(document).on('click', '#confirmPaymentUn', function(){
    
    var siteUrl = '<?=$ajax_urlUn?>';
    
    var monthGet = $('.unpayNow').closest('tr').find("#getMonth_un").val();
    var get_driver_id = $('.unpayNow').closest('tr').find("#get_driver_id_un").val();
    // console.log('click pay 2'+ siteUrl+'::'+monthGet+'::'+get_driver_id);

    $.ajax({
          url: siteUrl, // URL to send the request
          type: 'POST', // HTTP method
          data: {month: monthGet, driver_id: get_driver_id}, // Data to send
          dataType: 'json', // Expected response data type
          success: function(response) {
            // Handle successful response

            //$('.payNow').pa
            $('.unpayNow').closest('tr').css('background-color', '#fff');
            
            $(".unpayNow").closest('tr').find('td').eq($(this).closest('td').index() - 1).html(
              '<button type="button" id="confirmPay" class="btn btn-primary">Pay</button><input type="hidden" id="getMonth" name="month" value="'+monthGet+'"><input type="hidden" id="get_driver_id" name="driver_id" value="'+get_driver_id+'">'
            );
            $(".unpayNow").remove();


            // console.log('data return: ' + response);
          },
          error: function(xhr, status, error) {
            // Handle error response
            $('#ajaxResponse').text('Error: ' + error);
          }
        });


  });


  // this code for remove 0 commission row
  $(document).ready(function(){
    $('.table tr td').each(function() { 
      if ($(this).text().trim() === '0')
        $(this).parent().remove(); 
    });

    setTimeout(function() { 
      $('.table tr td').each(function() { 
      if ($(this).text().trim() === '0')
        $(this).parent().remove(); 
      });
    }, 2000);
  });

  // $('th:nth-child(2)').click(function(){
  //   var table = $(this).parents('table').eq(0)
  //   var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
  //   this.asc = !this.asc
  //   if (!this.asc){rows = rows.reverse()}
  //   for (var i = 0; i < rows.length; i++){table.append(rows[i])}
  // })
  // function comparer(index) {
  //     return function(a, b) {
  //         var valA = getCellValue(a, index), valB = getCellValue(b, index)
  //         return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
  //     }
  // }
  // function getCellValue(row, index){ return $(row).children('td').eq(index).text() }

</script>