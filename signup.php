<?php
require 'conn.php';
$message = "";
if (count($_POST) > 0) {
    $result = mysqli_query($con, "SELECT * FROM users WHERE UserName='" . $_POST["user_name"] . "' and Password = '" . $_POST["password"] . "'");
    if ($result) {
        if ($result->num_rows > 0) {
?>
            <script>
                console.log("hi")
            </script>
<?php
            while ($row = $result->fetch_assoc()) {
                if ($row) {
                    $_SESSION["id"] = $row['Id'];
                    $_SESSION["name"] = $row['Name'];
                    header("Location:index.php");
                }
            }
        } else {
            $result2 = mysqli_query($con, "INSERT INTO users(Name, UserName, Password) VALUES ('" . $_POST["name"] . "','" . $_POST["user_name"] . "','" . $_POST["password"] . "') ");
            $result3 = mysqli_query($con, "SELECT * FROM users WHERE UserName='" . $_POST["user_name"] . "' and Password = '" . $_POST["password"] . "'");
            // $row1  = mysqli_fetch_array($result3);
            if ($result3) {
                if ($result3->num_rows > 0) {
                    while ($row1 = $result3->fetch_assoc()) {
                        if ($row1) {
                            $_SESSION["id"] = $row1['Id'];
                            $_SESSION["name"] = $row1['Name'];
                            header("Location:index.php");
                        }
                    }
                }
            }
        }
    }

    // $_SESSION["id"] = 1;
    // $_SESSION["name"] = 'admin';
}
if (isset($_SESSION["id"])) {
    header("Location:index.php");
}
?>
<html>

<head>
    <title>User Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body style="background:#efefef">
    <div class="container">
        <form name="frmUser" method="post" action="" class="mx-auto bg-white p-5" style="width:fit-content;border-radius:20px;margin-top:15%;box-shadow: 10px 15px 50px -20px gray;">
            <div class="message"><?php if ($message != "") {
                                        echo $message;
                                    } ?></div>
            <h3 class="text-center"><b>Signup</b></h3>

            Name:<br>
            <input type="text" name="name">
            <br>
            Username:<br>
            <input type="text" name="user_name">
            <br>
            Password:<br>
            <input type="password" name="password">
            <br><br>
            <button type="submit" class="btn btn-success" name="submit" value="Submit">Submit</button>
            <button class="btn btn-danger" type="reset">Reset</button>
        </form>
    </div>
    <p class="text-center">Click here to <a href="login.php">Login.</p>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>