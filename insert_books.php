

<!DOCTYPE>
<?php
include("includes/db.php")

?>

<html>
    <head>
        <title>Inserting Books</title>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


<script>tinymce.init({selector:'textarea'});</script>

</script>

    </head>
<body bgcolor="mistyrose">


<form action="insert_books.php" method="post" enctype="multipart/form-data">

    <table align="center" width="80%" border="2" bgcolor="white" height="600">

        <tr align="center">
            <td colspan="8"><br><h2>Insert New Books Here</h2><br></td>
        </tr>
        <tr>
            <td align="right"><b>Book Title:</b></td>
            <td><input type="text" name="book_title" size="60" required /></td>
        </tr>


        <tr>
            <td align="right"><b>Category ID:</b></td>
            <td>
                <select name="cat_id">
                    <option>Select Category</option>
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
            <td align="right"><b>Author:</b></td>
            <td>
                <select name="author">
                    <option>Select Author</option>
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
            <td align="right"><b>Quantity:</b></td>
            <td><input type="text" name="quant" /></td>
        </tr>

        <tr>
            <td align="right"><b>Price:</b></td>
            <td><input type="text" name="price" required/></td>
        </tr>

        <tr>
            <td align="right"><b>Book Image:</b></td>
            <td><input type="file" name="book_image" required /></td>
        </tr>
        <tr>
            <td align="right"><b>Description:</b></td>
            <td><textarea name="descr" cols="50" rows="20" ></textarea></td>
        </tr>

        <tr align="center">
            <td colspan="8"><input type="submit" name="insert_post" value="Insert Now"/></td>
        </tr>

    </table>
</form>


</body>
</html>

<?php

    if(isset($_POST['insert_post'])){

        $book_id=$_POST['book_id'];
        $cat_id=$_POST['cat_id'];
        $book_title=$_POST['book_title'];
        $author=$_POST['author'];
        $descr=$_POST['descr'];
        $quant=$_POST['quant'];
        $price=$_POST['price'];

        $image_path=$_FILES['book_image']['name'];
        $image_path_tmp=$_FILES['book_image']['tmp_name'];

        move_uploaded_file($image_path_tmp,"books_images/$image_path");

        $insert_books="insert into books (cat_id,book_title,author,descr,quant,price,image_path) values ('$cat_id','$book_title','$author','$descr','$quant','$price','$image_path') ";

        $insert_bo=mysqli_query($con,$insert_books);

        if($insert_bo){

            echo"<script>alert('Book has been inserted!')</script>";
            echo"<script>window.open('insert_books.php','_self')</script>";
        }

    }

    ?>
