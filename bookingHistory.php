<?php
require 'conn.php';
$message = "";
?>
<html>

<head>
    <title>Bookings History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body style="background:#efefef">
    <?php
    if (!isset($_SESSION['id']))
        echo "<div style=\"width:100vw;height:100vh;\" class=\"container text-center\"><h1>Please <a href=\"login.php\">login</a> first .</h1></div>";
    else {
    ?>

        <!-- Navigation starts -->
        <?php
        include 'common/navigation.php';
        ?>

        <!-- Navigation ends -->

        <!-- Booking History Start -->

        <h2 class="text-center mt-4 mb-2">Upcomming Bookings</h2>
        <br>
        <?php

        if (isset($_SESSION["id"])) {
            $result = mysqli_query($con, "SELECT * FROM bookings where UserId='" . $_SESSION['id'] . "' and DepartureDate >= CURRENT_DATE");
            $cnt = 0;
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $cnt++;
        ?>
                        <!-- Card View of booking Start -->
                        <div class="container my-2">
                            <div class="card" style="border-radius:10px">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div style="width:50% ;">
                                            <h5 class="card-title "><b>Train No: <?php echo $row['TrainNo'] ?></b></h5>
                                            <p class="card-text fs-3">
                                                <?php echo $row['FromSt'] . " 
                                                                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"100%\" fill=\"currentColor\" class=\"bi bi-arrow-left-right mx-3 text-primary\" viewBox=\"0 0 20 20\">
                                                                    <path fill-rule=\"evenodd\" d=\"M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z\" />
                                                                </svg>";
                                                echo $row['ToSt'];
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width:50%">
                                            <p class="my-2 text-black-50">Total Travellers : <?php echo $row['Travellers'] ?> </p>
                                            <p class="my-2 text-black-50">Departure Date: <?php echo $row['DepartureDate'] ?></p>
                                        </div>
                                        <div class="ms-auto me-5 d-flex">
                                            <form action="CancelBooking_handle.php" method="POST" class="mx-1">
                                                <input type="hidden" name="bookingId" value="<?php echo $row['bookingId']; ?>">
                                                <input type="submit" class="btn btn-outline-danger" value="Cancel Booking">
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Card View of Booking Ends -->

                <?php



                    }
                }
            }
            if ($cnt === 0) {
                ?>
                <div class="container my-5 text-center">
                    <h3><b>No Bookings Available right now!</b></h3>
                </div>

            <?php
            }
            ?>
    <?php
        }

        // Booking History end
    ?>

        <h2 class="text-center mt-4 mb-2">Past Bookings</h2>
        <br>
        <?php

        if (isset($_SESSION["id"])) {
            $result = mysqli_query($con, "SELECT * FROM bookings where UserId='" . $_SESSION['id'] . "' and DepartureDate < CURRENT_DATE");
            $cnt = 0;
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $cnt++;
        ?>
                        <!-- Card View of booking Start -->
                        <div class="container my-2">
                            <div class="card" style="border-radius:10px">
                                <div class="card-body">
                                    <div class="d-flex mb-3">
                                        <div style="width:50% ;">
                                            <h5 class="card-title "><b>Train No: <?php echo $row['TrainNo'] ?></b></h5>
                                            <p class="card-text fs-3">
                                                <?php echo $row['FromSt'] . " 
                                                                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"100%\" fill=\"currentColor\" class=\"bi bi-arrow-left-right mx-3 text-primary\" viewBox=\"0 0 20 20\">
                                                                    <path fill-rule=\"evenodd\" d=\"M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z\" />
                                                                </svg>";
                                                echo $row['ToSt'];
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width:50%">
                                            <p class="my-2 text-black-50">Total Travellers : <?php echo $row['Travellers'] ?> </p>
                                            <p class="my-2 text-black-50">Departure Date: <?php echo $row['DepartureDate'] ?></p>
                                        </div>
                                        <div class="ms-auto me-5 d-flex">
                                            <form action="#" class="mx-1">
                                                <input type="submit" class="btn btn-outline-secondary disabled" disabled value="Journey Completed">
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Card View of Booking Ends -->

                <?php



                    }
                }
            }
            if ($cnt === 0) {
                ?>
                <div class="container my-5 text-center">
                    <h3><b>No Past Bookings Available!</b></h3>
                </div>

            <?php
            }
            ?>
    <?php
        }

        // Booking History end
    }
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>