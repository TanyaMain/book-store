<?php
//include "Database/createTables.php";

    //require 'dbconn.php';

    //require 'header.php';
	include "Database/dbconn.php";
    session_start();
    $book_id=$_GET['id'];
    $user_id=$_SESSION['id'];
    $add_to_cart_query="insert into orders(user_id,book_id,status) values ('$user_id','$book_id','Added to cart')";
    $add_to_cart_result=mysqli_query($connection,$add_to_cart_query) or die(mysqli_error($connection));
   // header('location: products.php');
?>