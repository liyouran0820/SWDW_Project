<?php
session_start();
include "connection_bcrab.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SESSION["username"])) {
        echo "<script>
            alert('Please login first.');
            window.location.href = 'login.php';
            </script>";
        exit();
    } else {

        $calendar = $_POST["calendar"];
        $fan = $_POST["fan"];
        $mugs = $_POST["mugs"];
        $umbrella = $_POST["umbrella"];
        $username = $_SESSION["username"];

        $sql1 = "UPDATE purchase 
                SET quantity = quantity + $calendar 
                WHERE itemN = 'calendar'";

        $sql2 = "UPDATE purchase 
                SET quantity = quantity + $fan 
                WHERE itemN = 'fan'";

        $sql3 = "UPDATE purchase 
                SET quantity = quantity + $mugs 
                WHERE itemN = 'mugs'";

        $sql4 = "UPDATE purchase 
                SET quantity = quantity + $umbrella 
                WHERE itemN = 'umbrella'";

        $sql5 = "UPDATE members 
                SET calendar = calendar + $calendar,
                    fan = fan + $fan,
                    mugs = mugs + $mugs,
                    umbrella = umbrella + $umbrella
                WHERE username = '$username'";

        if (
            $conn->query($sql1) === TRUE &&
            $conn->query($sql2) === TRUE &&
            $conn->query($sql3) === TRUE &&
            $conn->query($sql4) === TRUE &&
            $conn->query($sql5) === TRUE
        ) {
            $message = "Purchase submitted successfully.";
        } else {
            $message = "Purchase failed: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Neces</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php
    if ($message != "") {
        echo "<script>alert('$message');</script>";
    }
    ?>

    <div>
        <nav>
            <h1 id="pageTitle">Necessities</h1>
            <ul>
                <li><a href="login.php">Login/Register</a></li>
                <li><a href="clothes.php">Clothes</a></li>
                <li><a href="neces.php">Necessities</a></li>
                <li><a href="orna.php">Ornaments</a></li>
                <li id="loginStatus">
                    <?php
                    if (isset($_SESSION["username"])) {
                        echo "User: " . $_SESSION["username"];
                        echo '<li><a href="logout.php">Logout</a></li>';
                    } else {
                        echo "Not logged in";
                    }
                    ?>
                </li>
            </ul>
        </nav>

        <div id="outline">
            <form action="neces.php" method="POST">

                <table id="imgTable">
                    <tr>
                        <td><img src="images/neces/calendar.png"></td>
                        <td>calendar<br>Unit Price: 20</td>
                        <td>
                            Quantity (0 to 9):
                            <input name="calendar" type="number" min="0" max="9" value="0" required>
                        </td>
                    </tr>

                    <tr>
                        <td><img src="images/neces/fan.png"></td>
                        <td>fan<br>Unit Price: 30</td>
                        <td>
                            Quantity (0 to 9):
                            <input name="fan" type="number" min="0" max="9" value="0" required>
                        </td>
                    </tr>

                    <tr>
                        <td><img src="images/neces/mugs.png"></td>
                        <td>mugs<br>Unit Price: 40</td>
                        <td>
                            Quantity (0 to 9):
                            <input name="mugs" type="number" min="0" max="9" value="0" required>
                        </td>
                    </tr>

                    <tr>
                        <td><img src="images/neces/umbrella.png"></td>
                        <td>umbrella<br>Unit Price: 30</td>
                        <td>
                            Quantity (0 to 9):
                            <input name="umbrella" type="number" min="0" max="9" value="0" required>
                        </td>
                    </tr>
                </table>

                <button class="button" type="submit" name="purchaseSubmit">Submit</button>
                <button class="button" type="reset">Reset</button>
            </form>
        </div>
    </div>

</body>

</html>