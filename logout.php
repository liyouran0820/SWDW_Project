<?php
session_start();

unset($_SESSION["username"]);

echo "<script>
        alert('Logout successfully.');
        window.location.href='login.php';
      </script>";
?>