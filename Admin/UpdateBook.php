<?php
 include '../Database/createTables.php';

 $book_id = 0;
    $book_title = "";
	$book_category = "";
	$book_price = "";

    //When the edit button is clicked on the Library Management Page
    if (isset($_GET['edit']))
    {
        $book_id = $_GET['edit'];
        $query_3 = "SELECT * FROM tbltextbooks WHERE book_id = $book_id";
        $record = mysqli_query($connection, $query_3);
        if (mysqli_num_rows($record) == 1 )
        {
            $n = mysqli_fetch_array($record);
            $book_title = $n['book_title'];
            $book_price = $n['price'];
        }
    }


    //update books....needs checking

    //This is when data is updated on the database.
    if (isset($_POST['update_book']))
    {
        $book_id = $_POST['book_id'];
        $book_title = $_POST['book_title'];
        $book_price = $_POST['book_price'];

        $query_3 = "UPDATE tbltextbooks SET price = '$book_price' WHERE book_id = $book_id";
        mysqli_query($connection, $query_3);
        echo '<script>alert("Book Updated!!!")</script>';
        header('location: LibraryManagement.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Imperial Bookstore Admin| Update Book</title>
</head>
<body>
    <br>
    <form method="post">

    <input type="text" placeholder="Enter Book name" name="book_title" value="<?php echo $book_title; ?>">
    <input type="text" placeholder="Enter Book Cartegory" name="book_category" value="<?php echo$book_category; ?>">
    <input type="text" placeholder="Enter Book Price" name="book_price" value="<?php echo $book_price; ?>">

    <button type="submit" name="update_book">Add Book</button>
    </form>
</body>
</html>