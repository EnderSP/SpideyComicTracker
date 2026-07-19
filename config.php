<?php
//etsbalishes variables to connectt o db
$host = 'localhost';// will get changed when published to cloud server
$user = 'root'// where the username to acess myswl is root on comp by default
$password =""// no passowrd for the DB( look into this)
$database ="web_db"// the name of the WebSlinger db to store all tables user comics and user read list

//define db connection object attempt to connect w/ defined vars
$conn = new mysqli( $host, $user,$password,$database);// connects to local mysql server using previously established keys

if($conn -> connect_error)
    {
        die("connection failed" . $conn->connect_error); //kills connection if there was an error and  throws that error message
    }
?>