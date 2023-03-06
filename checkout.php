<!DOCTYPE>
<?php
session_start();
include("functions/functions.php");



?>
<html>
    <head>
        <title>Bookspace</title>
        <link rel="stylesheet" href="styles/styles.css" media="all" />
    </head>

<body>
<div class="main_wrapper">
    <div class="header_wrapper">
        <img id="logo" src="images/logo3.png">
        <img id="banner" src="images/banner(1).jpg">

</div>

<div class="menubar">
    <ul id="menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="all_products.php">All books</a></li>
        <li><a href="#">My Account</a></li>
        <li><a href="customer/my_account.php">Sign Up</a></li>
        <li><a href="cart.php">Shopping Cart</a></li>
        <li><a href="#">Contact Us</a></li>
    </ul>
    <div id="form">
        <form method="get" action="results.php" enctype="multipart/form-data">
            <input type="text" name="user_query" placeholder="Search a book"/>
            <input type="submit" name="search" value="Search" />
        </form>
    </div>
</div>


<div class="content_wrapper">
    <div id="sidebar">
        <div id="sidebar_title">Categories</div>
        <ul id="cats">
            <?php getCats(); ?>
        <ul>
        <div id="sidebar_title">Authors</div>
        <ul id="cats">
            <?php getauthors(); ?>

        <ul>
    </div>
    <div id="content_area">
        <?php cart(); ?>
        <div id="shopping_cart">
          <span style="float:right; font-size:18px; padding:5px; line-height :40px; color:#FF3D68;">
            <?php
            if(isset($_SESSION['customer_email'])){
              echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style ='color:black;'>   Your</b>";
            }
            else{
              echo "<b>Welcome Guest!</b>";
            }
             ?>
            <b style="color:black">Shopping Cart - </b>Total Items:<?php total_items();?> Total Price:<?php total_price();?> <a href="cart.php" style="color:black ">Go To Cart</a>
           <?php
           /*if(!isset($_SESSION['customer_email'])){
             echo "<a href='checkout.php' style='color:orange;'>Login</a>";
           }
           else{
             echo "<a href='logout.php' style='color:orange;'>Logout</a>";
           }*/

           ?>
          </span>
        </div>





          <?php
            if(!isset($_SESSION['customer_email'])){
              include("customer_login.php");
            }
            else{
              include("payment.php");
            }
           ?>


    </div>
</div>

<div id="footer">
    <h2 style="text-align:center; padding-top:30px;">&copy; 2022 by bookspace</h2>
</div>


</div>



</body>
</html>
