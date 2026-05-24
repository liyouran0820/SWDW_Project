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

        $ancient_shirt = $_POST["ancientShirt"];
        $cap = $_POST["cap"];
        $culture_shirt = $_POST["cultureShirt"];
        $polo_shirt = $_POST["poloShirt"];
        $username = $_SESSION["username"];

        $sql1 = "UPDATE purchase 
                SET quantity = quantity + $ancient_shirt 
                WHERE itemN = 'ancientShirt'";

        $sql2 = "UPDATE purchase 
                SET quantity = quantity + $cap 
                WHERE itemN = 'cap'";

        $sql3 = "UPDATE purchase 
                SET quantity = quantity + $culture_shirt 
                WHERE itemN = 'cultureShirt'";

        $sql4 = "UPDATE purchase 
                SET quantity = quantity + $polo_shirt 
                WHERE itemN = 'poloShirt'";

        $sql5 = "UPDATE members 
                SET ancientShirt = ancientShirt + $ancient_shirt,
                    cap = cap + $cap,
                    cultureShirt = cultureShirt + $culture_shirt,
                    poloShirt = poloShirt + $polo_shirt
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
    <title>Clothes</title>
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
            <h1 id="pageTitle">Clothes</h1>
            <ul>
                <li><a href="login.php">Login/Register</a></li>
                <li><a href="clothes.php">Clothes</a></li>
                <li><a href="neces.php">Necessities</a></li>
                <li><a href="orna.php">Ornaments</a></li>
                <li><a href="purchase_list.php">My Purchase</a></li>
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
            <form action="clothes.php" method="POST">

                <table id="imgTable">
                    <tr>
                        <td><img src="images/clothes/ancientShirt.png"></td>
                        <td>ancient<br>Unit Price: 100</td>
                        <td>
                            Quantity (0 to 9):
                            <input name="ancientShirt" type="number" min="0" max="9" value="0" required>
                        </td>
                    </tr>

                    <tr>
                        <td><img src="images/clothes/cap.png"></td>
                        <td>cap<br>Unit Price: 20</td>
                        <td>
                            Quantity (0 to 9):
                            <input name="cap" type="number" min="0" max="9" value="0" required>
                        </td>
                    </tr>

                    <tr>
                        <td><img src="images/clothes/cultureShirt.png"></td>
                        <td>cultureShirt<br>Unit Price: 50</td>
                        <td>
                            Quantity (0 to 9):
                            <input name="cultureShirt" type="number" min="0" max="9" value="0" required>
                        </td>
                    </tr>

                    <tr>
                        <td><img src="images/clothes/poloShirt.png"></td>
                        <td>poloShirt<br>Unit Price: 60</td>
                        <td>
                            Quantity (0 to 9):
                            <input name="poloShirt" type="number" min="0" max="9" value="0" required>
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
