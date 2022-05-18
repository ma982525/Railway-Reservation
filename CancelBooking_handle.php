<?php
    require 'conn.php';

    $BId=$_POST['bookingId'];

    $stmt = $con->prepare("DELETE FROM bookings WHERE bookingId = ?") or die("Query error");
    $stmt->bind_param("i", $BId) or die("Binding error");

    if($stmt->execute()){
        $stmt->close();
        header("Location:bookingHistory.php");
    }
    else{
        echo "Error!!";
    }
?>