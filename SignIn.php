<?php
    include "Database/createTables.php";
    
   

    $email_address = $password = "";
    $errors = array();

    
    if(isset($_POST['submit']))
    {
        $email_address = $_POST['email_address'];
        $password = $_POST['password'];
		
        $_SESSION['email_address'] = $email_address;

        //Validate if both fields are empty
        if(empty($email_address) || empty($password))
        {
            array_push($errors, "Please ensure all filleds are entered!!!");
        }
         //Validate if any fields are empty
        elseif(empty($email_address) && empty($password))
        {
            array_push($errors, "Please ensure all filleds are entered!!!");
        }
        //Validate if email is has the right formate
        elseif(filter_var($email_address, FILTER_VALIDATE_EMAIL) != true)
        {
            $output = "Invalid Email address";
        }
        //Validate if the user is an admin
        else if($email_address== "admin@admin.com" && $password == "admin")
        {
                header('location: Admin/AdminPage.php');
        }
        // If all
        else if(count($errors) == 0)
        {
                $password = md5($password);
                $query_1 = "SELECT * FROM tblusers WHERE email_address = '$email_address' AND password = '$password'";
                $sign_in = mysqli_query($connection,$query_1);
                $record = mysqli_fetch_assoc($sign_in);

                if (empty($record))
                {
                    array_push($errors, "Incorrect Email Address\Password!!!");
                }
                elseif($record['email_address'] == $email_address && $record['password'] == $password && $record ['verification_status'] == '0')
                {	
                    array_push($errors, "Your Account has not been verified!!!"); 
					array_push($errors, "Please contact the Admin!!!");	
                }
                else if($record['email_address'] == $email_address && $record['password'] == $password)
                {	
                    header("location:Library.php");	
                }
                else
                {
                    array_push($errors, "Something is wrong!!!");
                }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Imperial Bookstore | Sign In</title>
    <link rel="stylesheet" href="CSS\Style.css">
    
</head>
<body>
    <img class = "logo" src="images\IMPERIAL.png" alt="lOGO">
    <center>
        <form action="" method="post">
            <h1>Sign In</h1><br>

            <?php include('errors.php'); ?><br>

           <input placeholder = "Email Address" type="text" name = "email_address" value = "<?php echo $email_address; ?>"><br>
           <input  placeholder = "Password" type="password" name = "password"><br>

            <button type="submit"  name="submit">Sign In</button><br>

       <p align = "center">Not yet a member? <a href="SignUp.php">Click here to register here !!!</a></p> 
    </form>
    </center>

    <footer>
        <p>&copy; Copyright 2022 - Softbyte Developers</p>
    </footer>
</body>
</html>