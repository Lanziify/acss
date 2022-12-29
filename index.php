<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
    </style>
</head>

<body>
    <div class="index-main-wrapper">

        <div class="header">

        </div>
        <div class="wrap-main-page">
            <div class="side-menu">
                <div class="items-top">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">About</a></li>
                    </ul>
                </div>
                <div class="items-bottom">
                    <a href="#">
                        <?php echo htmlspecialchars($_SESSION["Firstname"]); ?>
                    </a>
                    <hr>
                    <a href="logout.php" class="logout-button">Logout</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="script.js"></script>
</body>

</html>