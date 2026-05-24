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

        $brooch = $_POST["brooch"];
        $crystal = $_POST["crystal"];
        $ear_rings = $_POST["earRings"];
        $necklace = $_POST["necklace"];

        $sql1 = "UPDATE purchase 
                SET quantity = quantity + $brooch 
                WHERE itemN = 'brooch'";

        $sql2 = "UPDATE purchase 
                SET quantity = quantity + $crystal 
                WHERE itemN = 'crystal'";

        $sql3 = "UPDATE purchase 
                SET quantity = quantity + $ear_rings 
                WHERE itemN = 'earRings'";

        $sql4 = "UPDATE purchase 
                SET quantity = quantity + $necklace 
                WHERE itemN = 'necklace'";

        if (
            $conn->query($sql1) === TRUE &&
            $conn->query($sql2) === TRUE &&
            $conn->query($sql3) === TRUE &&
            $conn->query($sql4) === TRUE
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
    <title>Ornaments</title>
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
        <h1 id="pageTitle">Ornaments</h1>
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
        <form action="orna.php" method="POST">
            
            <table id="imgTable">
                <tr>
                    <td><img src="images/orna/brooch.png"></td>
                    <td>brooch<br>Unit Price: 40</td>
                    <td>
                        Quantity (0 to 9):
                        <input name="brooch" type="number" min="0" max="9" value="0" required>
                    </td>
                </tr>

                <tr>
                    <td><img src="images/orna/crystal.png"></td>
                    <td>crystal<br>Unit Price: 40</td>
                    <td>
                        Quantity (0 to 9):
                        <input name="crystal" type="number" min="0" max="9" value="0" required>
                    </td>
                </tr>

                <tr>
                    <td><img src="images/orna/earRings.png"></td>
                    <td>earRings<br>Unit Price: 60</td>
                    <td>
                        Quantity (0 to 9):
                        <input name="earRings" type="number" min="0" max="9" value="0" required>
                    </td>
                </tr>

                <tr>
                    <td><img src="images/orna/necklace.png"></td>
                    <td>necklace<br>Unit Price: 60</td>
                    <td>
                        Quantity (0 to 9):
                        <input name="necklace" type="number" min="0" max="9" value="0" required>
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