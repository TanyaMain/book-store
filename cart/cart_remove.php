<?php
    require 'dbconn.php';
	include "dbconn.php";
    session_start();
    $book_id=$_GET['id'];
    $user_id=$_SESSION['id'];
    $delete_query="delete from orders where user_id='$user_id' and book_id='$book_id'";
    $delete_query_result=mysqli_query($connection,$delete_query) or die(mysqli_error($connection));
    //header('location: cart.php');
?>