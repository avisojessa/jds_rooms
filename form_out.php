<?php

error_reporting(0);
session_start();
include "conn.php";
if(!($_SESSION['username'] == "Admin")){
  echo '<script>window.location.href = "login.php";</script>';
  exit();
}
function check($data){
  $data= trim($data);
  $data= htmlspecialchars($data);
  $data= stripslashes($data);
  return $data;
}

 ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>Rental Room Management System</title>
   <link rel="icon" href="img/jdslogo.png">

   <!-- Custom fonts for this template -->
   <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

   <!-- Custom styles for this template -->
   <link href="css/sb-admin-2.min.css" rel="stylesheet">

   <!-- Custom styles for this page -->
   <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

 </head>

 <style type="text/css">
.sidebar-dark #sidebarToggle {
    background-color: hsl(0deg 0% 13%);
}
  
 .sidebar-dark .nav-item .nav-link[data-toggle=collapse]::after{
    color:black;
 /* Notice we changed from white to the yellow */
}
</style>

<body id="page-top" style="background-color:pink;">
<?php  include 'admin_navbar.php'; ?>




           <ul class="navbar-nav ml-auto">


             <div class="topbar-divider d-none d-sm-block"></div>

             <!-- Nav Item - User Information -->
             <li class="nav-item dropdown no-arrow">
               <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php

                 include "conn.php";
                 $uname = $_SESSION['username'];
                 echo "<b><b>".$uname."</b></b>";

                   ?></span>
                 <img class="img-profile rounded-circle" src="user.png">
               </a>
               <!-- Dropdown - User Information -->
               <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

               <?php include "includes/Alertlogout.php"?>

             </li>

           </ul>

         </nav>
         <!-- End of Topbar -->

         <!-- Begin Page Content -->
         <div class="container-fluid">
           <h1 class="h3 mb-2 text-gray-800" align="center">Tenant-Out Room Condition</h1>
           <p style="color:red;"><b><b>Please fill the required information upon tenant leaving the Room.</b></b></p>

           <div class="card shadow mb-4">
             <div class="card-body">
               <div class="table-responsive">
                 <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">

                   <tbody>
                     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
                       <tr>
                         <td>
                           Search for a tenant:
                         </td>
                         <td>
                           <select class="custom-select" name="tenant" style="width:300px;" required>
                             <option value = "" disabled selected>Please choose...</option>
                             <?php
                             $query = "SELECT * FROM contract WHERE status = 'Inactive'";
                             $result = mysqli_query($con, $query);
                             $row1=mysqli_fetch_assoc($result);
                             do {
                               $tenant_id = $row1['tenant_id'];
                               $query2 = "SELECT * FROM tenant WHERE tenant_id = '$tenant_id'";
                               $result1 = mysqli_query($con, $query2);
                               $row=mysqli_fetch_assoc($result1);
                               do{
                                 $id = $row['tenant_id'];
                                 $fname = $row['fname'];
                                 $lname = $row['lname'];
                                 $uname = $row['u_name'];
                                 echo "<option value = '".$id."'>".$fname." ".$lname." (". $uname.")"."</option>";
                                 $row = mysqli_fetch_assoc($result1);
                               }while ($row);

                               $row1=mysqli_fetch_assoc($result);
                             } while ($row1);

                              ?>
                           </select>
                         </td>
                       </tr>

                     <tr>
                       <td>
                         Condition of the Key and its Holder:
                       </td>
                       <td>
                         <select class="custom-select" name="key" style="width:300px;" required>
                           <option value = "" disabled selected>Please choose...</option>
                           <option value = "Excellent">Excellent</option>
                           <option value = "Damaged">Damaged</option>
                           <option value = "Missing">Missing</option>
                           <option value = "No key holder">No key holder</option>
                         </select>
                       </td>
                     </tr>
                     <tr>
                       <td>
                         Condition of the Electricity Remote:
                       </td>
                       <td>
                         <select class="custom-select" name="remote" style="width:300px;" required>
                           <option value = "" disabled selected>Please choose...</option>
                           <option value = "Working">Working</option>
                           <option value = "Broken">Broken</option>
                           <option value = "Not Working">Not Working</option>
                           <option value = "No remote">No remote</option>
                         </select>
                       </td>
                     </tr>
                     <tr>
                       <td>
                         Number of bulbs:
                       </td>
                       <td>
                         <select class="custom-select" name="nbulb" style="width:300px;" required>
                           <option value = "" disabled selected>Please choose...</option>
                           <option value = "1">1</option>
                           <option value = "2">2</option>
                           <option value = "3">3</option>
                           <option value = "0">0</option>
                         </select>
                       </td>
                     </tr>
                     <tr>
                       <td>
                         Condition of the Bulbs:
                       </td>
                       <td>
                         <select class="custom-select" name="bulb" style="width:300px;" required>
                           <option value = "" disabled selected>Please choose...</option>
                           <option value = "Working">Working</option>
                           <option value = "Broken">Broken</option>
                           <option value = "Not Working">Not Working</option>
                           <option value = "Some missing">Some missing</option>
                         </select>
                       </td>
                     </tr>
                     <tr>
                       <td>
                         Condition of the paint on the wall:
                       </td>
                       <td>
                         <select class="custom-select" name="paint" style="width:300px;" required>
                           <option value = "" disabled selected>Please choose...</option>
                           <option value = "Excellent">Excellent</option>
                           <option value = "Good">Good</option>
                           <option value = "Fair">Fair</option>
                           <option value = "Poor">Poor</option>
                         </select>
                       </td>
                     </tr>
                     <tr>
                       <td>
                         Condition of the Windows:
                       </td>
                       <td>
                         <select class="custom-select" name="window" style="width:300px;" required>
                           <option value = "" disabled selected>Please choose...</option>
                           <option value = "Excellent">Excellent</option>
                           <option value = "Good">Good</option>
                           <option value = "Fair">Fair</option>
                           <option value = "Poor">Poor</option>
                           <option value = "Some broken or missing">Some broken or missing</option>
                         </select>
                       </td>
                     </tr>
                     <tr>
                       <td>
                         Condition of the Toilet Sink:
                       </td>
                       <td>
                         <select class="custom-select" name="tsink" style="width:300px;" required>
                           <option value = "" disabled selected>Please choose...</option>
                           <option value = "Functional">Functional</option>
                           <option value = "Leaking">Leaking</option>
                           <option value = "Damaged">Damaged</option>
                         </select>
                       </td>
                     </tr>
                     <tr>
                       <td>
                         Condition of the Normal Sink:
                       </td>
                       <td>
                         <select class="custom-select" name="wsink" style="width:300px;" required>
                           <option value = "" disabled selected>Please choose...</option>
                           <option value = "Excellent">Excellent</option>
                           <option value = "Good">Good</option>
                           <option value = "Fair">Fair</option>
                           <option value = "Poor">Poor</option>
                           <option value = "Damaged">Damaged</option>
                         </select>
                       </td>
                     </tr>
                     <tr>
                       <td>
                         Condition of the Door Lock:
                       </td>
                       <td>
                         <select class="custom-select" name="lock" style="width:300px;" required>
                           <option value = "" disabled selected>Please choose...</option>
                           <option value = "Excellent">Excellent</option>
                           <option value = "Good">Good</option>
                           <option value = "Fair">Fair</option>
                           <option value = "Poor">Poor</option>
                           <option value = "Damaged">Damaged</option>
                         </select>
                       </td>
                     </tr>
                     <tr>
                       <td>
                         Condition of the Toilet's Door Lock:
                       </td>
                       <td>
                         <select class="custom-select" name="tlock" style="width:300px;" required>
                           <option value = "" disabled selected>Please choose...</option>
                           <option value = "Excellent">Excellent</option>
                           <option value = "Good">Good</option>
                           <option value = "Fair">Fair</option>
                           <option value = "Poor">Poor</option>
                           <option value = "Damaged">Damaged</option>
                         </select>
                       </td>
                     </tr>
                     <tr>
                       <td>
                         <span style="color:red;"><b><b>Please outline in details the concerns pertaining the above  items.</b></b></span>
                         <br/>Comments:
                       </td>
                       <td>
                         <textarea class='form-control' name="msg"  required><?php echo @$msg; ?></textarea>
                       </td>
                     </tr>
                     <tr>
                     <td></td>
                     <td><input class='btn btn-success btn-user btn-lg' type='submit' name='submit' value='Submit'></td>
                     </form>
                     <tr>
                     <?php
                     if (isset($_POST['submit'])) {
                       $id = $_POST['tenant'];
                       $query1 = "SELECT * FROM contract WHERE tenant_id = '$id' AND status = 'Inactive'";
                       $result2 = mysqli_query($con, $query1);
                       $row1=mysqli_fetch_assoc($result2);
                       do{
                         $cid = $row1['contract_id'];
                         $row1 = mysqli_fetch_assoc($result2);
                       }while ($row1);
                       $h_key = $_POST['key'];
                       $remote = $_POST['remote'];
                       $nbulb = $_POST['nbulb'];
                       $bulb = $_POST['bulb'];
                       $paint = $_POST['paint'];
                       $window = $_POST['window'];
                       $tsink = $_POST['tsink'];
                       $wsink = $_POST['wsink'];
                       $lock = $_POST['lock'];
                       $tlock = $_POST['tlock'];

                       $msg = check($_POST['msg']);
                       $date = date('Y-m-d');


                       $query3 = "SELECT * FROM tenant_in WHERE contract_id = '$cid'";
                       $rs = mysqli_query($con, $query3);
                       if(mysqli_num_rows($rs) == 0){

                         $sql = "INSERT INTO tenant_out(`out_id`, `contract_id`, `stat_keyholder`, `stat_electricityRemote`, `no_bulbs`, `stat_bulbs`, `stat_paint`, `stat_Windows`, `stat_toiletSink`, `stat_washingSink`, `stat_doorLock`, `stat_toiletDoorLock`, `comments`, `date_reg`)
                         VALUES (' ','$cid','$h_key','$remote','$nbulb','$bulb','$paint','$window','$tsink','$wsink','$lock','$tlock','$msg','$date')";
                         mysqli_query($con, $sql);
                         mysqli_close($con);
                         echo "<script type='text/javascript'>alert('Your form has been submitted successfully');</script>";
                         echo '<style>body{display:none;}</style>';
                         echo '<script>window.location.href = "admin_home.php";</script>';


                       }else {
                         echo "<script type='text/javascript'>alert('You have already filled the form. Thank You.');</script>";
                         echo '<style>body{display:none;}</style>';
                         echo '<script>window.location.href = "admin_home.php";</script>';
                       }


                     }
                      ?>

                   </tbody>
                 </table>
               </div>
             </div>
           </div>
         </div>
         <!-- /.container-fluid -->

       </div>
       <!-- End of Main Content -->

       <!-- Footer -->
       
       <!-- End of Footer -->

     </div>
     <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->

   <!-- Scroll to Top Button-->
   <a class="scroll-to-top rounded" href="#page-top">
     <i class="fas fa-angle-up"></i>
   </a>

   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span>
           </button>
         </div>
         <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
         <div class="modal-footer">
           <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
           <a class="btn btn-success" href="logout.php">Logout</a>
         </div>
       </div>
     </div>
   </div>


   <script type="text/javascript">
       $(document).ready(function(){
           $("input[name='price']").click(function(){
               var radioValue = $("input[name='price']:checked").val();
               if(radioValue == 1800){
                 var out = "<?php  $con = mysqli_connect('localhost', 'root', '');
                   mysqli_select_db($con,'jds_rooms');
                   $sql="SELECT room_id,room_name FROM room WHERE rent_per_month = '1800' AND status = 'Available'";
                   $res = mysqli_query($con, $sql);
                   $row = mysqli_fetch_assoc($res);


                   if (mysqli_num_rows($res) > 0) {

                     do{

                       echo "<option value ='".$row["room_id"]."'>".$row["room_name"]."</option>";
                       $row = mysqli_fetch_assoc($res);
                     }while ($row);

                   }else {

                     echo "<option selected disabled>No rooms available</option>";

                   }


   ?>";
                 document.getElementById("values").innerHTML = out;

               }else if (radioValue == 2000) {
                   var out = "<?php  $con = mysqli_connect('localhost', 'root', '');
                     mysqli_select_db($con,'jds_rooms');
                     $sql="SELECT room_id,room_name FROM room WHERE rent_per_month = '2000' AND status = 'Available'";
                     $res = mysqli_query($con, $sql);
                     $row = mysqli_fetch_assoc($res);
                     if (mysqli_num_rows($res) > 0) {

                       do{

                         echo "<option value ='".$row["room_id"]."' selected>".$row["room_name"]."</option>";
                         $row = mysqli_fetch_assoc($res);
                       }while ($row);

                     }else {

                       echo "<option selected disabled>No rooms available</option>";

                     }

                     ?>";
                   document.getElementById("values").innerHTML = out;
               }else if (radioValue == 2500) {
                   var out = "<?php  $con = mysqli_connect('localhost', 'root', '');
                     mysqli_select_db($con,'jds_rooms');
                     $sql="SELECT room_id,room_name FROM room WHERE rent_per_month = '2500' AND status = 'Available'";
                     $res = mysqli_query($con, $sql);
                     $row = mysqli_fetch_assoc($res);

                     if (mysqli_num_rows($res) > 0) {

                       do{

                         echo "<option value ='".$row["room_id"]."'>".$row["room_name"]."</option>";
                         $row = mysqli_fetch_assoc($res);
                       }while ($row);

                     }else {

                       echo "<option selected disabled>No rooms available</option>";

                     }

     ?>";
                   document.getElementById("values").innerHTML = out;
               }else {
                   var out = "<?php  $con = mysqli_connect('localhost', 'root', '');
                     mysqli_select_db($con,'jds_rooms');
                     $sql="SELECT room_id,room_name FROM room WHERE rent_per_month = '3000' AND status = 'Available'";
                     $res = mysqli_query($con, $sql);
                     $row = mysqli_fetch_assoc($res);

                     if (mysqli_num_rows($res) > 0) {

                       do{

                         echo "<option value ='".$row["room_id"]."'>".$row["room_name"]."</option>";
                         $row = mysqli_fetch_assoc($res);
                       }while ($row);

                     }else {

                       echo "<option selected disabled>No rooms available</option>";

                     }

     ?>";
                   document.getElementById("values").innerHTML = out;
               }
           });

       });
   </script>

   <script>
     if ( window.history.replaceState ) {
       window.history.replaceState( null, null, window.location.href );
     }
   </script>


   <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>
   <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

   <!-- Core plugin JavaScript-->
   <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

   <!-- Custom scripts for all pages-->
   <script src="js/sb-admin-2.min.js"></script>

   <!-- Page level plugins -->
   <script src="vendor/datatables/jquery.dataTables.min.js"></script>
   <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

   <!-- Page level custom scripts -->
   <script src="js/demo/datatables-demo.js"></script>
   <?php include "includes/Alertfooter.php"?>
 </body>

 </html>
