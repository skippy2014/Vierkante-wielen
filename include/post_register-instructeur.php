<?php
require_once 'db_connect.php';

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST ['phone']
$email = $_POST['email'];
$password = $_POST['password'];

$select = "select * from user WHERE email = '$email' ";

$result = mysql_query($con, $select);

if (mysqli_num_rows($result) > 0) {

    $error[] = 'email already exists';
}

else {
    
    $sql = "INSERT INTO users (first_name, last_name, email, password ) VALUES ('$firstname', '$lastname', '$email', '$password)";

    if (mysqli_query($conn, $sql)) {
        echo "user saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);