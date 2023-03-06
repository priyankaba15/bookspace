<?php

if(!isset($_SESSION['user_email'])){
  echo "<script>window.open('login.php?not_admin=You are not an Admin!', '_self')</script>";
}
else{


 ?>
<?php
include("includes/db.php");
if(isset($_GET['edit_author'])){
  $author_name = $_GET['edit_author'];
  $get_author = "select * from authors where author_name='$author_name'";
  $run_author = mysqli_query($con, $get_author);
  $row_author = mysqli_fetch_array( $run_author);
  $author_name = $row_author['author_name'];
  $cat_id = $row_author['cat_id'];

}

 ?>


<form action="" method="post" style="padding:80px;">
  <b>Update Author:</b>
  <input type="text" name="new_author" value="<?php echo $author_name; ?>" />
  <input type="submit" name="update_author" value="Update Author" />
</form>
<?php

if(isset($_POST['update_author'])){
$update_id = $author_name;
$new_author = $_POST['new_author'];
$update_author = "update authors set author_name='$new_author' where author_name='$update_id'";
$run_author = mysqli_query($con, $update_author);
if($run_author){
  echo "<script>alert('Author updated!')</script>";
  echo "<script>window.open('index.php?view_authors','_self')</script>";
}
}
 ?>
<?php } ?>
