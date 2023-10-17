<style type="text/css">
  @import url('https://fonts.googleapis.com/css?family=Roboto&display=swap');
@import url('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

.intro{
   background: #fff;
   padding: 60px 30px;
   color: #333;
   margin-bottom: 15px;
   line-height: 1.5;
   text-align: center;
}
.intro h1 {
   font-size: 18pt;
   padding-bottom: 15px;

}
.intro p{
   font-size: 14px;
}

.action{
   text-align: center;
   display: block;
   margin-top: 20px;
}
/*
a.btn {
  text-decoration: none;
  color: #666;
   border: 2px solid #666;
   padding: 10px 15px;
   display: inline-block;
   margin-left: 5px;
}
a.btn:hover{
   background: #666;
   color: #fff;
    transition: .6s;
-webkit-transition: .6s;
}*/
.btn:before{
  font-family: FontAwesome;
  font-weight: normal;
  margin-right: 10px;
}
.github:before{content: "\f09b"}
.down:before{content: "\f019"}
.back:before{content:"\f112"}
.credit{
    background: #fff;
    padding: 12px;
    font-size: 9pt;
    text-align: center;
    color: #333;
    margin-top: 40px;

}
.credit span:before{
   font-family: FontAwesome;
   color: #e41b17;
   content: "\f004";


}
.credit a{
   color: #333;
   text-decoration: none;
}
.credit a:hover{
   color: #1DBF73; 
}
.credit a:hover:after{
    font-family: FontAwesome;
    content: "\f08e";
    font-size: 9pt;
    position: absolute;
    margin: 3px;
}
main{
  background: #fff;
  padding:: 20px;
  
}

article li{
   color: #444;
   font-size: 15px;
   margin-left: 33px;
   line-height: 1.5;
   padding: 5px;
}
article h1,
article h2,
article h3,
article h4,
article p{
   padding: 14px;
   color: #333;
}
article p{
   font-size: 15px;
    line-height: 1.5;
}
 
@media only screen and (min-width: 720px){
    main{
     /* max-width: 720px;*/
      margin-left: auto;
      margin-right: auto; 
      padding: 24px;
    }


}

.set-overlayer,
.set-glass,
.set-sticky {
  cursor: pointer;
  height: 45px;
  line-height: 45px;
  padding: 0 15px;
  color: #333;
  font-size: 16px;
}
.set-overlayer:after,
.set-glass:after,
.to-active:after,
.set-sticky:after {
  font-family: FontAwesome;
  font-size: 18pt;
  position: relative;
  float: right;
}
.set-overlayer:after,
.set-glass:after,
.set-sticky:after {
  content: "\f204";
  transition: .6s;
}

.to-active:after {
  content: "\f205";
  color: #008080;
  transition: .8s;
}
.set-overlayer,
.set-glass,
.set-sticky,
.source,
.theme-tray {
  margin: 10px;
  background: #f2f2f2;
  border-radius: 5px;
  border: 2px solid #f1f1f1;
  box-sizing: border-box;
}
/* Syntax Highlighter*/

pre.prettyprint {
  padding: 15px !important;
   margin: 10px;
  border: 0 !important;
  background: #f2f2f2;
  overflow: auto;
}

.source {
  white-space: pre;
  overflow: auto;
  max-height: 400px;
}
code{
    border:1px solid #ddd;
    padding: 2px;
    border-radius: 2px;
}
@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro);
@keyframes ticker {
  0%   {margin-top: 0}
  25%  {margin-top: -30px}
  50%  {margin-top: -60px}
  75%  {margin-top: -90px}
  100% {margin-top: 0}
}



.news {
  box-shadow: inset 0 -15px 30px rgba(0,0,0,0.4), 0 5px 10px rgba(0,0,0,0.5);
  width: 350px;
  /* height: 30px; */
  margin: 20px auto;
  overflow: hidden;
  border-radius: 4px;
  padding: 3px;
  -webkit-user-select: none
} 
.full-width{
    width: 100%;
}
.news span {
  float: left;
  color: #fff;
  padding: 6px;
  position: relative;
  top: 1%;
  border-radius: 4px;
  box-shadow: inset 0 -15px 30px rgba(0,0,0,0.4);
  font: 16px 'Source Sans Pro', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -webkit-user-select: none;
  cursor: pointer
}

table {
  font-size: 13px;
}

th,td {
  padding: 2px !important;
}

.news h4 {
  text-align: center;
  color: white;
  text-decoration: underline;
  margin-bottom: 30px;
}

.news ul {
  width: 100%;
  padding-left: 0px;
  /* animation: ticker 10s cubic-bezier(1, 0, .5, 0) infinite; */
  -webkit-user-select: none
}

.news ul li {    
  list-style: none;
  color: #a0ffc2;
  padding-left: 20px;
}

.news ul li a {
  color: #fff;
  text-decoration: none;
  font: 14px Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -webkit-user-select: none
}

.news ul:hover { animation-play-state: paused }
.news span:hover+ul { animation-play-state: paused }

