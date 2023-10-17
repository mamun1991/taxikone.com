

<h4 class="pt-4 ">
  <button class="btn btn-primary"><a style="color:white;" href="<?php echo base_url('Main/hotel_view') ?>" >Hotel</a></button>
  <button class="btn btn-success"><a style="color:white;" href="<?php echo base_url('Main/dest_view') ?>" >Destination</a></button>
  <button class="btn btn-warning"><a style="color:white;" href="<?php echo base_url('Main/drive_view') ?>" >Driver</a></button>
  <button class="btn btn-danger"><a style="color:white;" href="<?php echo base_url('Main/com_view') ?>" >Commission</a></button>
  <button class="btn btn-primary"><a style="color:white;" href="<?php echo base_url('Main/cate_page') ?>" >Add category</a></button>
  <button class="btn btn-success"><a style="color:white;" href="<?php echo base_url('Main/cate_hotel') ?>" >Add Hotel In Category</a></button>
  <button class="btn btn-warning"><a style="color:white;" href="<?php echo base_url('Main/show_cate_hotel') ?>" >Show  Hotel by Category</a></button>
    <?php
      if ($this->session->userdata('super_admin')==1){ ?>
        <button class="btn btn-danger"><a style="color:white;" href="<?php echo base_url('Main/admin_dashboard') ?>" >Admin Dashboard</a></button>
    <?php  }  ?>
</h4>