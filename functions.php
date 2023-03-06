<?php
$con=mysqli_connect("localhost","root","","bookspacedb");
if(mysqli_connect_errno())
{
    echo"Failed to connect to MySQL:".mysqli_connect_error();

}

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}

function cart(){

    if(isset($_GET['add_cart'])){
        global $con;
         $ip=getIp();
        $boo_book_id=$_GET['add_cart'];
        $check_boo="select * from cart where ip_addr='$ip' AND book_id='$boo_book_id'";
        $run_check=mysqli_query($con,$check_boo);
        if(mysqli_num_rows($run_check)>0){
            echo"";
        }
        else{
            $insert_boo="insert into cart(book_id,ip_addr) values ('$boo_book_id','$ip')";

            $run_boo=mysqli_query($con,$insert_boo);
            echo"<script>window.open('index.php','self')</script>";
        }
    }
}
function total_items(){
  if(isset($_GET['add_cart'])){
    global $con;
    $ip = getIp();
    $get_items = "select * from cart where ip_addr = '$ip'";
    $run_items = mysqli_query($con, $get_items);
    $count_items = mysqli_num_rows($run_items);

  }
  else{
    global $con;
    $ip = getIp();
    $get_items = "select * from cart where ip_addr = '$ip'";
    $run_items = mysqli_query($con, $get_items);
    $count_items = mysqli_num_rows($run_items);
  }
  echo $count_items;
}
function total_price(){
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
      $values = array_sum($price);
      $total += $values;
    }
  }
  echo"Rs". $total;
}

function getCats(){
    global $con;

    $get_cats="select * from categories";

    $run_cats=mysqli_query($con,$get_cats);

    while($row_cats=mysqli_fetch_array($run_cats)){
        $cat_id=$row_cats['cat_id'];
        $cat_title=$row_cats['cat_title'];

    echo "<li><a href='index.php? cat=$cat_id'>$cat_title</a></li>";
    }
}

function getauthors(){
    global $con;

    $get_authors="select * from authors";

    $run_authors=mysqli_query($con,$get_authors);

    while($row_authors=mysqli_fetch_array($run_authors)){
        $author_name=$row_authors['author_name'];
        $cat_id=$row_authors['cat_id'];

    echo "<li><a href='index.php? author=$cat_id'>$author_name</a></li>";
    }

}

function getboo(){

    if(!isset($_GET['cat'])){
        if(!isset($_GET['author'])){

    global $con;

    $get_boo="select * from books order by RAND() LIMIT 0,15";

    $run_boo=mysqli_query($con,$get_boo);

    while($row_boo=mysqli_fetch_array($run_boo)){

        $boo_book_id=$row_boo['book_id'];
        $boo_cat_id=$row_boo['cat_id'];
        $boo_book_title=$row_boo['book_title'];
        $boo_author=$row_boo['author'];
        $boo_quant=$row_boo['quant'];
        $boo_price=$row_boo['price'];
        $boo_image_path=$row_boo['image_path'];

        echo "

        <div id='single_book'>
        <img src='admin_area/books_images/$boo_image_path' width='180' height='180'/>
        <h3>$boo_book_title</h3>
        <p><b> Rs. $boo_price<b></p>
        <a href='details.php? boo_book_id= $boo_book_id' style='float:left; text-decoration:none;'> Details </a>
        <a href='index.php?add_cart= $boo_book_id'><button style='float:right'>Add to Cart</button></a>
        </div>
        ";
    }
}
}

}

function getcatboo(){

    if(isset($_GET['cat'])){

        $cat_id=$_GET['cat'];



    global $con;

    $get_cat_boo="select * from books where cat_id='$cat_id'";

    $run_cat_boo=mysqli_query($con,$get_cat_boo);

    $count_cats=mysqli_num_rows($run_cat_boo);

    if($count_cats==0){

        echo"<h2>No Books Available!</h2>";
    }





    while($row_cat_boo=mysqli_fetch_array($run_cat_boo)){

        $boo_book_id=$row_cat_boo['book_id'];
        $boo_cat_id=$row_cat_boo['cat_id'];
        $boo_book_title=$row_cat_boo['book_title'];
        $boo_author=$row_cat_boo['author'];
        $boo_quant=$row_cat_boo['quant'];
        $boo_price=$row_cat_boo['price'];
        $boo_image_path=$row_cat_boo['image_path'];


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

}
}



function getauthorboo(){

    if(isset($_GET['author'])){

        $cat_id=$_GET['author'];



    global $con;

    $get_author_boo="select * from books where cat_id='$cat_id'";

    $run_author_boo=mysqli_query($con,$get_author_boo);

    $count_authors=mysqli_num_rows($run_author_boo);

    if($count_authors==0){

        echo"<h2>No Books Available!</h2>";
    }





    while($row_author_boo=mysqli_fetch_array($run_author_boo)){

        $boo_book_id=$row_author_boo['book_id'];
        $boo_cat_id=$row_author_boo['cat_id'];
        $boo_book_title=$row_author_boo['book_title'];
        $boo_author=$row_author_boo['author'];
        $boo_quant=$row_author_boo['quant'];
        $boo_price=$row_author_boo['price'];
        $boo_image_path=$row_author_boo['image_path'];


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

}

}



?>
