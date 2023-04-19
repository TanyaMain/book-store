<?php
    //connect to the Database
    include "../Database/dbconn.php";

    //Variables for the book
    $book_id = 0;
    $book_title = "";
	$book_category = "";
	$book_price = "";


    //display all textbooks avaliable
    $query_1 = "SELECT * FROM tbltextbooks";
    $get_textbooks = mysqli_query($connection, $query_1);


    //This is to delete a certain textbook, when delete button is created
    if (isset($_GET['delete'])) 
    {
        $book_id = $_GET['delete'];
        mysqli_query($connection, "DELETE FROM tbltextbooks WHERE book_id=$book_id");
        echo '<script>alert("Book Deleted!!!")</script>';
        header('location: LibraryManagement.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Imperial Bookstore Admin| Library Management</title>
    <link rel="stylesheet" href="..\CSS\Style.css">
</head>
<body>
    <div class = mini-body>
    <center><h1>Library Management</h1></center>
     <ul>
        <li><a href= "../Admin/AdminPage.php">Home</a></li>
        <li><a href="#">Library Management</a></li>
        <li><a href="../Admin/StudentManagement.php">Student Management</a></li>
        <li><a href="../SignIn.php">Logout</a></li>
    </ul>
    <center><h2>Avaliable books</h2><br></center>
    <table>
        <tr>
            <th><h3>Names of Book</h3></th>
            <th><h3>Price</h3></th>
            <th><h3>Action</h3></th>
        </tr>
        <tr>

        <!--PHP & HTML MEET!!!, This is to fecth the textbooks for the database-->
        <?php while ($row = mysqli_fetch_array($get_textbooks)) { ?>
			<tr>
				<td><?php echo $row['book_title']; ?></td>
				<td><?php echo "<b>R </b>".$row['price']; ?></td>
				<td>
					<button type="button"><a href="UpdateBook.php?edit=<?php echo $row['book_id']; ?>" >Edit</a></button>
				</td>
				<td>
					<button type="button"><a href="LibraryManagement.php?delete=<?php echo $row['book_id']; ?>">Delete</a></button>
				</td>
			</tr>
		<?php } ?>
        </tr>
    </table>

    <ul>
        <li><a href="../Admin/AddBook.php">Add Book</a></li>
    </ul>

    </div>
    <footer>
        <p>&copy; Copyright 2022 - Softbyte Developers</p>
    </footer>

</body>
</html>