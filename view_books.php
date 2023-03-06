<?php

if(!isset($_SESSION['user_email'])){
  echo "<script>window.open('login.php?not_admin=You are not an Admin!', '_self')</script>";
}
else{


 ?>

<table width="95%" align="center" bgcolor="white">
  <tr align="center">
    <td colspan="10"><h2>View All Books Here</h2><td>
  </tr>
  <tr align="center" bgcolor="lavender">
    <th>S.N</th>
    <th>Title</th>
    <th>Image</th>
    <th>Price</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
  <?php
  include("includes/db.php");
  $get_pro = "select * from books";
  $run_pro = mysqli_query($con, $get_pro);
  $i = 0;
  while($row_pro = mysqli_fetch_array($run_pro)){
    $book_id = $row_pro['book_id'];
    $book_title = $row_pro['book_title'];
    $book_image = $row_pro['image_path'];
    $book_price = $row_pro['price'];
    $i++;



   ?>
   <tr align="center">
     <td><?php echo $i; ?></td>
     <td><?php echo $book_title; ?></td>
     <td><img src="books_images/<?php echo $book_image; ?>" width="60" height="60"</td>
     <td><?php echo $book_price; ?></td>
     <td><a href="index.php?edit_book=<?php echo $book_id; ?>">Edit</a></td>
     <td><a href="delete_book.php?delete_book=<?php echo $book_id; ?>">Delete</a></td>



   </tr>
 <?php } ?>

</table>
<?php } ?>
