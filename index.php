<?php
require 'conn.php';
$message = "";
?>
<html>

<head>
    <title>Railway Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <?php
    if (!isset($_SESSION['name']))
        echo "<div style=\"width:100vw;height:100vh;\" class=\"container text-center\"><h1>Please <a href=\"login.php\">login</a> first .</h1></div>";
    else {
    ?>

        <!-- Navigation starts -->
        <?php 
            include 'common/navigation.php';
        ?>

        <!-- Navigation ends -->

        <!-- Search Trains starts -->

        <form name="frmUser" method="get" action="showTrains.php" class="mx-auto bg-white p-5" style="width:25%;border-radius:20px;margin-top:5%;box-shadow: 10px 15px 50px -20px gray;">
            <div class="message"><?php if ($message != "") {
                                        echo $message;
                                    } ?></div>
            <h3 class="text-center"><b>Search Trains</b></h3>

            From:<br>
            <input type="text" name="FromD" style="width:100%;" required>
            <br>
            To:<br>
            <input type="text" name="ToD" style="width:100%;" required>
            <br>
            Schedule:<br>
            <input type="date" name="Schedule" style="width:100%;" id='schedule' onchange="dayChange();" required>
            <input type="hidden" name="day" id="day">
            <script>
                function dayChange(){
                    var date=document.getElementById('schedule').value;
                    date = new Date(date);
                    document.getElementById("day").value = date.getDay();
                    console.log(document.getElementById("day").value);
                };
            </script>
            <br><br>
            <button type="submit" class="btn btn-success" name="submit" value="Submit" style="width:49%;">Check</button>
            <button class="btn btn-danger" type="reset" style="width:49%;">Reset</button>
        </form>

        <!-- Search Trains ends -->
        <?php
            if (isset($_SESSION["name"])) {
        ?>
            <p class="text-center">Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="logout.php" tite="Logout">Logout.</p>
        <?php
                }
            }
        ?>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>