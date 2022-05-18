<?php
require 'conn.php';
$message = "";
?>
<html>

<head>
    <title>Booking Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        $person = 0;



        ?>

        <!-- Navigation ends -->

        <!-- Details of Train start -->
    <form action="booking_Handle.php" method="POST" id="handlebook">
        <div class="container-fluid bg-warning p-5">
            <div class="row">
                <div class="col">
                    <h3>Booking Details</h3>
                </div>
            </div>
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

            </div>
        </div>

        <!-- Details of Train end -->

        <br>

        <!-- show Traveller start -->

        <div class="container" id="travellersDetails">

        </div>


        <!-- show Traveller end -->

        <!-- Add Traveller Start -->

        <h2 class="text-center my-3">Add Travellers</h2>
        <br>
        <div class="container bg-white p-4 rounded-3">
            <form method="POST" id="addForm" >
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="travellerName">Traveller Name</label>
                        <input type="text" name="travellerName" id="travellerName" class="form-control" placeholder="Enter Name" required>
                    </div>
                    <div class="col">
                        <label class="form-label" for="travellerAge">Traveller Age</label>
                        <input type="text" name="travellerAge" id="travellerAge" class="form-control" placeholder="Enter Age" required>
                    </div>
                    <div class="col">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" required>
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex mt-4">
                    <input class="btn btn-primary mx-2" name="save" id="save" value="Save">
                </div>

                <script>
                    var l = 0;
                    var travellersData = new Array();
                    function deleteTraveller(ind) {
                            console.log("in delete");
                            travellersData.splice(ind,1);
                            // delete travellersData[ind];
                            l = travellersData.length;
                            console.log(l);
                            $('#person').html("Total Person : " + l);
                            $('#pay').html("Total Amount to Pay : " + l * <?php echo ($endDist - $startDist) * 2; ?>);
                            $("#travellersDetails").html("");
                            travellersData.forEach(function(item) {
                                console.log(item);
                                $("#travellersDetails").append("<div class=\"bg-white p-4 my-2 rounded-3 d-flex\"><h4><b>Name:</b> " + item.Name + " | <b>Age:</b> " + item.Age + " | <b>Gender:</b> " + item.Gender + "</h4><div class=\" ms-auto \"><button class=\"btn btn-danger\" onclick=\"deleteTraveller(" + travellersData.indexOf(item) + ")\">X</button></div></div>");
                            });
                            return 0;
                        };


                    $(document).ready(function() {
                        $("#save").click(function(event) {
                            
                            console.log("Save Handle");
                            event.preventDefault();
                            var TName = document.getElementById("travellerName").value;
                            var TAge = document.getElementById("travellerAge").value;
                            var TGender = document.getElementById("gender").value;

                            console.log(TName);
                            console.log(TAge);
                            console.log(TGender);

                            if (travellersData.length == 6) {
                                alert("Max Limit Reached");
                                return 0;
                            }

                            travellersData.push({
                                Name: TName,
                                Age: TAge,
                                Gender: TGender
                            });
                            l = travellersData.length;
                            $('#person').html("Total Person : " + l);
                            $('#personField').val(l);
                            $('#pay').html("Total Amount to Pay : " + l * <?php echo ($endDist - $startDist) * 2; ?>);
                            $('#payField').val(l * <?php echo ($endDist - $startDist) * 2; ?>);


                            // $("#travellersDetails").append("<div class=\"bg-white p-4 my-2 rounded-3 d-flex\"><h4><b>Name:</b> "+TName+" | <b>Age:</b> "+TAge+" | <b>Gender:</b> "+TGender+"</h4><div class=\" ms-auto \"><button class=\"btn btn-danger\">X</button></div></div>");
                            $("#travellersDetails").html("");
                            travellersData.forEach(function(item) {
                                console.log(item);
                                $("#travellersDetails").append("<div class=\"bg-white p-4 my-2 rounded-3 d-flex\"><h5><b>Name:</b> " + item.Name + " | <b>Age:</b> " + item.Age + " | <b>Gender:</b> " + item.Gender + "</h5><div class=\" ms-auto \"><button class=\"btn btn-danger\" onclick=\"deleteTraveller(" + travellersData.indexOf(item) + ")\">X</button></div></div>");
                            });
                        })
                    });
                </script>


                <!-- Add Traveller End -->

                <!-- Fare Details Start -->

        </div>
        <h2 class="text-center my-4">Fare Details</h2>
        <br>
        <div class="container bg-white p-4 mb-5 rounded-4">
            <h5>Fare per traveller : Rs. <?php echo ($endDist - $startDist) * 2; ?></h5>
            <h5>Total Distance : <?php echo ($endDist - $startDist); ?> Km</h5>
            <h5>Cost per Km : Rs.2</h5>

            <br>
            <h5 id="person">Total Person : 0 </h5>
            <h5 id="pay">Total Amount to Pay : 0 </h5>
            
                <input type="hidden" value="<?php echo $TrainNo; ?>" name="TrNo">
                <input type="hidden" value="<?php echo $fromD; ?>" name="TrFrom">                
                <input type="hidden" value="<?php echo $toD; ?>" name="TrTo">
                <input type="hidden" value="<?php echo $Schedule; ?>" name="TrSchedule">
                <input type="hidden"  id="personField" value="0" name="TrTraveller">
                <input type="hidden" id="payField" value="0" name="TrPrice">                
                <input class="btn btn-outline-success my-2" type="submit" formaction="booking_Handle.php" value="Book Now">
            

        </div>
    </form>

        <!-- Fare Details Ends -->


    <?php

    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>