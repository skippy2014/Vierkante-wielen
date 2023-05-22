<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $lessonDate = $_POST["lesson_date"];
    $lessonTime = $_POST["lesson_time"];
    $lessonAddress = $_POST["street_address"];
    $lessonPostcode = $_POST["postcode"];
    $lessonDate = $_POST["sesson_goal"];
    


    $sql = "INSERT INTO Lessons (first_name, last_name, lesson_date, lesson_time, street_address, postcode, sesson_goal ) VALUES ('$firstName', '$lastName', '$lessonDate', '$lessonTime', '$lessonAddress', '$lessonPostcode', '$lessonDate')";


    if ($conn->query($sql) === TRUE) {
        echo "Data added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>