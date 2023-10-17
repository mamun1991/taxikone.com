  <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"-->
  <!--      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->
  <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
<?php 

include 'header.php'; ?>

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

<h3>
My Database Data



</h3>

<h4 class="pt-4 ">Drivers</h4>
<?php include 'submenu.php'; ?>
</div>

<div class="container pt-5">

   

  <table class="table table-striped">
    <thead style=" background-color: cornflowerblue;">
      <tr>
        <th scope="col">Driver's</th>
        <th scope="col">Rides</th>
        <th scope="col">Edit</th>
      </tr>
      </thead>
    <tbody>

<?php 

foreach ($driver as $key ) {?>

  <tr>

    <td><?php echo $key->drive_name; ?></td>

     <td>

       



  <?php   
     $CI =& get_instance();
    $data = $CI->db->select('rides_count')->where('driver_id',$key->id)->get('dirver_rides')->result();

    $rows=count($data);
    echo $rows;
  ?>
     </td>
      <td>  <a href="<?php echo base_url();?>Main/edit_driver/<?php echo $key->id;?>">Edit</a></td>
  </tr>

<?php } ?>

  </tbody>

</table>

</div>

<hr>

<div class="container pt-2">

  

<h4 class="pt-4 ">Hotel's</h4>


</div>

<div class="container pt-5">

   

  <table class="table table-striped"><thead style="

    background-color: cornflowerblue;

">

    <tr>

      <th scope="col">Hotel</th>

      <th scope="col">Rides</th>

      <th scope="col">Edit</th>

    </tr>

  </thead>

  <tbody class="row_position"> 

<?php 

foreach ($hotel as $key1) {

 ?>

 <tr id="<?php echo $key1->id;?>">

   <td><?php echo $key1->hotel_name; ?></td>

    <td>

      



      <?php   



     $CI =& get_instance();



$data = $CI->db->select('rides_count')->where('hotel_id',$key1->id)->get('hotel_rides')->result();



$rows=count($data);



echo $rows;


// if (empty($key1->show_seq)) {
//   echo '0';
//  }
//   else{
//   echo $key1->show_seq;
// }

 ?>

    </td>

   <td> <a href="<?php echo base_url();?>Main/edit_hotel/<?php echo $key1->id;?>">Edit</a></td></td>

 </tr>

<?php }



 ?>



  </tbody>

</table>

</div>

<hr>



<div class="container pt-2">

  

<h4 class="pt-4 ">Destinations</h4>

</div>

<div class="container pt-5">

   

  <table class="table table-striped"><thead style="

    background-color: cornflowerblue;

">

    <tr>

      <th scope="col">Destinations</th>
      <th scope="col">Rides</th>

      <th scope="col">Edit</th>
        <th scope="col">Delete</th>

    </tr>

  </thead>

  <tbody>



<?php 

foreach ($destiny as $key3) {?>

   <tr>

     <td><?php echo $key3->destiny; ?></td>

    <td>   <?php   



     $CI =& get_instance();



$data = $CI->db->select('show_seq')->where('dest_id',$key3->id)->get('order_by_destination')->row();







echo $data->show_seq;



 ?></td>

     <td><a href="<?php echo base_url();?>Main/edit_destiny/<?php echo $key3->id;?>">Edit</a></td>
     <td><a href="<?php echo base_url();?>Main/delete_destiny/<?php echo $key3->id;?>">Delete</a></td>

   </tr>

<?php  } ?>

  </tbody>

</table>

</div>







<hr>

<div class="container pt-2">

  

<h4 class="pt-4 ">Commissions</h4>

</div>

<div class="container pt-5">

   

  <table class="table table-striped"><thead style="

    background-color: cornflowerblue;

">

    <tr>

      <th scope="col">Hotel</th>

      <th scope="col">Destination's</th>

      <th scope="col">€</th>

      <th scope="col">Edit</th>

    </tr>

  </thead>

  <tbody>

