<?php

if(!isset($_SESSION['user_email'])){
  echo "<script>window.open('login.php?not_admin=You are not an Admin!', '_self')</script>";
}
else{


 ?>

<?php
include("includes/db.php");
if(isset($_GET['delete_author'])){
  $delete_author_name = $_GET['delete_author'];
  $delete_author = "delete from authors where author_name = '$delete_author_name'";
  $run_delete = mysqli_query($con, $delete_author);
  if($run_delete){
    echo "<script>alert('An author deleted!')</script>";
    echo "<script>window.open('index.php?view_authors','_self')</script>";
  }
}

 ?>
<?php } ?>
