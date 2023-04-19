<?php
//Parts of a connection
    $host  = 'localhost';
	$user = 'root';
	$password = '';
	$database_name = 'imperial_bookstore_database';

//This is the connection string
	$connection = mysqli_connect($host,$user,$password);

//check if connection is successful
    if (!$connection)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    else 
    {
        //echo "<br>Successfully connected to ".$database_name."<br>";
    }

//Get the database
    $select_database = mysqli_select_db($connection,$database_name);

//Check if the database exist. If it doesn't, a new one will be created
    if (!$select_database)
    {
		$sql1 = "CREATE DATABASE ".$database_name."";
		mysqli_query($connection, $sql1); 
		//echo "<br>Database ".$database_name." succesfully created<br>";
	} 
    else 
    {
	    //echo "<br>Database ".$database_name." already exsist<br>";
    }

//The connection string with the databse
    $connection = mysqli_connect($host,$user,$password,$database_name);
?>