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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="index-style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>Association of Computer Science Students</title>
</head>

<body>
    <div class="main-container">
        <div class="dashboard-main" id="dashboard">
            <div class="dashboard-items">

                <ul>
                    <li>
                        <a href="#" class="site-logo">
                            <img src="../imgs/ACCSlconNavigation.png" alt="">
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-circle-user"></i>
                            <span>
                                <?php echo htmlspecialchars($_SESSION["Firstname"]); ?>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php">
                            <i class="fa-solid fa-house"></i>
                            <span> Home </span>
                        </a>
                    </li>
                    <li>
                        <a href="generate.php">
                            <i class="fa-solid fa-palette"></i>
                            <span> Generate </span>
                        </a>
                    </li>
                    <li>
                        <a href="about.php">
                            <i class="fa-solid fa-circle-info"></i>
                            <span> About </span>
                        </a>
                    </li>
                    <li>
                        <a href="logout.php" class="logout-button">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span> Logout </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-page-content-about">
            <div class="about-content">
                <h1>About the ACSS Palette Generator</h1>
                <p>Welcome to the Palette Generator! Our tool allows you to create beautiful color palettes for your
                    designs with just a few clicks. Whether you're a professional designer or a beginner, our tool
                    makes it easy to choose the perfect colors for your project.</p>
                <h2>How it works:</h2>
                <ol>
                    <li>Open Generate section of the page.</li>
                    <li>Choose the type of palette you want to generate (such as complementary, analogous, or
                        monochromatic).</li>
                    <li>The Palette Generator will then generate a palette of colors based on your selection.</li>
                    <li>You can customize the palette by adjusting the settings, such as the number of colors and
                        the color harmony.</li>
                    <li>Save and export the palette to use in your designs.</li>
                </ol>
                <p>We hope you enjoy using the Palette Generator and find it helpful in your creative projects. If
                    you have any questions or feedback, don't hesitate to <a href="contact.html">contact us</a>.</p>
            </div>
        </div>
    </div>
    <script src="../node_modules/color-scheme/lib/color-scheme.js"></script>
    <script src="./script.js"></script>
</body>

</html>