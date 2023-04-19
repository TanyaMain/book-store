<?php
    include '../Database/createTables.php';

    if(isset($_POST['add_book']))
    {
        //$book_title = $_POST['book_title'];
        //$book_category = $_POST['book_category'];
        //$book_price = $_POST['book_price'];

        echo $book_title = $_POST['book_title'];
        echo $book_category = $_POST['book_category'];
        echo $image_path = "image//default_1.jpg";
        echo $book_price = $_POST['book_price'];
        echo $quantity = 1;

        $query_5 = "INSERT INTO tbltextbooks (book_title, category, image, price, quantity) VALUES ('$book_title','$book_category','$image_path','$book_price','$quantity')";
        $insert_book = mysqli_query($connection,$query_5);
        if ($insert_book == false)
        {
            //echo mysqli_insert_error();
            echo $connection->error;
        }
        else
        {
            echo "Amen, it's running!!!";
            $_SESSION['message'] = "Product added!!!"; 
		    header('location: LibraryManagement.php');
        }


      
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Imperial Bookstore Admin | Add Book</title>
</head>
<body>
    <br>
    <form method="post">
        <input type="text" name = "book_title">
        <input type="text" name = "book_category">
        <input type="text" name = "book_price">

        <button type="submit" name="add_book">Add Book</button>
    </form>
</body>
</html>