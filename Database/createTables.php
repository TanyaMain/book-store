<?php

  include "dbconn.php";
//the User's Table
   $tbl_users = "CREATE TABLE `tblUsers` (
    `user_id` int(10) NOT NULL AUTO_INCREMENT,
    `first_name` varchar(50) NOT NULL,
    `last_name` varchar(50) NOT NULL,
    `student_number` varchar(20) NOT NULL,
    `email_address` varchar(50) NOT NULL,
    `password` varchar(100) NOT NULL,
    `user_type` varchar(10) NOT NULL DEFAULT 'user',
    `verification_status` bit(1) NOT NULL DEFAULT b'0',
    PRIMARY KEY (`user_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

//The textbook's table
$tbl_texbooks = "CREATE TABLE `tbltextbooks` (
    `book_id` int(10) NOT NULL AUTO_INCREMENT,
    `book_title` varchar(50) NOT NULL,
    `category` varchar(50) NOT NULL,
    `image` varchar(50) NOT NULL,
    `price` decimal(10,2) NOT NULL,
    `quantity` int(10) NOT NULL,
    PRIMARY KEY (`book_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

//The order's Textbooks
$tbl_orders = "CREATE TABLE `tblOrders` (
    `order_id` int(10) NOT NULL AUTO_INCREMENT,
    `user_id` int(10) NOT NULL,
    `order_date` date NOT NULL,
    PRIMARY KEY (`order_id`),
    CONSTRAINT `tblorders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tblusers` (`user_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

//The orders Tables
$tbl_order_books = "CREATE TABLE `tblOrderBooks` (
    `order_id` int(10) NOT NULL,
    `book_id` int(10) NOT NULL,
    `price` decimal(10,2) NOT NULL,
    `quantity` int(10) NOT NULL,
    PRIMARY KEY (`order_id`,`book_id`),
    CONSTRAINT `tblorderbooks_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `tbltextbooks` (`book_id`),
    CONSTRAINT `tblorderbooks_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `tblorders` (`order_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

      //Running the tables using the connection string
      $create_table_users = mysqli_query($connection,$tbl_users);
      $create_table_books = mysqli_query($connection,$tbl_texbooks);
      $create_table_order = mysqli_query($connection,$tbl_orders);
      $create_table_OD = mysqli_query($connection,$tbl_order_books);
     
     //This is to validate if the tables are present or not
      if($create_table_users && $create_table_books && $create_table_order &&  $create_table_OD)
      {
        //echo "<br>Tables in " .$database_name. " have been successfully created<br>";
      }
      else
      {
        //echo "<br>Tables already exist<br>";
      }

    //to check if there is data in the table of databases
    $query = "SELECT * FROM tblUsers";
    $result = mysqli_query($connection,$query);

		if (mysqli_num_rows($result) == 0) {

			//calling the method to load students
			loadStudents();

      //calling methods to load books
			loadBooks();
		}

    //method to load students
    function loadStudents()
    {
      global $connection;
      $file= fopen("Data Files/StudentData.txt", "r");

      while(!feof($file))
      {
        $content = fgets($file);
        $carry = explode (";", $content);
        list($name,$surname,$stNum,$email,$password) =$carry;
        $sql = "INSERT INTO tblusers(first_name, last_name, student_number, email_address, password) 
        VALUES ('$name','$surname','$stNum','$email','$password')";
        $connection -> query($sql);
      }

      fclose($file);
    }

    //method to load books into the database
    function loadBooks()
    {
      global $connection;
      $file= fopen("Data Files/BookData.txt", "r");

      while(!feof($file))
      {
        $content = fgets($file);
        $carry = explode (";", $content);
        list($book_title,$category,$image, $price,$quantity) =$carry;
        $sql = "INSERT INTO tbltextbooks(book_title,category,image, price, quantity) 
        VALUES ('$book_title','$category','$image','$price','$quantity')";
        $connection -> query($sql);
      }
      fclose($file);
    }

?>