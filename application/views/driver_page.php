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


<h4 class="pt-4 ">Drivers</h4>
<?php include 'submenu.php'; ?>
</div>

<div class="container pt-5">

   

	<table class="table table-striped"><thead style="background-color: cornflowerblue;">
    <tr>
      <th scope="col">Driver's</th>
      <th scope="col">Rides</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>

    <?php 
    foreach ($driver as $key ) {?>
      <tr>
        <td><?php echo $key->drive_name; ?></td>
        <td><?php $CI =& get_instance();
          $data = $CI->db->select('rides_count')->where('driver_id',$key->id)->get('dirver_rides')->result(); $rows=count($data); echo $rows; ?>
        </td>
        <td>  <a href="<?php echo base_url();?>Main/edit_driver/<?php echo $key->id;?>">Edit</a></td>
        <td><button type="button" name="<?=$key->id?>" class="btn btn-danger deleteDriver">Delete</button></td>
      </tr>
    <?php } ?>

  </tbody>
</table>

</div>

<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel">
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
          <form action="<?=base_url()?>Main/delete_driver" method="post">
            <input type="hidden" name="driver_id" class="driverId" value="">
            <button type="button" class="btn btn-default" data-dismiss="modal" id="">No</button>
            <button type="submit" class="btn btn-primary"  id="confirmPayment" >Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- Include Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


  <script type="text/javascript">

        $('.alert').delay(1000).fadeOut('slow');

    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">


    $(document).on('click', '.deleteDriver', function(){
      var id = $(this).attr('name');
      $('.driverId').val(id);
      $("#myModalDelete").modal('show');
    });

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
