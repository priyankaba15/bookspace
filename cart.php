<!DOCTYPE>
<?php
session_start();
include("functions/functions.php");
include("includes/db.php");



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




        <div id="books_box1">
            <form action="" method = "post" enctype="multipart/form-data">
              <table id="" allign = "center" width = "700" bgcolor = "white">

               <tr id="cols" align = "center">
                 <th>Remove</th>
                 <th> Book Title</th>
                 <th>Book</th>
                 <th>Quantity</th>
                 <th>Total Price</th>
               </tr>
               <?php
               $total = 0;
               global $con;
               $ip = getIp();
               $sel_price = "select * from cart where ip_addr = '$ip'";
               $run_price = mysqli_query($con, $sel_price);

               while($p_price = mysqli_fetch_array($run_price)){
                 $boo_book_id = $p_price['book_id'];

                 $boo_price = "select * from books where book_id ='$boo_book_id' ";
                 $run_boo_price = mysqli_query($con, $boo_price);

                 while($pp_price = mysqli_fetch_array($run_boo_price)){
                   $price = array( $pp_price['price']);
                   $book_title = $pp_price['book_title'];
                   $image_path = $pp_price['image_path'];
                   $single_price = $pp_price['price'];
                   $values = array_sum($price);
                   $total += $values;




               ?>
               <tr align = "center">
                 <td><input type ="checkbox" name = "remove[]" value="<?php echo $boo_book_id; ?>" /></td>
                 <td><?php echo $book_title; ?><br></td>
                <td>   <img src ="admin_area/books_images/<?php echo $image_path;?>" width="60" height="60"/></td>
                <td><input type = "text" size="4" name="qty" value="<?php echo $_SESSION['quant']; ?>" /></td>
                <?php
                   if(isset($_POST['update_cart'])){
                     $qty = $_POST['qty'];
                     $update_qty = "update cart set quant = '$qty'";
                     $run_qty = mysqli_query($con, $update_qty);
                     $_SESSION['quant'] = $qty;
                     $total = $total * $qty;
                   }
                 ?>
                <td><?php echo "Rs.".$single_price; ?></td>
               </tr>


             <?php }} ?>
             <tr align="right">
               <td colspan="8"><b><br>Sub Total:</b></td>
               <td ><br><?php echo "Rs.".$total;?></td><br>
             </tr>
             <tr align="center">
               <td colspan="3"><br><br><input type="submit" name="update_cart" value="Update Cart"/></td>
               <td><br><br><button><a href="index.php" style="text-decoration:none; color:black;">Continue Shopping</a></button></td>
               <td><br><br><button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></td>
             </tr>
             </table>
          </form>
          <?php
          function updatecart(){
            global $con;
            $ip = getIp();
             if(isset($_POST['update_cart'])){
               foreach ($_POST['remove'] as $remove_id) {
                 $delete_book = "delete from cart where book_id = '$remove_id' AND ip_addr='$ip'";
                 $run_delete = mysqli_query($con, $delete_book);
                 if($run_delete){
                   echo "<script>window.open('cart.php','_self')</script>";
                 }
               }
             }
             if(isset($_POST['continue'])){
               echo "<script>window.open('index.php','_self')</script>";
             }
             echo @$up_cart = updatecart();
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
