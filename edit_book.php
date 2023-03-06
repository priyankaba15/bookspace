

<!DOCTYPE>
<?php
include("includes/db.php");
if(isset($_GET['edit_book'])){
  $get_id = $_GET['edit_book'];
  $get_pro = "select * from books where book_id = '$get_id'";
  $run_pro = mysqli_query($con, $get_pro);
  $i = 0;
  $row_pro = mysqli_fetch_array($run_pro);
    $book_id = $row_pro['book_id'];
    $book_title = $row_pro['book_title'];
    $book_image = $row_pro['image_path'];
    $book_price = $row_pro['price'];
    $book_desc = $row_pro['descr'];
    $book_author = $row_pro['author'];
    $book_cat = $row_pro['cat_id'];
    $book_quant = $row_pro['quant'];

    $get_cat = "select * from categories where cat_id = '$book_cat'";
    $run_cat = mysqli_query($con, $get_cat);
    $row_cat = mysqli_fetch_array($run_cat);
    $category_title = $row_cat['cat_title'];
}
?>

<html>
    <head>
        <title>Update Book</title>
        <script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>
        <script>tinymce.init({selector:'textarea'});

</script>

    </head>
<body bgcolor="white">


<form action="" method="post" enctype="multipart/form-data">

    <table align="center" width="95%" border="2" bgcolor="white">

        <tr align="center">
            <td colspan="8"><h2>Edit and Update Book</h2></td>
        </tr>

        <tr>
            <td align="right"><b>Book ID:</b></td>
            <td>
            <input type="text" name="book_id" value="<?php echo $book_id; ?>"/>
            </td>
        </tr>

        <tr>
            <td align="right"><b>Category:</b></td>
            <td>
                <select name="cat_id">
                    <option><?php echo $category_title; ?></option>
                    <?php

$get_cats="select * from categories";

$run_cats=mysqli_query($con,$get_cats);

while($row_cats=mysqli_fetch_array($run_cats)){
    $cat_id=$row_cats['cat_id'];
    $cat_title=$row_cats['cat_title'];

echo "<option value='$cat_id'>$cat_title</option>";
}



                    ?>
                    </select>
            </td>
        </tr>

        <tr>
            <td align="right"><b>Book Title:</b></td>
            <td><input type="text" name="book_title" value="<?php echo $book_title; ?>" /></td>
        </tr>

        <tr>
            <td align="right"><b>Author:</b></td>
            <td>
                <select name="author">
                    <option><?php echo $book_author; ?></option>
                    <?php

$get_authors="select * from authors";

$run_authors=mysqli_query($con,$get_authors);

while($row_authors=mysqli_fetch_array($run_authors)){
    $author_name=$row_authors['author_name'];
    $cat_id=$row_authors['cat_id'];

echo "<option>$author_name</option>";
}



                ?>
                </select>
            </td>
        </tr>



        <tr>
            <td align="right"><b>Description:</b></td>
            <td><textarea name="descr" cols="30" rows="20" ><?php echo $book_desc; ?></textarea></td>
        </tr>

        <tr>
            <td align="right"><b>Quantity:</b></td>
            <td><input type="text" name="quant"value="<?php echo $book_quant; ?>" /></td>
        </tr>

        <tr>
            <td align="right"><b>Price</b></td>
            <td><input type="text" name="price" value="<?php echo $book_price; ?>"/></td>
        </tr>

        <tr>
            <td align="right"><b>Book Image</b></td>
            <td><input type="file" name="image_path" /><img src="books_images/<?php echo $book_image; ?>" width="60" height="60" /></td>
        </tr>

        <tr align="center" >
            <td colspan="8" ><input type="submit" name="update_book" value="Update Book"/></td>
        </tr>

    </table>
</form>


</body>
</html>

<?php

    if(isset($_POST['update_book'])){
        $update_id = $book_id;
        $book_cat=$_POST['cat_id'];
        $book_title=$_POST['book_title'];
        $book_author=$_POST['author'];
        $book_desc=$_POST['descr'];
        $book_quant=$_POST['quant'];
        $book_price=$_POST['price'];

        $image_path=$_FILES['image_path']['name'];
        $image_path_tmp=$_FILES['image_path']['tmp_name'];

        move_uploaded_file($image_path_tmp,"books_images/$image_path");

        $update_book = "update books set book_id ='$book_id', cat_id = '$book_cat', book_title='$book_title', author='$book_author', descr = '$book_desc', quant = '$book_quant', price='$book_price', image_path='$image_path' where book_id = '$update_id' ";

        $update_bo=mysqli_query($con,$update_book);

        if($update_bo){

            echo"<script>alert('Book has been updated!')</script>";
            echo"<script>window.open('index.php?view_books','_self')</script>";
        }

    }

    ?>
