<?php

    include "Database/createTables.php";
    $output = NULL;
    $errors  = array();
    $first_name = $last_name = $email_address = $student_number = $password =  $confirm_password = "";

    if(isset($_POST['submit']))
    {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $student_number = $_POST['student_number'];
        $email_address = $_POST['email_address'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        
        $php_pattern = '/^(?=.*[!@#$%^&*-?])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{4,20}$/';

        $query_2 = "SELECT * FROM tblUsers WHERE email_address = '$email_address'";
        $check_student_email = mysqli_query($connection,$query_2);

        $query_3 = "SELECT * FROM tblUsers WHERE student_number = '$student_number'";
        $check_student_student_number = mysqli_query($connection,$query_3);

        //Validation for empty fields
        if(empty($first_name) || empty($last_name) || empty($email_address) || empty($student_number)|| empty($password) || empty($confirm_password))
        {
            array_push($errors, "Fields where left empty, make sure all field are filled in!");
        }
        //Validation for an email address format
        elseif(filter_var($email_address, FILTER_VALIDATE_EMAIL) != true)
        {
            array_push($errors, "Your email address is invalid, please try again!");
        }
        //Validate if the email address entered is the same as any on database
        elseif(mysqli_num_rows($check_student_email) == 1)
        {
            array_push($errors,"You have already registed with this email!");
        }
        //Validate if the student number entered is the same as any on database
        elseif(mysqli_num_rows($check_student_student_number) == 1)
        {
            array_push($errors,"You have already registed with this student number!");
        }
        //Validate if the password and confirm password are the same
        elseif($password != $confirm_password)
        {
            array_push($errors,"Your passwords do not match");
        }
        //Validate if password is strong enough using preg_match
        elseif(!preg_match($php_pattern , $password))
		{
			array_push($errors,"Password is not strong enough");
		}
        //passed Validation process entry into the database
        else
        {
            $password = md5($password);
            $query_4 = "INSERT INTO tblUsers (first_name, last_name, student_number, email_address, password) 
            VALUES ('$first_name','$last_name','$student_number','$email_address','$password')";
            $insert_student = mysqli_query($connection,$query_4);
            if ($insert_student == true)
            {
                echo '<script>alert("Welcome to Imperial Bookstore, after clicking OK, please, Sign in")</script>';
                header("location:SignIn.php");	
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Imperial Bookstore | Sign Up</title>
    <link rel="stylesheet" href="CSS\Style.css">
</head>
<body>
    <img class = "logo" src="images\IMPERIAL.png" alt="lOGO">
    <form method="post">
        <h1 align = "center">Sign Up</h1><br>
        <?php include('errors.php'); ?><br>
    
        <input  type="text" placeholder = "Name" name = "first_name"><br>
        <input type="text"  placeholder = "Surname"  name = "last_name"><br>
        <input  type="text"  placeholder = "Student Number" name = "student_number"><br>
        <input  type="text"  placeholder = "Email Address" name = "email_address"><br>
        <input  type="password" placeholder = "Password" name = "password"><br>
        <input  type="password"  placeholder = "Confirm Password" name = "confirm_password"><br>
        <button type="submit"  name="submit">Sign In</button><br><br>

        <p align = "center">Already have an Account : Click here to <a href="SignIn.php">Login</a></p>
    </form>

    <footer>
        <p>&copy; Copyright 2022 - Softbyte Developers</p>
    </footer>
</body>

</html>