<?php foreach ($comision as $key4 ) {?>

<tr>

   <td>

    <?php   



     $CI =& get_instance();



$data = $CI->db->select('hotel_name')->where('id',$key4->hotel_id)->get('hotel')->row();



echo $data->hotel_name;



 ?>

  </td>

    <td> <?php   



     $CI =& get_instance();



$data = $CI->db->select('destiny')->where('id',$key4->dest_id)->get('destination')->row();



echo $data->destiny;



 ?></td>

  <td><?php echo $key4->rate; ?></td>

  <td><a href="<?php echo base_url();?>Main/edit_comission/<?php echo $key4->id;?>">Edit</a></td>

</tr>

<?php 

} ?>



  </tbody>

</table>

</div>

<hr>





<!-- <div class="container pt-2">

  

<h4 class="pt-4 ">Payment</h4>

</div>

<div class="container pt-5">

   

  <table class="table table-striped"><thead style="

    background-color: cornflowerblue;

">

    <tr>

      <th scope="col">Hotel</th>

      <th scope="col">Month</th>

      <th scope="col">Edit</th>

    </tr>

  </thead>

  <tbody>



<?php 

foreach ($hotel_payment_detials as $key3) {?>

   <tr>

     <td>

       

        <?php   



     $CI =& get_instance();


// var_dump($key3->hotel_id);die;
$data1 = $CI->db->select('*')->where('id',$key3->hotel_id)->get('hotel')->row();





echo $data1->hotel_name;



 ?>

     </td>

     <td><?php if ($key3->apr!='null'): ?>

       <?php echo $key3->apr;  ?>

     <?php endif ?>,

<?php if ($key3->may!='null'): ?>

       <?php echo $key3->may;  ?>

     <?php endif ?>,

     <?php if ($key3->jun!='null'): ?>

       <?php echo $key3->jun;  ?>

     <?php endif ?>,

     <?php if ($key3->jul!='null'): ?>

       <?php echo $key3->jul;  ?>

     <?php endif ?>,

     <?php if ($key3->aug!='null'): ?>

       <?php echo $key3->aug;  ?>

     <?php endif ?>,

     <?php if ($key3->sep!='null'): ?>

       <?php echo $key3->sep;  ?>

     <?php endif ?>

   </td>

     <td ><a href="<?php echo base_url();?>Main/edit_hotel_payment_page/<?php echo $key3->id;?>">Edit</a></td>

   </tr>

<?php  } ?>

  </tbody>

</table>

</div> -->



<!-- <div class="container pt-5">

   

  <table class="table table-striped"><thead style="

    background-color: cornflowerblue;

">

    <tr>

      <th scope="col">Driver</th>

      <th scope="col">Month</th>

       <th scope="col">Edit</th>

    </tr>

  </thead>

  <tbody>



<?php 

foreach ($driver_payment_detials as $key3) {?>

   <tr>

     <td>

       

         <?php   



     $CI =& get_instance();



$data1 = $CI->db->select('*')->where('id',$key3->driver_id)->get('driver')->row();

echo $data1->drive_name;





 ?>

     </td>

     <td><?php if ($key3->apr!='null'): ?>

       <?php echo $key3->apr;  ?>

     <?php endif ?>,

<?php if ($key3->may!='null'): ?>

       <?php echo $key3->may;  ?>

     <?php endif ?>,

     <?php if ($key3->jun!='null'): ?>

       <?php echo $key3->jun;  ?>

     <?php endif ?>,

     <?php if ($key3->jul!='null'): ?>

       <?php echo $key3->jul;  ?>

     <?php endif ?>,

     <?php if ($key3->aug!='null'): ?>

       <?php echo $key3->aug;  ?>

     <?php endif ?>,

     <?php if ($key3->sep!='null'): ?>

       <?php echo $key3->sep;  ?>

     <?php endif ?>

   </td>

     <td><a href="<?php echo base_url();?>Main/edit_driver_payment_page/<?php echo $key3->id;?>">Edit</a></td>

   </tr>

<?php  } ?>

  </tbody>

</table>

</div>
 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script type="text/javascript">

        $('.alert').delay(1000).fadeOut('slow');

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
            url: '<?php echo base_url('Main/ajaxPost') ?>',
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


