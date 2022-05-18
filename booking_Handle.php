<?php
    require 'conn.php';

    $TrNo=$_POST['TrNo'];
    $TrFrom=$_POST['TrFrom'];
    $TrTo=$_POST['TrTo'];
    $TrSchedule=$_POST['TrSchedule'];
    $TrPerson=$_POST['TrTraveller'];    
    $TrPrice=$_POST['TrPrice'];

    $stmt = $con->prepare("INSERT INTO bookings (UserId, FromSt, ToSt, DepartureDate, TrainNo, Travellers, TotalAmount) VALUES (?,?,?,?,?,?,?)") or die("Query error");
    $stmt->bind_param("issssii", $_SESSION['id'], $TrFrom, $TrTo, $TrSchedule, $TrNo, $TrPerson, $TrPrice) or die("Binding error");

    if($stmt->execute()){
        $stmt->close();
        ?>
        <script>alert("Booking Done");</script>
        <?php
        header("Location:bookingHistory.php");
    }
    else{
        echo "Error!!";
    }
?>