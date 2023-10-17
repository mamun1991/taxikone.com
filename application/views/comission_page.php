<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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


<h4 class="pt-4 ">Commission</h4>
<?php include 'submenu.php'; ?>
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