/* OTHER COLORS */
.blue { background: #347fd0 }
.blue span { background: #2c66be }
.red { background: #d23435 }
.red span { background: #c22b2c }
.green { background: #699B67 }
.green span { background: #547d52 }
.magenta { background: #b63ace }
.magenta span { background: #842696 }

.yellow {background : yellow}
.yellow span {background : yellow}
</style>
<?php 

include 'header.php'; ?>

<div class="container pt-5">

	

  <a href="<?php echo base_url('Main/add_appionment') ?>"><button class="btn btn-danger">+ New Scdhule</button></a>

</div>

<div class="container pt-5">

    <?php if ($error=$this->session->flashdata('Appoint')) {?>

      <div class="row">

        <div class="col-lg-6">

          <div class="alert alert-Success">

            <?php echo $error;?>

          </div>

        </div>

      </div>

  <?php  } ?>
   <main>

     <div class="news red full-width">
  <h4>Tomorrow Rides</h4>
  <ul class="scrollLeft">
    
      <?php  foreach ($appoint_data as $key){ ?>
        
          <?php 
        $date1= date('d/m');
        $date2= date('d/m', strtotime($key->date));

        $date1 = date('d/m', strtotime('+1 day'));
        if ($date1== $date2) {  ?>


          
            <li>
<?php 
          $new_date_format = date('d/m H:i', strtotime($key->date));
          echo $new_date_format; ?>&nbsp;<?php echo $key->name.'&nbsp;';  
          $CI =& get_instance();
          // $data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row();
          echo $key->hotel_id ?>&nbsp;
          <?php $data = $CI->db->select('destiny')->where('id',$key->destiny_id)->get('destination')->row();
          echo $data->destiny;?>&nbsp;
          <?php echo $key->flight_details;?>&nbsp;
          <?php echo $key->number;?>


          </li>

        <?php }
    } ?>
    
  </ul>
</div>


 </main>

 <h4 style="color: red">Arrivals</h4>

	<table class="table">

  <thead>

    <tr>

      <th scope="col">#</th>

      <th scope="col">Date and Time</th>

      <th scope="col">From</th>

      <th scope="col">To</th>
        <th scope="col">Name</th>

     
      <th scope="col">F.Number</th>

      <th scope="col">Booking Number</th>
       <th scope="col">Price</th>
       <th scope="col">Pax</th>
       <th scope="col">Edit</th>

    </tr>

  </thead>

  <tbody>



   <?php 

$i=1;

   foreach ($appoint_data as $key) {?>



   

<tr>

   <td><?php echo $i; ?></td>

  <td>
    
    <?php 
$new_date_format = date('d/m H:i', strtotime($key->date));
  echo $new_date_format; ?>
  </td>

  <td>

    <?php   



     $CI =& get_instance();

      if (is_numeric($key->hotel_id)) {
          $data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row();
          echo $data->hotel_name;
      } else {
          echo $key->hotel_id;
      }


 ?>

  </td>

    <td> <?php   



     $CI =& get_instance();



$data = $CI->db->select('destiny')->where('id',$key->destiny_id)->get('destination')->row();



echo $data->destiny;



 ?></td>

 <td><?php echo $key->name; ?></td>
 <td><?php echo $key->flight_details; ?></td>
  <td><?php echo $key->number; ?></td>
  <td><?php echo $key->Price; ?></td>
  <td><?php echo $key->pax; ?></td>
<td><a href="<?php echo base_url();?>Main/edit_scdehule/<?php echo $key->id;?>">Edit</a></td>
</tr>





   <?php $i++; } ?>

  </tbody>

</table>

<h4 style="color: red">Departures</h4>

	<table class="table">

  <thead>

    <tr>

      <th scope="col">#</th>

      <th scope="col">Date and Time</th>

      <th scope="col">From</th>

      <th scope="col">To</th>
        <th scope="col">Name</th>

     
      <!-- <th scope="col">F.Number</th> -->

      <th scope="col">Booking Number</th>
       <th scope="col">Price</th>
       <th scope="col">Pax</th>
       <th scope="col">Edit</th>

    </tr>

  </thead>

  <tbody>



   <?php 

$i=1;

   foreach ($appoint_data as $key) {?>



   

<tr>

   <td><?php echo $i; ?></td>

  <td>
    
    <?php 
$new_date_format = date('d/m H:i', strtotime($key->date));
  echo $new_date_format; ?>
  </td>

  <td>

    <?php   



     $CI =& get_instance();

      if (is_numeric($key->hotel_id)) {
          $data = $CI->db->select('hotel_name')->where('id',$key->hotel_id)->get('hotel')->row();
          echo $data->hotel_name;
      } else {
          echo $key->hotel_id;
      }


 ?>

  </td>

    <td> <?php   



     $CI =& get_instance();



$data = $CI->db->select('destiny')->where('id',$key->destiny_id)->get('destination')->row();



echo $data->destiny;



 ?></td>

 <td><?php echo $key->name; ?></td>
  <td><?php echo $key->number; ?></td>
  <td><?php echo $key->Price; ?></td>
  <td><?php echo $key->pax; ?></td>
<td><a href="<?php echo base_url();?>Main/edit_scdehule/<?php echo $key->id;?>">Edit</a></td>
</tr>





   <?php $i++; } ?>

  </tbody>

</table>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script type="text/javascript">

        $('.alert').delay(1000).fadeOut('slow');

    </script>