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
        <a href="../index.php"><img id="logo" src="images/logo3.png"></a>
        <img id="banner" src="images/banner(1).jpg">

</div>

<div class="menubar">
    <ul id="menu">
        <li><a href="../index.php">Home</a></li>
        <li><a href="../all_products.php">All books</a></li>
        <li><a href="customer/my_account.php">My Account</a></li>
        <li><a href="../customer_login.php">Sign Up</a></li>
        <li><a href="../cart.php">Shopping Cart</a></li>
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
        <div id="sidebar_title">My Account:</div>
        <ul id="cats">
          <?php
          $user = $_SESSION['customer_email'];
          $get_img = "select * from customers where customer_email = '$user'";
          $run_img = mysqli_query($con,$get_img);
          $row_img = mysqli_fetch_array($run_img);
          $c_img = $row_img['customer_image'];
          $c_name = $row_img['customer_name'];
          echo "<p style = 'text-align:center;'><img src = 'customer_images/$c_img' width ='150' height='150'/></p>";

           ?>
          <li><a href="my_account.php?my_orders">My orders</a></li>
            <li><a href="my_account.php?edit_account">Edit Account</a></li>
              <li><a href="my_account.php?change_pass">Change Password</a></li>
                <li><a href="my_account.php?delete_account">Delete Account</a></li>
                <li><a href="logout.php">Logout</a></li>
        </ul>



    </div>
    <div id="content_area1">
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
           if(!isset($_SESSION['customer_email'])){
             echo "<a href='checkout.php' style='color:orange;'>Login</a>";
           }
           else{
             echo "<a href='logout.php' style='color:orange;'>Logout</a>";
           }

           ?>
          </span>
        </div>




        <div id="books_box">

          <?php
           if(!isset($_GET['my_orders'])){
             if(!isset($_GET['edit_account'])){
               if(!isset($_GET['change_pass'])){
                 if(!isset($_GET['delete_account'])){

        echo "
        <h2 style='padding:20px ;'>Welcome  $c_name  </h2>
        <b> You can see your orders progress by clicking this <a href='my_account.php?my_orders'>link</a></b>";
        }}}}
        ?>
        <?php
        if(isset($_GET['edit_account'])){
        include("edit_account.php");
        }
        if(isset($_GET['change_pass'])){
        include("change_pass.php");
        }
        if(isset($_GET['delete_account'])){
        include("delete_account.php");
        }
         ?>

        </div>
    </div>
</div>

<div id="footer">
    <h2 style="text-align:center; padding-top:30px;">&copy; 2022 by bookspace</h2>
</div>


</div>



</body>
</html>
