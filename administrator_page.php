<?php
session_start();
include "connection_bcrab.php";

$message = "";
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
            <h1 id="pageTitle">Administrator Page</h1>
            <ul>
                <li><a href="login.php">Login/Register</a></li>
                <li><a href="clothes.php">Clothes</a></li>
                <li><a href="neces.php">Necessities</a></li>
                <li><a href="orna.php">Ornaments</a></li>
                <li><a href="administrator_page.php">Administrator Page</a></li>
                <li><a href="total.php">Show total purchase</a></li>
                <li><a href="personal.php">Show personal purchase</a></li>
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
        </div>
    </div>

</body>

</html>