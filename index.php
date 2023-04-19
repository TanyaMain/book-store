<?php
    //include "Database/CreateTables.php";
    session_start();
    if(!isset($_SESSION['email_address']))
    {
        header("location:SignIn.php");
    }

    if(isset($_POST['submit']))
    {
        header("location:SignIn.php");


        unset($_SESSION['email_address']); 
        session_destroy(); 
    }

    if(isset($_POST['start_shopping']))
    {
        header("location:loadBookStore.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<footer>
        <p>&copy; Copyright 2022 - Softbyte Developers</p>
</footer>
</body>
</html>