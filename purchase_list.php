<?php
session_start();
include "connection_bcrab.php";

$message = "";
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Purchase</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        #purchaseOutline {
            min-height: 450px;
            padding: 30px;
            background-color: lightyellow;
            box-sizing: border-box;
        }

        #purchaseTable {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        #purchaseTable th,
        #purchaseTable td {
            border: 2px solid black;
            padding: 10px;
            text-align: center;
        }

        #purchaseTable th {
            background-color: lightblue;
        }

        .purchaseMessage {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>

    <?php
    if ($message != "") {
        echo "<script>alert('$message');</script>";
    }
    ?>

    <div>
        <nav>
            <h1 id="pageTitle">我的购买</h1>
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

        <div id="purchaseOutline">
            <?php
            if (isset($_SESSION["username"])) {
                $username = $_SESSION["username"];
                $sql = "SELECT * FROM members WHERE username = '$username'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table id='purchaseTable'>";

                    $row = $result->fetch_assoc();
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        if ($key !== 'password') {
                            echo "<th>" . htmlspecialchars($key) . "</th>";
                        }
                    }
                    echo "</tr>";

                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        if ($key !== 'password') {
                            echo "<td>" . htmlspecialchars($value) . "</td>";
                        }
                    }
                    echo "</tr>";

                    echo "</table>";
                } else {
                    echo "<p class='purchaseMessage'>No purchase records found.</p>";
                }
            } else {
                echo "<p class='purchaseMessage'>Please login first.</p>";
            }
            ?>
        </div>
    </div>

</body>

</html>
