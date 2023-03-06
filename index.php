<?php
session_start();
if(!isset($_SESSION['user_email'])){
  echo "<script>window.open('login.php?not_admin=You are not an Admin!', '_self')</script>";
}
else{


 ?>

<!DOCTYPE>
<html>
<head>
  <title>This is Admin Panel</title>
  <link rel="stylesheet" href="styles/styles.css" media="all" />
  
</head>

<body>
  <div class="main_wrapper">
    <div id="header"></div>
    <div id="right">
      <h2 style="text-align:center;"> Manage Content</h2>
      <a href="index.php?insert_book">Insert New Book</a>
      <a href="index.php?view_books">View All Books</a>
      <a href="index.php?insert_cat">Insert New Category</a>
      <a href="index.php?view_cats">View All Categories</a>
      <a href="index.php?insert_author">Insert New Author</a>
      <a href="index.php?view_authors">View All Authors</a>
      <a href="index.php?view_customers">View Customers</a>
      <a href="index.php?view_orders">View Orders</a>
      <a href="index.php?view_payments">View Payments</a>
      <a href="logout.php">Admin Logout </a>

    </div>
    <div id="left">
      <?php
      if(isset($_GET['insert_book'])){
        include("insert_books.php");
      }
      if(isset($_GET['view_books'])){
        include("view_books.php");
      }
      if(isset($_GET['edit_book'])){
        include("edit_book.php");
      }
      if(isset($_GET['insert_cat'])){
        include("insert_cat.php");
      }
      if(isset($_GET['view_cats'])){
        include("view_cats.php");
      }
      if(isset($_GET['edit_cat'])){
        include("edit_cat.php");
      }
      if(isset($_GET['insert_author'])){
        include("insert_author.php");
      }
      if(isset($_GET['view_authors'])){
        include("view_authors.php");
      }
      if(isset($_GET['edit_author'])){
        include("edit_author.php");
      }
      if(isset($_GET['view_customers'])){
        include("view_customers.php");
      }
       ?>
    </div>
  </div>
</body>
<?php } ?>
