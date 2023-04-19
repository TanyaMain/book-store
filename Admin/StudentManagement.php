<?php
    include "../Database/createTables.php";
    $user_id = 0;

    //fetch or get Students from the Database
    $query_6 = "SELECT * FROM tblUsers WHERE verification_status = 0";
    $get_student = mysqli_query($connection, $query_6);

    if (isset($_GET['verify'])) {

		$user_id = $_GET['verify'];

        $query_7 = "UPDATE tblusers SET verification_status = 1 WHERE user_id = $user_id";
		mysqli_query($connection , $query_7);
        header("location:StudentManagement.php");	
	}

    $query_8 = "SELECT * FROM tblusers WHERE verification_status = '1'";
    $get_verified_students = mysqli_query($connection, $query_8);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Imperial Bookstore Admin |Student Management</title>
    <link rel="stylesheet" href="..\CSS\Style.css">
</head>
<body>
    <div>
        <center><h1>Student Management</h1></center> <br>
    <ul>
        <li><a href= "../Admin/AdminPage.php">Home</a></li>
        <li><a href="../Admin/LibraryManagement.php">Library Management</a></li>
        <li><a href="#">Student Management</a></li>
        <li><a href="../SignIn.php">Logout</a></li>
    </ul> <br>

   <center> <h2>Unverified Students</h2></center><br>

    <table>
        <tr>
            <td><h3>Name</h3></td>
			<td><h3>Surname</h3></td>
			<td><h3>Email</h3></td>
            <td><h3>Student Number</h3></td>
            <td><h3>Action</h3></td>
        </tr>
        <?php while ($record = mysqli_fetch_array($get_student)) { ?>
            <tr>
                <td><?php echo  $record ['first_name']; ?></td>
                <td><?php echo  $record ['last_name'];?></td>
                <td><?php echo  $record ['email_address'];?></td>
                <td><?php echo  $record ['student_number'];?></td>
                <td><button type="button"><a href="StudentManagement.php?verify=<?php echo $record ['user_id']; ?>" >Verifiy</a></button>
                <button type="button"><a href="StudentManagement?del=<?php echo $record ['user_id']; ?>">Delete</a></button></td>
            </tr>
            <?php } ?>
    </table>

    <center><h2>Verified Students</h2></center>
    <table>
        <tr>
            <td>Name</td>
		    <td>Surname</td>
		    <td>Email</td>
        </tr>

        <?php while ($record = mysqli_fetch_array($get_verified_students)) { ?>
        <tr>
            
            <td><?php echo $record ['first_name']; ?></td>
			<td><?php echo $record ['last_name'];?></td>
			<td><?php echo $record ['email_address'];?></td>
            <td><?php echo $record ['student_number'];?></td>
        </tr>
            <?php } ?>
    </table>
    </div>
    <footer>
        <p>&copy; Copyright 2022 - Softbyte Developers</p>
    </footer>
</body>
</html>