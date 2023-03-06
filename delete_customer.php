<?php

if(!isset($_SESSION['user_email'])){
  echo "<script>window.open('login.php?not_admin=You are not an Admin!', '_self')</script>";
}
else{


 ?>

<?php
include("includes/db.php");
if(isset($_GET['delete_customer'])){
  $delete_id = $_GET['delete_customer'];
  $delete_c = "delete from customers where customer_id = '$delete_id'";
  $run_delete = mysqli_query($con, $delete_c);
  if($run_delete){
    echo "<script>alert('A Customer deleted!')</script>";
    echo "<script>window.open('index.php?view_customers','_self')</script>";
  }
}

 ?>
<?php } ?>
