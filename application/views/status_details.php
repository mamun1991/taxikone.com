
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
  .addContent{
    margin: 10px 0px;
  }
  .addGroup{
    width: 300px;
    margin-right: 20px;
  }
  .listContent{
    margin-top: 30px;
  }
  .hotelGroup{
    width: 100%;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px 6px 0px 0px;
    overflow: hidden;
  }
  .hotelGroup h2{
    font-size: 24px;
    text-align: center;
    background: #156fcf;
    padding: 10px 0px;
    color: #fff;
    margin: 0px;
  }
  .groupList{
    background: #e0ebf7;
    height: 50px;
    border-bottom: 1px solid #b5cde7;
    line-height: 45px;
  }
  .groupList p{
    margin: 0px;
    float: left;
    padding: 0 1%;
  }
  .pone{
    width: 35%;
  }
  .ptwo{
      width: 18%;
  }
  .pthree{
      width: 150px;
      float: right !important;
      text-align: right;
  }
  .pfour{
      width: 25%;
  }
  .ponel{
    width: 35%;
  }
  .ptwol{
      width: 20%;
  }
  .pthreel{
      width: auto;
      float: right !important;
  }
  .pfourl{
      width: 17%;
  }
  .pfivel{
      width: 25%;
  }
  .editGroup{
    margin-top: 5px;
  }
  .hotelGroupList{
    width: 100%;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px 6px 0px 0px;
    overflow: hidden;  
  }
  .hotelGroupList h2{
    font-size: 24px;
    text-align: center;
    background: #238139;
    padding: 10px 0px;
    color: #fff;
    margin: 0px;
  }
  .hotelList{
    background: #e8fbec;
    height: 50px;
    border-bottom: 1px solid #96dfa7;
    overflow: hidden;
    /* line-height: 45px; */
  }
  .hotelList p{
    margin: 0px;
    float: left;
    padding: 0 1%;
    line-height: 15px;
    padding-top: 15px;
  }
  .editGroup {
    float: none;
  }
  .extracss {
    background: linear-gradient(to right,#2dcb4f, #5bb5e9, #c37239) !important;
    font-size: 17px;
    color: #ffffff;
    box-shadow: 0px 0px 8px 0px #484040;
  }
  .flc {
    float: right !important;
    width:125px;
    text-align:center;
  }
  @media (min-width: 768px) and  (max-width: 992px){
    .container{
      max-width: 100%!important;
      margin: 0px;
      width: 100%;
    }
    .hotelGroupList{
      margin: 0px;
    }
    .pthreel {
      width: auto;
    }
    .ptwol {
      width: 13%;
    }
    
  }

  @media (max-width: 767px) {
    .hotelGroup{
      float: none;
      width: 100%;
      margin-bottom:20px;
    }
    .hotelGroupList{
      float: none;
      width: 100%;
    }
    .addGroup {
        width: 100%;
        margin-right: 0px;
        height: 40px;
        margin-bottom: 10px !important;
    }
    .modal-dialog{
      margin: 10px auto !important;
    }

    @media (min-width: 576px){
      .container {
          max-width: 100% !important;
      }
    }
    @media (max-width: 576px){
      .pfourl button {
        padding: 6px 4px;
      }
      .pone{
        width: 35%;
      }
      .ptwol{
          width: 14%;
      }
      .pfivel{
          width: 16%;
      }
    }
  }
</style>
<?php 
    // $fdate=$_GET['indate'];
    include 'header.php'; 
?>


<div class='container'>
    <div class="addContent">
        <button id="addGroupBtn" class='addGroup btn btn-primary' type='button'>Add Group</button>
        <button id="addHotelBtn" class='addGroup btn btn-success' type='button'>Add Hotel</button>
    </div>
    <div class="listContent">
        <div class='hotelGroup'>
            <h2>Groups</h2>
            <div class="appendGroup">
              <?php
              if(isset($group_data)){

                foreach($group_data as $groupData){
                  ?>
                    <div class="groupList">
                      <p class="pone"><?=$groupData->name; ?></p>
                      <p class="ptwo"><?=$groupData->status == 1 ? 'Active' : '<span style="color:#f14c4c">Inactive</span>' ?></p>
                      <p class="pthree"><button name="<?=$groupData->id; ?>" id="editBtnGroup" class="editGroup btn btn-warning" type="button">Edit</button>
                      <button name="<?=$groupData->id; ?>" id="deleteBtnGroup" class="editGroup btn btn-danger" type="button">Delete</button></p>
                    </div>
                  <?php
                }
              }
              ?>
            </div> 
        </div>
        <div class='hotelGroupList'>
            <h2>Hotel List</h2>
            <div class="appendHotel">
              <div class="hotelList extracss" id="apendAfter">
                  <p class="ponel">Hotel Name</p>
                  <p class="ptwol">Hotel Status</p>
                  <p class="pfivel">Group Name</p>
                  <p class="flc">Action</p>
              </div>
              <?php
              if(isset($hotel_data)){

                foreach($hotel_data as $hotelData){
                  ?>
                    <div class="hotelList">
                        <p class="ponel"><?=$hotelData->hotel_name; ?></p>
                        <p class="ptwol"><?=$hotelData->status == 1 ? 'Active' : '<span style="color:#f14c4c">Inactive</span>' ?></p>
                        <p class="pfivel" name="<?=$hotelData->groupid; ?>"><?=$hotelData->groupname==''? 'No group' : $hotelData->groupname; ?></p>
                        <p class="pthreel" style="padding-top: 0px;"><button name="<?=$hotelData->id; ?>" id="editBtnHotel" class="editGroup btn btn-warning" type="button">Edit</button>
                        <button name="<?=$hotelData->id; ?>" id="deleteBtnHotel" class="editGroup btn btn-danger" type="button">Delete</button></p>
                    </div>
                  <?php
                }
              }
              ?>
            </div>
        </div>
    </div>
</div>







<!-- add group modal data-backdrop="static"-->
<div class="modal fade" id="addGroupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">Add Group</h3>
        <button type="button" class="close" data-dismiss="modal" id="payHide" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="inputGroupName">Group Name</label>
            <input type="text" class="form-control form-control-lg" id="inputGroupName" aria-describedby="name" placeholder="Enter Name">
            <small id="emailHelp" style="display:none; color: #f14c4c" class="form-text">Please enter Group Name!</small>
          </div>
          <div class="form-group">
            <label for="inputGroupStatus">Status</label>
            <select class="form-control form-control-lg" id="inputGroupStatus">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirmGroupSubmit" >Submit</button>
      </div>
    </div>
  </div>
</div>

  <!-- edit group modal -->
<div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">Edit Group</h3>
        <button type="button" class="close" data-dismiss="modal" id="editHide" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="inputGroupName">Group Name</label>
            <input type="text" class="form-control form-control-lg" id="editInputGroupName" value="" placeholder="Enter Name">
            <input type="hidden" id="hiddenGroupId" value="">
            <small id="emailHelp" style="display:none" class="form-text text-muted">Please enter Group Name!</small>
          </div>
          <div class="form-group">
            <label for="inputGroupStatus">Status</label>
            <select class="form-control form-control-lg" id="editInputGroupStatus">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="editConfirmGroupSubmit" >Submit</button>
      </div>
    </div>
  </div>
</div>

<!-- // delete group modal -->
<div class="modal fade" id="deleteGroupModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">Delete Group</h3>
        <button type="button" class="close delCls" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
          <div class="form-group">
            <h4>Are you sure want to delete?</h4>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary delCls" data-dismiss="modal" aria-label="Close" >No</button>
        <button type="button" class="btn btn-danger" id="confirmGroupDelete" >Yes</button>
      </div>
    </div>
  </div>
</div>

<!-- // delete hotel modal -->
<div class="modal fade" id="deleteHotelModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">Delete Hotel</h3>
        <button type="button" class="close delClsh" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
          <div class="form-group">
            <h4>Are you sure want to delete?</h4>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary delClsh" data-dismiss="modal" aria-label="Close" >No</button>
        <button type="button" class="btn btn-danger" id="confirmHotelDelete" >Yes</button>
      </div>
    </div>
  </div>
</div>



  <!-- add hotel modal data-backdrop="static"-->
<div class="modal fade" id="addHotelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Add Hotel</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="inputHotelName">Hotel Name</label>
              <input type="text" class="form-control form-control-lg" id="inputHotelName" aria-describedby="name" placeholder="Enter Name">
              <small id="emailHelpHotel" style="display:none; color: #f14c4c" class="form-text">Please enter Hotel Name!</small>
            </div>
            <div class="form-group">
              <label for="inputHotelGroup">Group Name</label>
              <select class="form-control form-control-lg" id="inputHotelGroup">
                <?php
                  if(isset($group_data)){
                    foreach($group_data as $grp){
                      ?>
                        <option value="<?=$grp->id?>"><?=$grp->name?></option>
                      <?php
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="inputHotelStatus">Status</label>
              <select class="form-control form-control-lg" id="inputHotelStatus">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="confirmHotelSubmit" >Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- edit hotel modal -->
<div class="modal fade" id="editHotelModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Edit Hotel</h3>
          <button type="button" class="close" data-dismiss="modal" id="editHideh" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="inputHotelName">Hotel Name</label>
              <input type="text" class="form-control form-control-lg" id="editInputHotelName" value="" placeholder="Enter Name">
              <input type="hidden" id="hiddenHotelId" value="">
              <small id="emailHelpHotel" style="display:none" class="form-text text-muted">Please enter Hotel Name!</small>
            </div>
            <div class="form-group">
              <label for="editInputHotelGroup">Group Name</label>
              <select class="form-control form-control-lg" id="editInputHotelGroup">
                <?php
                  if(isset($group_data)){
                    foreach($group_data as $grp){
                      ?>
                        <option value="<?=$grp->id?>"><?=$grp->name?></option>
                      <?php
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="inputHotelStatus">Status</label>
              <select class="form-control form-control-lg" id="editInputHotelStatus">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="editConfirmHotelSubmit" >Submit</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- Include Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- script for group manage -->
<script type="text/javascript">
    $(document).on("click", "#addGroupBtn", function(){
        console.log('clicked on add');
        $('#addGroupModal').modal('show');
    });

    $(document).on("click", "#deleteBtnGroup", function(){
      $(this).addClass('delete_grp');
        $('#deleteGroupModal').modal('show');
    });

    $(document).on("click", ".delCls", function(){
      $('.delete_grp').removeClass('delete_grp');
    });

    $(document).on("click", "#confirmGroupDelete", function(){

      var del_id = $('.delete_grp').attr('name');
      console.log(del_id);
      var siteUrl = '<?= base_url('Main/delete_group') ?>';
      
      $.ajax({
          url: siteUrl,
          type: 'POST',
          data: {delId: del_id},
          dataType: 'json',
          success: function(response) {

            $('#deleteGroupModal').modal('hide');

            var name = $('.delete_grp').closest('p').parent().remove();

            $('.delete_grp').removeClass('delete_grp');
            
          },
          error: function(xhr, status, error) {
            // Handle error response
            $('#ajaxResponse').text('Error: ' + error);
          }
      });
    });

    $(document).on('click', '#confirmGroupSubmit', function(){
        
      var siteUrl = '<?= base_url('Main/add_group') ?>';

      var name = $("#inputGroupName").val();
      var status = $("#inputGroupStatus").val();

      if(status == 1){
        var text = 'Active';
      } else {
        var text = '<span style="color:#f14c4c">Inactive</span>';
      }

      if(name.length < 1){
        $("#emailHelp").show();
        return;
      }

      // console.log('click pay 2'+ siteUrl+'::'+name+'::'+status);
      // $(this).html('Loading...');
      $.ajax({
          url: siteUrl, // URL to send the request
          type: 'POST', // HTTP method
          data: {name: name, status: status}, // Data to send
          dataType: 'json', // Expected response data type
          success: function(response) {
            // Handle successful response
            $(this).html('Submit');

            if(response == 'error'){

            } else {
              $(".appendGroup").append(`<div class="groupList">
                      <p class="pone">`+name+`</p>
                      <p class="ptwo">`+text+`</p>
                      <p class="pthree"><button name="`+response+`" id="editBtnGroup" class="editGroup btn btn-warning" type="button">Edit</button>
                      <button name="`+response+`" id="deleteBtnGroup" class="editGroup btn btn-danger" type="button">Delete</button></p>
                    </div>`);
              $('#addGroupModal').modal('hide');
            }
            
          },
          error: function(xhr, status, error) {
            // Handle error response
            $('#ajaxResponse').text('Error: ' + error);
          }
      });
    });


    $(document).on("click", "#editBtnGroup", function(){
        
      var name = $(this).closest('p').parent().find('.pone').html();
      
      var id = $(this).attr('name');
      $("#editInputGroupName").val(name);
      $("#hiddenGroupId").val(id);

      $(this).closest('p').parent().find('.pone').addClass('editBTN');
      $(this).closest('p').parent().find('.ptwo').addClass('editBTNS');
      $('#editGroupModal').modal('show');
    });

    $(document).on("click", "#editHide", function(){
        
      $('.editBTN').removeClass('editBTN');
      
    });

    $(document).on('click', '#editConfirmGroupSubmit', function(){
        
      var siteUrl = '<?= base_url('Main/update_group') ?>';

      var name = $("#editInputGroupName").val();
      var id = $("#hiddenGroupId").val();
      var status = $("#editInputGroupStatus").val();

      if(status == 1){
        var text = 'Active';
      } else {
        var text = '<span style="color:#f14c4c">Inactive</span>';
      }

      if(name.length < 1){
        $("#emailHelp").show();
        return;
      }

      $(this).html('Loading...');
      $.ajax({
          url: siteUrl,
          type: 'POST',
          data: {name: name, status: status, id: id},
          dataType: 'json',
          success: function(response) {
            // Handle successful response
            $("#editConfirmGroupSubmit").html('Submit');
            
            if(response == 'error'){

            } else {
              $('#editGroupModal').modal('hide');
              $('.editBTN').html(name);
              $('.editBTNS').html(text);
            }


            $('.editBTN').removeClass('editBTN');
            $('.editBTNS').removeClass('editBTNS');
            
            
          },
          error: function(xhr, status, error) {
            // Handle error response
            $('#ajaxResponse').text('Error: ' + error);
          }
      });
    });


</script>

<!-- script for hotel manage -->
<script type="text/javascript">
    $(document).on("click", "#addHotelBtn", function(){
        // console.log('clicked on add');
        $('#addHotelModal').modal('show');
    });

    $(document).on('click', '#confirmHotelSubmit', function(){
        
      var siteUrl = '<?= base_url('Main/addHotel') ?>';

      var name = $("#inputHotelName").val();
      var status = $("#inputHotelStatus").val();
      var groupid = $("#inputHotelGroup").val();

      if(status == 1){
        var text = 'Active';
      } else {
        var text = '<span style="color:#f14c4c">Inactive</span>';
      }

      if(name.length < 1){
        $("#emailHelpHotel").show();
        return;
      }

      $(this).html('Loading...');
      $.ajax({
          url: siteUrl, // URL to send the request
          type: 'POST', // HTTP method
          data: {hotel_name: name, status: status, group: groupid}, // Data to send
          dataType: 'json', // Expected response data type
          success: function(response) {
            // Handle successful response
            $(this).html('Submit');

            if(response.dataInsert == 'error'){

            } else {
              $("#apendAfter").after(`<div class="HotelList">
                      <p class="ponel">`+name+`</p>
                      <p class="ptwol">`+text+`</p>
                      <p class="pfivel">`+response.group_name.name+`</p>
                      <p class="pthreel"><button name="`+response.dataInsert+`" id="editBtnHotel" class="editGroup btn btn-warning" type="button">Edit</button>
                      <button name="`+response.dataInsert+`" id="deleteBtnHotel" class="editGroup btn btn-danger" type="button">Delete</button></p>
                    </div>`);
              $('#addHotelModal').modal('hide');
            }
            
          },
          error: function(xhr, status, error) {
            // Handle error response
            $('#ajaxResponse').text('Error: ' + error);
          }
      });
    });


    $(document).on("click", "#editBtnHotel", function(){
        
      var name = $(this).closest('p').parent().find('.ponel').html();
      var groupId = $(this).closest('p').parent().find('.pfivel').attr('name');

      if(!groupId){
        groupId = 0;
      }
      
      var id = $(this).attr('name');
      $("#editInputHotelName").val(name);
      $("#hiddenHotelId").val(id);

      $(this).closest('p').parent().find('.ponel').addClass('editHTL');
      $(this).closest('p').parent().find('.ptwol').addClass('editHTLS');
      $(this).closest('p').parent().find('.pfivel').addClass('editHTLS2');

      $("#editInputHotelGroup option[value="+groupId+"]").prop("selected", true);
      $('#editHotelModal').modal('show');
    });

    $(document).on("click", "#deleteBtnHotel", function(){
      $(this).addClass('delete_htl');
        $('#deleteHotelModal').modal('show');
    });

    $(document).on("click", ".delClsh", function(){
      $('.delete_htl').removeClass('delete_htl');
    });

    $(document).on("click", "#confirmHotelDelete", function(){

      var del_id = $('.delete_htl').attr('name');
      // console.log(del_id);
      var siteUrl = '<?= base_url('Main/delete_hotel') ?>';
      
      $.ajax({
          url: siteUrl,
          type: 'POST',
          data: {delId: del_id},
          dataType: 'json',
          success: function(response) {

            $('#deleteHotelModal').modal('hide');

            var name = $('.delete_htl').closest('p').parent().remove();

            $('.delete_htl').removeClass('delete_htl');
            
          },
          error: function(xhr, status, error) {
            // Handle error response
            $('#ajaxResponse').text('Error: ' + error);
          }
      });
    });

    $(document).on("click", "#editHideh", function(){
        
      $('.editHTL').removeClass('editHTL');
      $('.editHTLS').removeClass('editHTLS');
      $('.editHTLS2').removeClass('editHTLS2');
      
    });

    $(document).on('click', '#editConfirmHotelSubmit', function(){
        
      var siteUrl = '<?= base_url('Main/update_hotel') ?>';

      var name = $("#editInputHotelName").val();
      var id = $("#hiddenHotelId").val();
      var status = $("#editInputHotelStatus").val();
      var groupid = $("#editInputHotelGroup").val();
      var gpname = $("#editInputHotelGroup  option:selected").text();

      if(status == 1){
        var text = 'Active';
      } else {
        var text = '<span style="color:#f14c4c">Inactive</span>';
      }

      if(name.length < 1){
        $("#emailHelpHotel").show();
        return;
      }

      $(this).html('Loading...');
      $.ajax({
          url: siteUrl,
          type: 'POST',
          data: {hotel_name: name, status: status, id: id, groupid: groupid},
          dataType: 'json',
          success: function(response) {
            // Handle successful response
            $("#editConfirmHotelSubmit").html('Submit');
            
            if(response == 'error'){

            } else {
              $('#editHotelModal').modal('hide');
              $('.editHTL').html(name);
              $('.editHTLS').html(text);
              $('.editHTLS2').html(gpname);
              $('.editHTLS2').attr('name', groupid);
            }

            $('.editHTL').removeClass('editHTL');
            $('.editHTLS').removeClass('editHTLS');
            $('.editHTLS2').removeClass('editHTLS2');
            
          },
          error: function(xhr, status, error) {
            // Handle error response
            $('#ajaxResponse').text('Error: ' + error);
          }
      });
    });


</script>