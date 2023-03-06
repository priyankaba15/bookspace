<?php

if(!isset($_SESSION['user_email'])){
  echo "<script>window.open('login.php?not_admin=You are not an Admin!', '_self')</script>";
}
else{


 ?>

<form action="" method="post" style="padding:80px;">
  <h2 text-align:center><b>Insert New Author:</b></h2><br>
  <input type="text" name="new_author" value="Author Name"required />
  <input type="text" name="cat_id" value="Category_ID" required />

  <input type="submit" name="add_author" value="Add Author" />
</form>
<?php
include("includes/db.php");
if(isset($_POST['add_author'])){
$new_author = $_POST['new_author'];
$new_author_cat = $_POST['cat_id'];
$insert_author = "insert into authors (author_name, cat_id) values ('$new_author','$new_author_cat')";
$run_author = mysqli_query($con, $insert_author);
if($run_author){
  echo "<script>alert('New Author has been inserted!')</script>";
  echo "<script>window.open('index.php?view_authors','_self')</script>";
}
}
 ?>
<?php } ?>
