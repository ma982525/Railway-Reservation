<?php
require 'conn.php';
$message = "";
?>
<html>

<head>
    <title>Train Details</title>
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

        $fromD = $_GET["FromD"];
        $toD = $_GET["ToD"];
        $Schedule = $_GET["Schedule"];
        $Day = $_GET["day"];
        $TrainNo = $_GET["trainNo"];
        $startDist = $_GET["StartDist"]; 
        $endDist = $_GET["EndDist"];

        ?>

        <!-- Navigation ends -->

        <!-- Details of Train start -->

        <div class="container-fluid bg-warning p-5">
            <div class="row">
                <div class="col form-floating">
                    <h3 class="form-control" id="floatingFrom"><?php echo $fromD ?></h3>
                    <label for="floatingFrom" class="ms-2">From station</label>
                </div>
                <div class="col" style="width: 40px;flex:unset;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="100%" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z" />
                    </svg>
                </div>
                <div class="col form-floating">
                    <h3 class="form-control" id="floatingTo"> <?php echo $toD ?></h3>
                    <label for="floatingTo" class="ms-2">To station</label>
                </div>
                <div class="col form-floating">
                    <h3 class="form-control" id="floatingSchedule"> <?php echo $Schedule ?></h3>
                    <label for="floatingSchedule" class="ms-2">Departure Date</label>
                </div>
                <div class="col">
                    <form action="BookPage.php" class="mx-1">
                        <input type="hidden" name="trainNo" value="<?php echo $TrainNo; ?>">
                        <input type="hidden" name="FromD" value="<?php echo $fromD; ?>">
                        <input type="hidden" name="ToD" value="<?php echo $toD; ?>">
                        <input type="hidden" name="Schedule" value="<?php echo $Schedule; ?>">
                        <input type="hidden" name="day" value="<?php echo $Day; ?>">                                            
                        <input type="hidden" name="StartDist" value="<?php echo $startDist; ?>">                                            
                        <input type="hidden" name="EndDist" value="<?php echo $endDist; ?>">
                        <input type="submit" style="height:85% ;width:100%;" class="btn <?php if ($Schedule < date("Y-m-j")) {
                                                                                            echo "disabled btn-danger";
                                                                                        } else {
                                                                                            echo "bg-black text-white";
                                                                                        }; ?> " value="Book Ticket">
                    </form>
                </div>
            </div>
        </div>

        <!-- Details of Train end -->

        <br>

        <!-- Intermediate Stations Starts -->

        <h2 class="text-center my-3">Intermediate Stations</h2>
        <br>
        <div class="container">
            <table class="table table-dark table-striped fs-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Station</th>
                        <th scope="col">Distance Covered</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (isset($_SESSION["id"])) {
                        $result = mysqli_query($con, "SELECT StationName, DistanceCovered from stations where TrainNo='" . $TrainNo . "' and StationId BETWEEN (SELECT StationId from stations where TrainNo='" . $TrainNo . "' and StationName='" . $fromD . "') and (SELECT StationId from stations where TrainNo='" . $TrainNo . "' and StationName='" . $toD . "') ");
                        $cnt = 1;
                        if ($result) {
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                    ?>

                                    <tr>
                                        <th scope="row" ><?php echo $cnt; ?></th>
                                        <td><?php echo $row['StationName']; ?></td>
                                        <td><?php echo $row['DistanceCovered']-$startDist; ?></td>
                                    </tr>

                    <?php
                                    $cnt++;
                                }
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <!-- Intermediate Stations Ends -->


    <?php

    }
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>