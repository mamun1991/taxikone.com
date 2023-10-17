<?php include 'header.php'; ?>

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


<h4 class="pt-4 ">Hotel</h4>

</div>
<div class="container pt-5">

  <?php include 'submenu.php'; ?>

  <table class="table table-striped sortingTable">
    <thead style="background-color: cornflowerblue;">
      <tr>
        <th scope="col">Hotel</th>
        <th scope="col">Rides</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
  <tbody class="row_position"> 
  <?php foreach ($hotel as $key1) { ?>
    <tr id="<?php echo $key1->id;?>">
      <td><?php echo $key1->hotel_name; ?></td>
      <td>
      <?php   
        $CI =& get_instance();
        $data = $CI->db->select('rides_count')->where('hotel_id',$key1->id)->get('hotel_rides')->result();
        $rows=count($data);
        echo $rows;
      ?>
      </td>
      <td> <a href="<?php echo base_url();?>Main/edit_hotel/<?php echo $key1->id;?>">Edit</a></td></td>
    </tr>
  <?php } ?>

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

    $(document).ready(function() {
      var rows = $('.sortingTable tbody tr').get();
      rows.sort(function(a, b) {
        var ridesCountA = parseInt($(a).find('td:nth-child(2)').text());
        var ridesCountB = parseInt($(b).find('td:nth-child(2)').text());
        return (ridesCountA < ridesCountB) ? 1 : (ridesCountA > ridesCountB) ? -1 : 0;
      });
      $.each(rows, function(index, row) {
        $('.sortingTable').append(row);
      });
    });
</script>
