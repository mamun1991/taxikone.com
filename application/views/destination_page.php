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


<h4 class="pt-4 ">Destination</h4>
<?php include 'submenu.php'; ?>
</div>
<div class="container pt-5">

   

  <table class="table table-striped"><thead style="background-color: cornflowerblue;">
    <thead>
      <tr>
        <th scope="col">Destinations</th>
        <th scope="col">Rides</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($destiny as $key3) { ?>
      <tr>
        <td><?php echo $key3->destiny; ?></td>
        <td>
          <?php   
            $CI =& get_instance();
            $dest = $CI->db->select('dest_id')->where('dest_id',$key3->id)->get('ride_booking')->result();
            $rows=count($dest);
            echo $rows;
          ?>
        </td>
        <td><a href="<?php echo base_url();?>Main/edit_destiny/<?php echo $key3->id;?>">Edit</a></td>
      </tr>
    <?php  } ?>
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
