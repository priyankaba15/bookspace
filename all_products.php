<!DOCTYPE>
<?php

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
        <li><a href="customer/my_account.php">My Account</a></li>
        <li><a href="customer_register.php">Sign Up</a></li>
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

    $get_boo="select * from books ";

    $run_boo=mysqli_query($con,$get_boo);

    while($row_boo=mysqli_fetch_array($run_boo)){

        $boo_book_id=$row_boo['book_id'];
        $boo_cat_id=$row_boo['cat_id'];
        $boo_book_title=$row_boo['book_title'];
        $boo_author=$row_boo['author'];
        $boo_quant=$row_boo['quant'];
        $boo_price=$row_boo['price'];
        $boo_image_path=$row_boo['image_path'];

        echo"

        <div id='single_book'>
        <h3>$boo_book_title</h3>
        <img src='admin_area/books_images/$boo_image_path' width='180' height='180'/>
        <p><b>$boo_price<b></p>
        <a href='details.php? boo_book_id= $boo_book_id' style='float:left;'> Details </a>
        <a href='index.php?boo_book_id= $boo_book_id'><button style='float:right'>Add to Cart</button></a>
        </div>
        ";
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
