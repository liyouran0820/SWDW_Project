<?php
session_start();
include "connection_bcrab.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Login
    if (isset($_POST["loginSubmit"])) {
        $username = $_POST["loginUsername"];
        $password = $_POST["loginPassword"];
        if (isset($_POST["administrator"])) {
            $sql = "SELECT * FROM administrator 
                WHERE username = '$username' AND password = '$password'";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $_SESSION["username"] = $username;
                echo "<script>
                alert('Administrator Login Successfully.');
                window.location.href='total.php';
                </script>";
            } else {
                $message = "Incorrect username or password.";
            }
        } else {
            $sql = "SELECT * FROM members 
                WHERE username = '$username' AND password = '$password'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $_SESSION["username"] = $username;
                $message = "Login Successfully.";
            } else {
                $message = "Incorrect username or password.";
            }
        }
    }

    // Register
    if (isset($_POST["registerSubmit"])) {

        $username = $_POST["registerUsername"];
        $phone = $_POST["phone"];
        $password = $_POST["registerPassword"];
        $confirmPassword = $_POST["confirmPassword"];

        if ($password != $confirmPassword) {
            $message = "Passwords do not match.";
        } else {

            $checkUsername = "SELECT * FROM members 
                    WHERE username = '$username'";
            $checkPhone = "SELECT * FROM members 
                    WHERE phone = '$phone'";

            $checkResultUsername = $conn->query($checkUsername);
            $checkResultPhone = $conn->query($checkPhone);

            if ($checkResultUsername->num_rows > 0 && $checkResultPhone->num_rows > 0) {
                $message = "Username and phone already exists.";
            } else if ($checkResultUsername->num_rows > 0) {
                $message = "Username already exists.";
            } else if ($checkResultPhone->num_rows > 0) {
                $message = "Phone already exists.";
            } else {
                $sql = "INSERT INTO members (username, password, phone, ancientShirt, cap, cultureShirt, poloShirt, calendar, fan, mugs, umbrella, brooch, crystal, earRings, necklace)
                        VALUES ('$username', '$password', '$phone', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";

                if ($conn->query($sql) === TRUE) {
                    $message = "Register successfully.";
                } else {
                    $message = "Register failed: " . $conn->error;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css?v=20">
</head>

<body>

    <div>
        <nav>
            <h1 id="pageTitle">Login</h1>
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

            <div id="box1">
                <h2>Login Member</h2>
                <br>

                <form action="login.php" method="post">
                    Username:<br>
                    <input class="inputbox" type="text" name="loginUsername" placeholder="Username" required><br><br>

                    Password:<br>
                    <input class="inputbox" type="password" name="loginPassword" placeholder="Password" required><br><br>
                    <input type="radio" name="administrator" value="administrator">I am the administrator<br><br>
                    <button class="button" type="submit" name="loginSubmit">Submit</button>
                    <button class="button" type="reset">Reset</button>
                </form>
            </div>

            <div id="box2">
                <h2>Register New Member</h2>
                <br>

                <form action="login.php" method="post">
                    Username:<br>
                    <input class="inputbox" type="text" name="registerUsername" placeholder="Username" maxlength="20" required><br><br>

                    Phone:<br>
                    <input class="inputbox" type="number" name="phone" placeholder="Phone" max="99999999999999999999" required><br><br>

                    Password:<br>
                    <input class="inputbox" type="password" name="registerPassword" placeholder="Password" maxlength="30" required><br><br>

                    Confirm Password:<br>
                    <input class="inputbox" type="password" name="confirmPassword" placeholder="Confirm Password" maxlength="30" required><br><br>

                    <button class="button" type="submit" name="registerSubmit">Submit</button>
                    <button class="button" type="reset">Reset</button>
                </form>
            </div>

        </div>
    </div>

    <?php
    if ($message != "") {
        echo "<script>alert(" . json_encode($message) . ");</script>";
    }
    ?>

</body>

</html>