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

</div>

<div class="container pt-5">

  <?php include 'submenu.php'; ?>




	

<form method="post" action="<?php echo base_url('Main/add_category') ?>">

  <div class="form-group">

    <label for="exampleInputEmail1"><strong>New Username</strong></label>

    <input type="text" class="form-control" name="category"  placeholder="Enter user name">

   

  </div>

<div class="form-group form-check">

  </div>

  <button type="submit" class="btn btn-primary">Add Username</button>

</form>



</div>




<div class="container pt-5">

   

  <table class="table table-striped"><thead style="

    background-color: cornflowerblue;

">

    <tr>

      <th scope="col">#</th>

      <th scope="col">Username</th>

      <th style="text-align: right; padding-right:40px" scope="col">Delete</th>

    </tr>

  </thead>

  <tbody>

<?php 
$i=1;
foreach ($cate as $key ) {?>

  <tr>

    <td><?php echo $i; ?></td>

     <td>

       <?php echo $key->category_name; ?>

     </td>

      <td style="text-align: right; padding-right:40px">  <a href="<?php echo base_url();?>Main/Delete_category/<?php echo $key->id;?>">Delete</a></td>

  </tr>

<?php $i++;}

 ?>



  </tbody>

</table>
<hr>
<form method="post" action="<?php echo base_url('Main/manager_category') ?>">

  <div class="form-group">

    <label for="exampleInputEmail1"><strong>Driver Name</strong></label>

   <select class="form-control" name="cate_id">
     <?php foreach ($cate  as $key ) {?>
       <option value="<?php echo $key->id; ?>"><?php echo $key->category_name; ?></option>
     <?php } ?>
   </select>

   

  </div>

   <div class="form-group">

    <label for="exampleInputEmail1"><strong>Account Username</strong></label>

    <select class="form-control" name="user_id">
     <?php foreach ($user  as $key ) { ?>
       <option value="<?php echo $key->id; ?>"><?php echo $key->username; ?></option>
     <?php } ?>
    </select>

   

  </div>

<div class="form-group form-check">

  </div>

  <button type="submit" class="btn btn-primary">Add Manager</button>

</form>

</div>
<div class="container pt-5" style="margin-bottom: 50px;">

   

  <table class="table table-striped"><thead style="background-color: cornflowerblue;">

    <tr>
      <th scope="col">#</th>
      <th scope="col">Account Username</th>
      <th scope="col">Driver Name</th>
      <th scope="col" style="text-align: right; padding-right:85px">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php 
  $i=1;
  $customTitle = '';
  foreach ($man as $key ) {?>

    <tr>
      <td><?php echo $i; ?></td>
      <td>
        <?php    $CI =& get_instance();
          $data = $CI->db->select('username')->where('id',$key->user_id)->get('users')->row(); 
          echo $data->username;
          $customTitle = $data->username;
        ?>
        
      </td>
      <td> <span class='userId' name="<?=$key->cate_id?>"><?php $CI =& get_instance();

      $data = $CI->db->select('category_name')->where('id',$key->cate_id)->get('category')->row(); 
      if(isset($data->category_name)){
        echo $data->category_name;
      }
      
      ?> </span></td>
      <td style="text-align: right; padding-right:40px">
        <button data-edittitle="<?=$customTitle?>" name="<?=$key->m_id; ?>" id="editManager" class="editMan btn btn-warning" type="button">Edit</button>
        <button name="<?=$key->m_id; ?>" id="deleteMan" class="editMan btn btn-danger" type="button">Delete</button>
      </td>
    </tr>

  <?php $i++;} ?>

  </tbody>
</table>
</div>

<!-- add group modal data-backdrop="static"-->
<div class="modal fade" id="editManagerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form method="post" action="<?php echo base_url('Main/manager_category_update') ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">Edit Manager</h3>
        <button type="button" class="close" data-dismiss="modal" id="payHide" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <p class="editTitle"></p>
            <input type="hidden" name="manager_id" id="hiddenmanid" value="">
          </div>
          <div class="form-group">
            <label for="inputGroupStatus">Category</label>
            <select class="form-control form-control-lg" id="cateName" name="cate_id">
              <?php foreach ($cate  as $key ) {?>
                <option value="<?php echo $key->id; ?>"><?php echo $key->category_name; ?></option>
              <?php } ?>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="confirmGroupSubmit" >Submit</button>
      </div>
    </div>
  </div>
  </form>
</div>

<!-- edit username modal data-backdrop="static"-->
<div class="modal fade" id="editcatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form method="post" action="<?php echo base_url('Main/category_update') ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">Edit Username</h3>
        <button type="button" class="close" data-dismiss="modal" id="payHide" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <p class="editTitle"></p>
            <input type="hidden" name="category_id" id="hidcate" value="">
          </div>
          <div class="form-group">
            <label for="inputGroupStatus">Username</label>
            <input type="text" name="user_name" id="user_name_id" value="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="" >Submit</button>
      </div>
    </div>
  </div>
  </form>
</div>

<!-- // delete hotel modal -->
<div class="modal fade" id="deleteManager" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form method="post" action="<?php echo base_url('Main/delete_manager') ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel">Delete Manager</h3>
        <button type="button" class="close delClsh" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">
          <div class="form-group">
            <h4>Are you sure want to delete?</h4>
            <input type="hidden" name="manager_id" id="manhide" value="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary delClsh" data-dismiss="modal" aria-label="Close" >No</button>
        <button type="submit" class="btn btn-danger" id="confirmDelete" >Yes</button>
      </div>
    </div>
  </div>
  </form>
</div>



<script type="text/javascript">
  $(document).on("click", "#editManager", function(){
      // console.log('clicked on add');
      var myCustom = $(this).data('edittitle');
      var manid = $(this).attr('name');
      $('.editTitle').html(myCustom);
      $('#hiddenmanid').val(manid);
      $('#editManagerModal').modal('show');
  });

  $(document).on("click", ".userId", function(){
      var catname = $(this).html();
      var catid = $(this).attr('name');
      $('#hidcate').val(catid);
      $('#user_name_id').val(catname);
      $('#editcatModal').modal('show');
  });

  $(document).on("click", "#deleteMan", function(){
      var manid = $(this).attr('name');
      $('#manhide').val(manid);
      $('#deleteManager').modal('show');
  });

    
</script>

<style>
  .editTitle{
    color: #ff4c4c;
    font-size: 28px;
    text-align: center;
  }
  .userId{
    cursor: pointer;
  }
</style>