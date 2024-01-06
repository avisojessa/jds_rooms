<?php

error_reporting(0);
session_start();
include "conn.php";
if(!($_SESSION['username'] == "Admin")){
  echo '<script>window.location.href = "login.php";</script>';
  exit();
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

           <!-- Page Heading -->
           <h1 class="h3 mb-2 text-gray-800" align = "center">Contracts</h1>
           <!-- DataTales Example -->
           <div class="card shadow mb-4">
             <div class="card-body">
               <div class="table-responsive">
                 <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">

                   <tbody>
                     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
                       <tr>
                         <td>
                           <b><b>Please choose a tenant to change the contract information.</b></b>:
                         </td>
                         <td><select class='custom-select' name='tenant' id = 'values' style='width:200px;'>

                         </select>
                         <td>
                       </tr>
                     <tr>
                       <td>
                         Contract Duration:
                       </td>
                       <td>
                         <select class="custom-select" name="duration" style="width:300px;">
                           <option  value = "3">3 months</option>
                           <option value = "6">6 months</option>
                           <option value = "12">12 months</option>
                         </select>
                       </td>
                     </tr>
                     <tr>
                       <td>
                         Payment Terms:
                       </td>
                       <td>
                         <select class="custom-select" name="term" id="terms" style="width:300px;">
                         <option value = "1" id="1">1 term</option>
                         <option value = "2" id="2">2 terms</option>
                         <option value = "4" id="4">4 terms</option>
                         </select>
                       </td>
                     </tr>
                     <tr>
                     <td></td>
                     <td><input class='btn btn-success btn-user btn-lg' type='submit' name='submit' value='Edit'></td>
                     </form>
                     <tr>
                   </tbody>
                   <?php
                   if(isset($_POST["submit"])){
                     $id = $_POST['id'];
                     $room = (int)$_POST["room"];
                     $dur =  (int)$_POST['duration'];
                     $dur1 =  $dur - 1;
                     $term = (int)$_POST['term'];
                     $price = (int)$_POST['price'];
                     $stat = "Active";
                     $total_rent = $dur * $price;
                     $rent_term = $total_rent / $term;
                     $date_sign = date("Y-m-d H:i:s");
                     $contract = 'Occupied';
                     if(date('d')<27){
                       $end = date('Y-m-t', strtotime('+'.$dur1.' month'));
                     }else{
                       $end = date('Y-m-t', strtotime('+'.$dur1.' month'));
                     }
                     if((date('d')<27)){
                       $start = date('Y-m-01');
                     }else{
                       $start = date('Y-m-01', strtotime('+1 month'));
                     }


                     $query = "SELECT * FROM contract WHERE tenant_id = '$id' ";
                     $result = mysqli_query($con, $query);
                     $row = mysqli_fetch_assoc($result);
                     do{
                       $hid = $row['room_id'];

                       $row = mysqli_fetch_assoc($result);
                     }while ($row);

                     if($id != ""){
                       if ($dur == 3) {
                         if (!($term == 1)) {
                           echo "<script> alert('3 months cannot have more than 1 term.');</script>";
                         }else {
                           $sql = "UPDATE contract SET room_id = '$room', duration_month = '$dur', total_rent = '$total_rent', terms = '$term', rent_per_term = '$rent_term', start_day = '$start', end_day ='$end', date_contract_sign = '$date_sign' WHERE tenant_id = '$id' AND status = '$stat'";
                           if(mysqli_query($con, $sql)){
                             $sql1 = "UPDATE room SET status= 'Available' WHERE room_id = '$hid'";
                             mysqli_query($con, $sql1);
                             $sql3 = "UPDATE room SET status= '$contract' WHERE room_id = '$room'";
                             mysqli_query($con, $sql3);
                             mysqli_close($con);
                             echo "<script type='text/javascript'>alert('Updated Successfully!!!');</script>";
                             echo '<style>body{display:none;}</style>';
                             echo '<script>window.location.href = "contract_detail.php";</script>';
                             exit;
                         }
                       }
                       }elseif($dur == 6){
                           if ($term == 4) {
                             echo "<script type='text/javascript'>alert('6 months cannot have more than 2 term.');</script>";
                           }else {
                             $sql = "UPDATE contract SET room_id = '$room', duration_month = '$dur', total_rent = '$total_rent', terms = '$term', rent_per_term = '$rent_term', start_day = '$start', end_day ='$end', date_contract_sign = '$date_sign' WHERE tenant_id = '$id' AND status = '$stat'";
                             if(mysqli_query($con, $sql)){
                               $sql1 = "UPDATE room SET status= 'Available' WHERE room_id = '$hid'";
                               mysqli_query($con, $sql1);
                               $sql3 = "UPDATE room SET status= '$contract' WHERE room_id = '$room'";
                               mysqli_query($con, $sql3);
                               mysqli_close($con);
                               echo "<script type='text/javascript'>alert('Updated Successfully!!!');</script>";
                               echo '<style>body{display:none;}</style>';
                               echo '<script>window.location.href = "contract_detail.php";</script>';
                               exit;
                           }
                         }
                       }elseif ($dur == 12) {
                         $sql = "UPDATE contract SET room_id = '$room', duration_month = '$dur', total_rent = '$total_rent', terms = '$term', rent_per_term = '$rent_term', start_day = '$start', end_day ='$end', date_contract_sign = '$date_sign' WHERE tenant_id = '$id' AND status = '$stat'";
                         if(mysqli_query($con, $sql)){
                           $sql1 = "UPDATE room SET status= 'Available' WHERE room_id = '$hid'";
                           mysqli_query($con, $sql1);
                           $sql3 = "UPDATE room SET status= '$contract' WHERE room_id = '$room'";
                           mysqli_query($con, $sql3);
                           mysqli_close($con);
                           echo "<script type='text/javascript'>alert('Updated Successfully!!!');</script>";
                           echo '<style>body{display:none;}</style>';
                           echo '<script>window.location.href = "contract_detail.php";</script>';
                           exit;
                         }
                       }
                     }else {
                       echo "<script type='text/javascript'>alert('Please choose a contract to change from the table showing contract information.');</script>";
                       echo '<style>body{display:none;}</style>';
                       echo '<script>window.location.href = "contract_detail.php";</script>';
                       exit;

                     }





                 }
                    ?>
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

         var out = "<?php
         $sql = "SELECT * FROM contract WHERE status = 'Active'";
         $query = mysqli_query($con, $sql);
         $row = mysqli_fetch_assoc($query);
         do {
           $id = $row['tenant_id'];
           $sql1 = "SELECT * FROM tenant WHERE tenant_id = '$id'";
           $query1 = mysqli_query($con, $sql1);
           $row1 = mysqli_fetch_assoc($query1);
           do {
             $fanme = $row1['fname'];
             $lname = $row1['lname'];
             $row1 = mysqli_fetch_assoc($query1);
           } while ($row1);
           echo "<option value ='".$id."' selected>".$fname." ".$lname."</option>";
           $row = mysqli_fetch_assoc($query);
         } while ($row);


         ?>";
         document.getElementById("values").innerHTML = out;



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
   <script src="js/jquery.min.js"></script>

   <!-- Page level plugins -->
   <script src="vendor/datatables/jquery.dataTables.min.js"></script>
   <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

   <!-- Page level custom scripts -->
   <script src="js/demo/datatables-demo.js"></script>
   <?php include "includes/Alertfooter.php"?>
 </body>

 </html>
