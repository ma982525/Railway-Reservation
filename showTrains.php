<?php
require 'conn.php';
$message = "";
?>
<html>

<head>
    <title>Show Trains</title>
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

        $week = ['Sun', 'Mon', 'Tue', 'Wed', 'Thr', 'Fri', 'Sat'];

        $fromD = $_GET["FromD"];
        $toD = $_GET["ToD"];
        $Schedule = $_GET["Schedule"];
        $Day = $week[$_GET["day"]];

        ?>

        <!-- Navigation ends -->

        <!-- Details of Train start -->

        <div class="container-fluid bg-warning p-5">
            <form style="width:fit-content" class="mx-auto" action="">
                <div class="row">
                    <div class="col form-floating">
                        <input name="FromD" class="form-control" id="floatingFrom" type="text" value="<?php echo $fromD ?>" required>
                        <label for="floatingFrom" class="ms-2">From station</label>
                    </div>
                    <div class="col" style="width: 40px;flex:unset;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="100%" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                    </div>
                    <div class="col form-floating">
                        <input name="ToD" class="form-control" type="text" id="floatingTo" value="<?php echo $toD ?>" required>
                        <label for="floatingTo" class="ms-2">To station</label>
                    </div>
                    <div class="col form-floating">
                        <input name="Schedule" class="form-control" type="date" id="floatingSchedule" onchange="dayChange();" onload="dayChange();" ontimeupdate="dayChange();" onsubmit="dayChange()" value="<?php echo $Schedule ?>" required>
                        <label for="floatingSchedule" class="ms-2">Departure Date</label>
                    </div>
                    <input type="hidden" name="day" id="day">
                    <script>
                        var date = document.getElementById('floatingSchedule').value;
                        date = new Date(date);
                        document.getElementById("day").value = date.getDay();

                        function dayChange() {
                            var date = document.getElementById('floatingSchedule').value;
                            date = new Date(date);
                            document.getElementById("day").value = date.getDay();
                            console.log(document.getElementById("day").value);
                        };
                    </script>
                    <div class="col">
                        <button class="btn bg-black text-white px-5 fs-5 pt-2" style="height:100%;" type="submit">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="80%" fill="currentColor" class="bi bi-search me-1 mb-1" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Details of Train end -->

        <br>
        <?php

        // echo $fromD . " -> " . $toD . " on " . $Schedule. " | Day is ". $Day;

        if (isset($_SESSION["id"])) {
            // $result1 = mysqli_query($con, "SELECT * FROM trains where FromPlace='" . $fromD . "' and ToPlace= '" . $toD . "' and Schedule= '" . $Day . "'");

            $result = mysqli_query($con, "SELECT s1.TrainNo,s1.DistanceCovered as s1Dist, s2.DistanceCovered as s2Dist FROM stations s1 INNER JOIN stations s2 on s1.TrainNo=s2.TrainNo where s1.StationName='" . $fromD . "' and s2.StationName='" . $toD . "' and s1.DistanceCovered < s2.DistanceCovered");
            $cnt = 0;
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $result2 = mysqli_query($con, "SELECT * FROM trains where TrainNo='" . $row['TrainNo'] . "' and Schedule= '" . $Day . "'");
                        if ($result2) {
                            if ($result2->num_rows > 0) {
                                while ($row2 = $result2->fetch_assoc()) {
                                    $cnt++;
        ?>

                                    <!-- Card View of Trains Start -->
                                    <div class="container my-2">
                                        <div class="card" style="border-radius:10px">
                                            <div class="card-body">
                                                <div class="d-flex mb-3">
                                                    <div style="width:50% ;">
                                                        <h5 class="card-title "><b><?php echo $row2['TrainNo'] . " ";
                                                                                    echo $row2['TrainName']; ?></b></h5>
                                                        <p class="card-text fs-3">
                                                            <?php echo $fromD . " 
                                                                <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"100%\" fill=\"currentColor\" class=\"bi bi-arrow-left-right mx-3 text-primary\" viewBox=\"0 0 20 20\">
                                                                    <path fill-rule=\"evenodd\" d=\"M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z\" />
                                                                </svg>";
                                                            echo $toD;
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <div class="d-flex ms-auto me-5">
                                                        <p class="rounded-circle <?php echo "Mon" == $row2['Schedule'] ? "bg-warning" : "bg-light" ?>  text-center ms-1" id="Mon" style="width: 25px;height:25px;">M</p>
                                                        <p class="rounded-circle <?php echo "Tue" == $row2['Schedule'] ? "bg-warning" : "bg-light" ?>  text-center ms-1" id="Tue" style="width: 25px;height:25px;">T</p>
                                                        <p class="rounded-circle <?php echo "Wed" == $row2['Schedule'] ? "bg-warning" : "bg-light" ?>  text-center ms-1" id="Wed" style="width: 25px;height:25px;">W</p>
                                                        <p class="rounded-circle <?php echo "Thr" == $row2['Schedule'] ? "bg-warning" : "bg-light" ?>  text-center ms-1" id="Thr" style="width: 25px;height:25px;">T</p>
                                                        <p class="rounded-circle <?php echo "Fri" == $row2['Schedule'] ? "bg-warning" : "bg-light" ?>  text-center ms-1" id="Fri" style="width: 25px;height:25px;">F</p>
                                                        <p class="rounded-circle <?php echo "Sat" == $row2['Schedule'] ? "bg-warning" : "bg-light" ?>  text-center ms-1" id="Sat" style="width: 25px;height:25px;">S</p>
                                                        <p class="rounded-circle <?php echo "Sun" == $row2['Schedule'] ? "bg-warning" : "bg-light" ?>  text-center ms-1" id="Sun" style="width: 25px;height:25px;">S</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div style="width:50%">
                                                        <p class="my-2 text-black-50">Total Distance : <?php echo $row['s2Dist'] - $row['s1Dist']; ?> Km</p>
                                                        <p class="my-2 text-black-50">Departure Date: <?php echo $Schedule ?></p>
                                                    </div>
                                                    <div class="ms-auto me-5 d-flex">
                                                        <form action="ViewDetails.php" class="mx-1">
                                                            <input type="hidden" name="trainNo" value="<?php echo $row2['TrainNo']; ?>">
                                                            <input type="hidden" name="FromD" value="<?php echo $fromD; ?>">                                                            
                                                            <input type="hidden" name="ToD" value="<?php echo $toD; ?>">
                                                            <input type="hidden" name="Schedule" value="<?php echo $Schedule; ?>">
                                                            <input type="hidden" name="day" value="<?php echo $Day; ?>">                                                            
                                                            <input type="hidden" name="StartDist" value="<?php echo $row['s1Dist']; ?>">                                            
                                                            <input type="hidden" name="EndDist" value="<?php echo $row['s2Dist']; ?>">
                                                            <input  type="submit" class="btn <?php if ($Schedule < date("Y-m-j")) {
                                                                                    echo "disabled btn-secondary";
                                                                                } else {
                                                                                    echo "btn-outline-primary";
                                                                                }; ?> " value="<?php if ($Schedule >= date("Y-m-j")) {
                                                                                            echo "View Details";
                                                                                        } else {
                                                                                            echo "Not Available";
                                                                                        }; ?>">
                                                        </form>
                                                        <form action="BookPage.php" class="mx-1">
                                                            <input type="hidden" name="trainNo" value="<?php echo $row2['TrainNo']; ?>">
                                                            <input type="hidden" name="FromD" value="<?php echo $fromD; ?>">                                                            
                                                            <input type="hidden" name="ToD" value="<?php echo $toD; ?>">
                                                            <input type="hidden" name="Schedule" value="<?php echo $Schedule; ?>">
                                                            <input type="hidden" name="day" value="<?php echo $Day; ?>">                                            
                                                            <input type="hidden" name="StartDist" value="<?php echo $row['s1Dist']; ?>">                                            
                                                            <input type="hidden" name="EndDist" value="<?php echo $row['s2Dist']; ?>">
                                                            <input type="submit" class="btn <?php if ($Schedule < date("Y-m-j")) {
                                                                                    echo "disabled btn-danger";
                                                                                } else {
                                                                                    echo "btn-outline-success";
                                                                                }; ?> " value="<?php if ($Schedule >= date("Y-m-j")) {
                                                                                            echo "Book Ticket";
                                                                                        } else {
                                                                                            echo "Not Available";
                                                                                        }; ?>">
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card View of Trains Ends -->

                <?php
                                }
                            }
                        }
                    }
                }
            }
            if ($cnt === 0) {
                ?>
                <div class="container my-5 text-center">
                    <h3><b>No Trains Available right now!</b></h3>
                </div>

            <?php
            }
            ?>

            <!-- Modal starts -->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Ends -->

            <!-- Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="logout.php" tite="Logout">Logout. -->
    <?php
        }
    }
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>