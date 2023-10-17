
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

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
    
    .filterBox{
        width: 100%;
        height: auto;
    }
    .multiCheck{
        width: 100%;
        height: auto;
        margin-bottom: 20px;
    }
    .checkTitle{
        color: #ff7600;
        cursor: pointer;
        margin-top: 0px;
    }
    .checkBoxList{
        width: 100%;
        height: auto;
        overflow: hidden;
    }
    .parentDiv{
        border: 1px solid #ffc0c0;
        padding: 10px;
        border-radius: 7px;
        margin-bottom: 20px;
    }
    .textLabel{
        float: left;
        margin-top: 4px;
        font-weight: normal;
        margin-bottom: 0px;
        margin-right: 10px;
        color: #296668;
    }
    .checkBox{
        width: 20px;
        height: 20px;
        float: left;
        margin-right: 5px!important;
    }
    .driverDate{
        width: 100%;
        height: auto;
        margin-bottom: 30px;
        overflow: hidden;
    }
    .selectRange{
        float: left;
        width: 30%;
        min-width: 250px;
    }
    .selClass{
        width: 250px;
        height: 40px;
        border-radius: 4px;
        font-size: 18px;
    }
    .dateRange{
        width: 68%;
        float: right;
        overflow: hidden;
    }
    .submitValue{
        width: 100%;
        height: auto;
        overflow: hidden;
    }
    .filterValue{
        width: 100%;
        height: 60px;
        font-size: 30px !important;
        letter-spacing: 10px;
        background: linear-gradient(to right,#696de7, #a43fb1, #22b9ab) !important;
    }
    .custom_input_date{
        float: left;
        width: 49% !important;
        margin-right: 1%;
    }

    .customRow{
    width: 20%;
    float: left;
    font-size: 14px;
    }

    @media (max-width: 991px) {
      .selectRange{
        width: 100%;
        height: auto;
        overflow: hidden;
        margin-bottom: 10px;
        text-align: center;
        float: none;
      }
      .selClass{
        width: 300px;
      }
      .dateRange{
        float: none;
        width: 100%;
      }
    }

     @media (max-width: 767px) {
        .checkTitle {
            color: #ff7600;
            cursor: pointer;
            height: 40px;
        }
        .customRow{
            width: 50%;
            float: left;
            font-size: 12px;
        }
        .textLabel{
            margin: 0px;
            width: 130px;
            margin-top: 5px;
        }
     }

     .selDriveName {
        /* display: none; */
     }
     .dname {
        color: #129393;
     }
     .driveName {
        float: left;
        width: 30%;
        min-width: 250px;
        margin: 0px;
     }
    
</style>
<?php include 'header.php'; ?>


<?php
if (isset($_GET['indate']) && isset($_GET['outdate'])) {

  $fdate = $_GET['indate'];
  $Edate = $_GET['outdate'];

  if (isset($_GET['hotel'])) {
      $fhotel = $_GET['hotel'];
  } else {
      $fhotel = 'NULL';
      // var_dump($fhotel);die;
  }
  $fdriver = $_GET['driver'];

  $firstDay = $_GET['indate'];
  $curDay = $_GET['outdate'];
} else {
  $firstDay = date('Y-m-01');
  $curDay = date('Y-m-d');
}

$drivers_id = '';
if(isset($_GET['driver'])){
  $drivers_id = $_GET['driver'];
}

$hotels_id = array();
if(isset($_GET['hotel'])){
  $hotels_id = $_GET['hotel'];
}
// print_r($hotels_id);exit;

?>

<?php

if($customLoop == 'long'){
    $hotel_group_list = array_map('array_filter', $hotel_group_list);
    $hotel_group_list = array_filter($hotel_group_list);
} 

    // $hotel_group_list = array_map('array_filter', $hotel_group_list);
    // $hotel_group_list = array_filter($hotel_group_list);
    // echo '<pre>';print_r(array_filter($hotel_group_list));exit;

?>
<form method="get">
<div class="container pt-5">
    <div class="filterBox">
        <?php if($customLoop == 'longs'){ ?>
            <div class="multiCheck">
                <?php foreach($hotel_group_list as $groupTitle => $val){ if($val){  ?>
                <div class="parentDiv">
                    <h3 class="checkTitle"><?=$groupTitle?></h3>
                    <div class="checkBoxList">
                        <?php foreach ($val as $key2 => $value2) { if($value2){ foreach($value2 as $key3=> $hotelName){ ?>
                            <div class="customRow"><label>
                                <input type="checkbox" <?= in_array($hotelName->id, $hotels_id) ? 'checked' : '' ?> value="<?=$hotelName->id?>" name="hotel[]" class="checkBox">
                                <p class="textLabel"><?=$hotelName->hotel_name?></p>
                                </label>
                            </div>
                        <?php } } } ?>
                    </div>
                </div>
                <?php } } ?>
            </div>
        <?php } else { ?>
            <div class="multiCheck">
                <?php foreach($hotel_group_list as $groupTitle => $val){ if($val){ if($this->session->userdata('admin') == 0){ ?>
                <div class="parentDiv">
                    <h3 class="checkTitle"><?=$groupTitle?></h3>
                    <div class="checkBoxList">
                        <?php if($val){foreach($val as $hotelName){ ?>
                            <div class="customRow"><label>
                                <input type="checkbox" <?= in_array($hotelName->id, $hotels_id) ? 'checked' : '' ?> value="<?=$hotelName->id?>" name="hotel[]" class="checkBox">
                                <p class="textLabel"><?=$hotelName->hotel_name?></p>
                                </label>
                            </div>
                        <?php  } } ?>
                    </div>
                </div>
                <?php }else{ ?>
                <div class="parentDiv">
                    <h3 class="checkTitle owngroup" name="<?=$groupTitle == $own_driver->drive_name ? 'owngroup' : 'no' ?>"><?=$groupTitle?></h3>
                    <div class="checkBoxList">
                        <?php if($val){foreach($val as $hotelName){ ?>
                            <div class="customRow owngroup" name="<?=$groupTitle == $own_driver->drive_name ? 'owngroup' : 'no' ?>"><label>
                                <input type="checkbox" <?= in_array($hotelName->id, $hotels_id) ? 'checked' : '' ?> value="<?=$hotelName->id?>" name="hotel[]" class="checkBox">
                                <p class="textLabel"><?=$hotelName->hotel_name?></p>
                                </label>
                            </div>
                        <?php  } } ?>
                    </div>
                </div>
                <?php } } }?>
            </div>

        <?php } ?>
        
        <div class="driverDate">
            
            <?php
                if($this->session->userdata('admin') == 0){ ?>
                    <div class="selectRange" id="driver_name">
                        <select name="driver" class="selClass">
                            <option hidden value="-">Select Driver</option>
                            <?php foreach ($driver as $key) {?> <option value="<?php echo $key->id; ?>" <?= $key->id == $drivers_id ? 'selected': '' ?>><?php echo $key->drive_name; ?></option> <?php } ?>
                        </select>
                    </div>
                <?php } else { ?>
                    <h3 class="driveName">Driver Name : <span class="dname"><?=$own_driver->drive_name?></span></h3>
                    <input type="hidden" value="<?=$own_driver->id?>" name="driver" class="checkBox driveHideId">
                    <div class="selectRange selDriveName" id="driver_name">
                        <select name="driver" class="selClass">
                            <option hidden value="-">Select Driver</option>
                            <?php foreach ($driver as $key) {?> <option value="<?php echo $key->id; ?>" <?= $key->id == $drivers_id ? 'selected': '' ?>><?php echo $key->drive_name; ?></option> <?php } ?>
                        </select>
                    </div>
                <?php }
            ?>
            <div class="dateRange">
                <input type="date" name="indate" class="form-control custom_input_date"  value="<?=$firstDay?>">
 		        <input type="date" name="outdate" class="form-control custom_input_date" value="<?=$curDay?>">
            </div>
        </div>
        <div class="submitValue">
            <button type="submit" class="filterValue btn btn-primary">Filter</button>
        </div>
    </div>
</div>
</form>

<div class="container pt-5" style="margin-bottom:50px">
    <table class="table">
        <thead style="background-color: cornflowerblue; ">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date and Time</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Taxi</th>
            </tr>
        </thead>
        <tbody>

        <?php
        if (isset($fdate) && isset($Edate)) {

        $i = 1;
        $z = 0;

        foreach ($ride as $key) {
            
        if ($fhotel == 'NULL' && $fdriver == '-' && $key->date >= $fdate && $key->date <= $Edate) {

            if (empty($key->comision)) {
                $color = "red";
            } else {
                $color = '#738285';
            }
            ?>

            <tr >

                <td style="color:<?php echo $color; ?>;"> <?php echo $i; ?></td>

                <td style="color:<?php echo $color; ?>;">

                    <strong><?php
            $new_date_format = date('m.d ', strtotime($key->date));
            echo $new_date_format;
            ?></strong><br>

            <?php
            $new_date_format = date('h:i', strtotime($key->time));
            echo $key->time;
            ?>

            </td>

            <td style="color:<?php echo $color; ?>;">

            <?php
            $CI = & get_instance();

            $data = $CI->db->select('hotel_name')->where('id', $key->hotel_id)->get('hotel')->row();

            echo $data->hotel_name;

// echo $key->comision;
            ?>

            </td>

            <td style="color:<?php echo $color; ?>;"> <?php
            $CI = & get_instance();

            $data = $CI->db->select('destiny')->where('id', $key->dest_id)->get('destination')->row();

            echo $data->destiny;
            ?></td>



            <td style="color:<?php echo $color; ?>;">

                <?php
                $CI = & get_instance();

                $data = $CI->db->select('drive_name')->where('id', $key->driver_id)->get('driver')->row();

                echo $data->drive_name;
                ?>

            </td>

             <!-- <td><a href="<?php echo base_url(); ?>Main/edit_appoitment/<?php echo $key->id; ?>">Edit</a></td> -->

            </tr>
                <?php
                $CI = & get_instance();

                $where = array('hotel_id' => $key->hotel_id,
                    'dest_id' => $key->dest_id);

                $data = $CI->db->select('rate')->where($where)->get('comision')->row();
// var_dump($data);
//$result = array_filter($data['rate']);                 
                if (!empty($data)) {
                    $z += $data->rate;
                }

//$z+=$data;
                
            $i++;
        }
        if ($fhotel != 'NULL') {
            // code...

            foreach ($fhotel as $key2) {
                // code...

                if ($key->hotel_id == $key2 && $key->driver_id == $fdriver && $key->date >= $fdate && $key->date <= $Edate) {

                    if (empty($key->comision)) {
                        $color = "red";
                    } else {
                        $color = "#738285";
                    }
                    ?>

                    <tr >
                        <td style="color:<?php echo $color; ?>;"><?php echo $i; ?></td>

                        <td style="color:<?php echo $color; ?>;"> <?php echo $key->date; ?></td>

                        <td style="color:<?php echo $color; ?>;">

                    <?php
                    $CI = & get_instance();

                    $data = $CI->db->select('hotel_name')->where('id', $key->hotel_id)->get('hotel')->row();

                    echo $data->hotel_name;
                    ?>

                        </td>

                        <td style="color:<?php echo $color; ?>;"> <?php
                    $CI = & get_instance();

                    $data = $CI->db->select('destiny')->where('id', $key->dest_id)->get('destination')->row();

                    echo $data->destiny;
                    ?></td>

                    <td style="color:<?php echo $color; ?>;">

                    <?php
                    $CI = & get_instance();

                    $data = $CI->db->select('drive_name')->where('id', $key->driver_id)->get('driver')->row();

                    echo $data->drive_name;
                    ?>

                    </td>

         <!-- <td><a href="<?php echo base_url(); ?>Main/edit_appoitment/<?php echo $key->id; ?>">Edit</a></td> -->

                    </tr>
                    <?php
                    $CI = & get_instance();

                    $where = array('hotel_id' => $key->hotel_id,
                        'dest_id' => $key->dest_id);

                    $data = $CI->db->select('rate')->where($where)->get('comision')->row();
//$result = array_filter($data['rate']);                 
                    if (!empty($data)) {
                        $z += $data->rate;
                    }

                    ?>

                            <?php
                            $i++;
                        }
                    }
                }
                if ($fhotel == 'NULL' && $key->driver_id == $fdriver && $key->date >= $fdate && $key->date <= $Edate) {

                    if (empty($key->comision)) {
                        $color = "red";
                    } else {
                        $color = "#738285";
                    }
                    ?>

                        <tr >

                            <td style="color:<?php echo $color; ?>;"><?php echo $i; ?></td>

                            <td style="color:<?php echo $color; ?>;"><?php echo $key->date; ?></td>

                            <td style="color:<?php echo $color; ?>;">

                                <?php
                                $CI = & get_instance();

                                $data = $CI->db->select('hotel_name')->where('id', $key->hotel_id)->get('hotel')->row();

                                echo $data->hotel_name;
                                ?>

                            </td>

                            <td style="color:<?php echo $color; ?>;"> <?php
                                $CI = & get_instance();

                                $data = $CI->db->select('destiny')->where('id', $key->dest_id)->get('destination')->row();

                                echo $data->destiny;
                                ?></td>



                            <td style="color:<?php echo $color; ?>;">

                                <?php
                                $CI = & get_instance();

                                $data = $CI->db->select('drive_name')->where('id', $key->driver_id)->get('driver')->row();

                                echo $data->drive_name;
                                ?>

                            </td>

             <!-- <td><a href="<?php echo base_url(); ?>Main/edit_appoitment/<?php echo $key->id; ?>">Edit</a></td> -->

                        </tr>
                        <?php
                        $CI = & get_instance();

                        $where = array('hotel_id' => $key->hotel_id,
                            'dest_id' => $key->dest_id);

                        $data = $CI->db->select('rate')->where($where)->get('comision')->row();
//$result = array_filter($data['rate']);                 
                        if (!empty($data)) {
                            $z += $data->rate;
                        }

                        ?>

                        <?php
                        $i++;
                    }
                    if ($fhotel != 'NULL') {


                        foreach ($fhotel as $key2) {
                            // var_dump($key2);

                            if ($key->hotel_id == $key2 && $fdriver == '-' && $key->date >= $fdate && $key->date <= $Edate) {

                                if (empty($key->comision)) {
                                    $color = "red";
                                } else {
                                    $color = "#738285";
                                }
                                ?>

                                <tr >

                                    <td style="color:<?php echo $color; ?>;"><?php echo $i; ?></td>

                                    <td style="color:<?php echo $color; ?>;"><?php echo $key->date; ?>  <?php echo $key->time; ?></td>

                                    <td style="color:<?php echo $color; ?>;">

                    <?php
                    $CI = & get_instance();

                    $data = $CI->db->select('hotel_name')->where('id', $key->hotel_id)->get('hotel')->row();

                    echo $data->hotel_name;
                    ?>

                                    </td>

                                    <td style="color:<?php echo $color; ?>;"> <?php
                                        $CI = & get_instance();

                                        $data = $CI->db->select('destiny')->where('id', $key->dest_id)->get('destination')->row();

                                        echo $data->destiny;
                                        ?></td>

                                    <td style="color:<?php echo $color; ?>;">

                    <?php
                    $CI = & get_instance();

                    $data = $CI->db->select('drive_name')->where('id', $key->driver_id)->get('driver')->row();

                    echo $data->drive_name;
                    ?>
                                    </td>

                     <!-- <td><a href="<?php echo base_url(); ?>Main/edit_appoitment/<?php echo $key->id; ?>">Edit</a></td> -->

                                </tr>
                                        <?php
                                        $CI = & get_instance();

                                        $where = array('hotel_id' => $key->hotel_id,
                                            'dest_id' => $key->dest_id);

                                        $data = $CI->db->select('rate')->where($where)->get('comision')->row();
//$result = array_filter($data['rate']);                 
                                        if (!empty($data)) {
                                            $z += $data->rate;
                                        }
                                        ?>

                                        <?php
                                        $i++;
                                    }
                                }
                            }
                        }
                        ?>

            </tbody>

        </table>

        <!-- // modal for show hotel list -->


        <div>
            <span class="label btn-success">Commission: <?php echo '€' . $z;
                } ?></span>
    </div>

</div>

<style>

    .hotel_group_name {
        cursor: pointer;
        color: #31a931;
        width: 100%;
        height: auto;
        overflow: hidden;
    }
    .custom_check {
        height: 30px;
        width: 50%;
        float: left;
    }
    .custom_input {
        height: 20px;
        width: 20px;
        margin-right: 10px !important;
    }
    .custom_check label{
        display: block;
        padding-left: 30px;
        margin-top: 4px;
    }
    .modal-dialog{
        max-width: 100% !important;
    }

</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- Include Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script type="text/javascript">


    $(document).on("click", ".checkTitle", function () {
    

        if($(this).parent('div').find("input[type='checkbox']:checked").length > 0){
          $(this).parent('div').find("input[type='checkbox']").prop('checked', false);
        }else{
          // console.log('not checked');
          $(this).parent('div').find("input[type='checkbox']").prop('checked', true);
        }

    });

    $(document).ready(function(){
        $(".selDriveName").remove();
    });

    $(document).on('click', '.owngroup', function(){
        var name = $(this).attr('name');
        if(name == 'owngroup'){
            $('.driveName').hide();
            $('.driveHideId').remove();
            $(".selDriveName").remove();
            $('.driverDate').prepend('<div class="selectRange selDriveName" id="driver_name"><select name="driver" class="selClass"><option hidden value="-">Select Driver</option><?php foreach ($driver as $key) {?> <option value="<?php echo $key->id; ?>" <?= $key->id == $drivers_id ? "selected": "" ?>><?php echo $key->drive_name; ?></option> <?php } ?></select></div>');
        } else {
            $(".selDriveName").remove();
            $('.driveName').show();
            $('.driveHideId').remove();
            $('.driverDate').append('<input type="hidden" value="<?=$own_driver->id?>" name="driver" class="checkBox driveHideId">');
        }
        
    });


    $(".row_position").sortable({
        delay: 150,
        stop: function () {
            var selectedData = new Array();
            $(".row_position>tr").each(function () {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });

    function updateOrder(aData) {
        $.ajax({
            url: 'ajaxPost.php',
            type: 'POST',
            data: {
                allData: aData
            },
            success: function () {
                alert("Your change successfully saved");
            }
        });
    }
</script>