<?php

if(!isset($_SESSION['user_email'])){
  echo "<script>window.open('login.php?not_admin=You are not an Admin!', '_self')</script>";
}
else{


 ?>

<table width="95%" align="center" bgcolor="white">
  <tr align="center">
    <td colspan="10"><br><h2>View All Authors Here</h2><br><td>
  </tr>
  <tr align="center" bgcolor="lavender">
    <th>Author Name</th>
    <th>Category ID</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
  <?php
  include("includes/db.php");
  $get_author = "select * from authors";
  $run_author = mysqli_query($con, $get_author);
  $i = 0;
  while($row_author = mysqli_fetch_array($run_author)){
    $author_name = $row_author['author_name'];
    $cat_id = $row_author['cat_id'];
    $i++;



   ?>
   <tr align="center">
     <td><?php echo $author_name; ?></td>
     <td><?php echo $cat_id; ?></td>
     <td><a href="index.php?edit_author=<?php echo $author_name; ?>">Edit</a></td>
     <td><a href="delete_author.php?delete_author=<?php echo $author_name; ?>">Delete</a></td>



   </tr>
 <?php } ?>

</table>
<?php } ?>
