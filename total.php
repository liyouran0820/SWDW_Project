<?php
session_start();
include "connection_bcrab.php";

$message = "";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Total Purchase</title>
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
            <h1 id="pageTitle">Show total purchase</h1>
            <ul>
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
            <?php
            $sql = "SELECT * FROM purchase";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table id='imgTable' border='1'>";

                // 显示列标题
                $row = $result->fetch_assoc();
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<th>" . htmlspecialchars($key) . "</th>";
                }
                echo "</tr>";

                // 显示第一行数据
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                echo "</tr>";

                // 显示剩余行数据
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No purchase records found.";
            }
            ?>
        </div>
    </div>

</body>

</html>