<style>
.headTitle{
  text-align: center;
  background: #db83ff;
  color: #fff;
  padding: 10px;
  margin: 0px;
}

@media (max-width: 767px) {
    td {
      padding: 0px !important;
    }
    .customBtn {
      padding: 2px !important;
      width: 80px;
      margin-bottom: 4px !important;
    }
  }
</style>


<?php include 'header.php'; ?>
<div class="container pt-5">
<h3>My Database Data</h3>

<h4 class="pt-4 ">Drivers</h4>
<?php include 'submenu.php'; ?>
</div>

<div class="container pt-5">
<form method="post" action="<?php echo base_url('Main/add_driver') ?>">
  <div class="form-group">
    <label for="exampleInputEmail1"><strong>New Driver/User</strong></label>
    <input type="text" class="form-control" name="driver" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter driver">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1"><strong>Username</strong></label>
    <input type="text" class="form-control" name="Username" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1"><strong>Password</strong></label>
    <input type="text" class="form-control" name="Password" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Password">
  </div>
  <div class="form-group form-check"></div>
  <button type="submit" class="btn btn-primary">Add Driver</button>
</form>
</div>

<div class="container pt-5">

<h2 class="headTitle">Admin / User</h2>
  <table class="table table-striped">
    <thead style=" background-color: cornflowerblue;">
      <tr>
        <th scope="col">User Name</th>
        <th scope="col">Password</th>
        <th scope="col">User Type</th>
        <th scope="col">Super Admin</th>
        <th scope="col">Action</th>
      </tr>
      </thead>
    <tbody>
    <?php 
      foreach ($admin_dash_data as $key ) {?>
        <tr>
          <td><?php echo $key->username; ?></td>
          <td><?php echo $key->password ?></td>
          <td><?= $key->is_admin == 0 ? 'Admin' : 'User'; ?></td>
          <td><?= $key->super_admin == 1 ? 'Yes' : 'No'; ?></td>
          <td>  
            <button name="<?=$key->id; ?>" id="editAdmin" class="editMan btn btn-warning customBtn" type="button">Edit</button>
            <button name="<?=$key->id; ?>" id="deleteAdmin" class="editMan btn btn-danger customBtn" type="button">Delete</button>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

</div>

<!-- edit admin modal data-backdrop="static"-->
<div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form method="post" action="<?php echo base_url('Main/admin_dashboard_update') ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">Edit Admin</h3>
        <button type="button" class="close" data-dismiss="modal" id="payHide" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label for="inputuser">Username</label>
            <input type="text" name="username" class="form-control form-control-lg" id="inputAdminName" aria-describedby="name" placeholder="Enter Name">
            <input type="hidden" name="adminId" id="hiddenmanid" value="">
          </div>
          <div class="form-group">
            <label for="inputpass">password</label>
            <input type="text" name="password" class="form-control form-control-lg" id="inputAdminPass" aria-describedby="name" placeholder="Enter Name">
          </div>
          <div class="form-group">
            <label for="inputGroupStatus">Admin / User</label>
            <select class="form-control form-control-lg" id="adminType" name="adminType">
              <option value="0">Admin</option>
              <option value="1">User</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputGroupStatus">Super Admin / Admin</label>
            <select class="form-control form-control-lg" id="superAdmin" name="superAdmin">
              <option value="1">Super Admin</option>
              <option value="0">Admin</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="confirmAdminSubmit" >Submit</button>
      </div>
    </div>
  </div>
  </form>
</div>

<!-- // delete hotel modal -->
<div class="modal fade" id="deleteAdminModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel">
  <form method="post" action="<?php echo base_url('Main/admin_dashboard_delete') ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">Delete Admin</h3>
        <button type="button" class="close delClsh" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
          <div class="form-group">
            <h4>Are you sure want to delete?</h4>
            <input type="hidden" name="adminId_del" id="adminId_del" value="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary delClsh" data-dismiss="modal" aria-label="Close" >No</button>
        <button type="submit" class="btn btn-danger" id="confirmHotelDelete" >Yes</button>
      </div>
    </div>
  </div>
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script type="text/javascript">

  $(document).on("click", "#editAdmin", function(){
      // console.log('clicked on add');
      var adminid = $(this).attr('name');
      var siteUrl = '<?= base_url('Main/select_admin') ?>';
      
      $.ajax({
          url: siteUrl,
          type: 'POST',
          data: {adminid: adminid},
          dataType: 'json',
          success: function(response) {

            $("#inputAdminName").val(response.username);
            $("#inputAdminPass").val(response.password);
            $("#hiddenmanid").val(response.id);

            var isadmin, superadmin;
            if(response.is_admin == 0){
              isadmin = 'Admin';
            } else {
              isadmin = 'User';
            }
            if(response.super_admin == 1){
              superadmin = 'Super Admin';
            } else {
              superadmin = 'Admin';
            }
            $("#adminType").prepend('<option hidden selected value="'+response.is_admin+'">'+isadmin+'</option>');
            $("#superAdmin").prepend('<option hidden selected value="'+response.super_admin+'">'+superadmin+'</option>');

            $('#editAdminModal').modal('show');
            
          },
          error: function(xhr, status, error) {
            // Handle error response
            $('#ajaxResponse').text('Error: ' + error);
          }
      });
    });

    $(document).on("click", "#deleteAdmin", function(){
        // console.log('clicked on add');
        var manid = $(this).attr('name');
        $("#adminId_del").val(manid);
        
        $('#deleteAdminModal').modal('show');
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


