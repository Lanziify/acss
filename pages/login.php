<?php
// session_start();
// Check login session
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}
// Include config file
include 'config.php';

// Define variables and initialize with empty values
$username = $login_id = $login_password = "";
$login_id_err = $login_password_err = $login_err = "";

// Define variables and initialize with empty values for registration
$firstname = $lastname = $studentID = $password = $yearlevel = $block = "";
$firstname_err = $lastname_err = $studentID_err = $password_err = $yearlevel_err = $block_err = "";

// Processing form data when form is submitted
// User login
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    if (isset($_POST["Login"])) {

        if (empty(trim($_POST["login_id"]))) {
            $login_id_err = "Please your ID number.";
        } else {
            $login_id = trim($_POST["login_id"]);
        }
        // Check if password is empty
        if (empty(trim($_POST["login_password"]))) {
            $login_password_err = "Please enter your password.";
        } else {
            $login_password = trim($_POST["login_password"]);
        }
        // Validate credentials
        if (empty($login_id_err) && empty($login_password_err)) {
            // Prepare a select statement
            $sql = "SELECT Firstname, Student_ID, Password FROM user_acss WHERE Student_ID = ?";
            if ($stmt = $mysqli->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_login_id);
                // Set parameters
                $param_login_id = $login_id;
                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Store result
                    $stmt->store_result();
                    // Check if username exists, if yes then verify password
                    if ($stmt->num_rows == 1) {
                        // Bind result variables
                        $stmt->bind_result($username, $login_id, $hashed_password);
                        if ($stmt->fetch()) {
                            if (password_verify($login_password, $hashed_password)) {
                                // Password is correct, so start a new session
                                session_start();
                                // Store data in session variables

                                $_SESSION["loggedin"] = true;
                                $_SESSION["Firstname"] = $username;
                                $_SESSION["studentID"] = $login_id;
                                // Redirect user to index page
                                header("location: index.php");
                            } else {
                                // Password is not valid, display a generic error message
                                $login_err = "Invalid username or password.";
                            }
                        }
                    } else {
                        // Username doesn't exist, display a generic error message
                        $login_err = "Invalid username or password.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            // Close connection
            $mysqli->close();
        }
    }

    if (isset($_POST['Register'])) {
        // User Registration
        // Validate firstname
        if (empty(trim($_POST["firstname"]))) {
            $firstname_err = "Please your name";
        } elseif (!preg_match('/^[a-zA-Z]+$/', trim($_POST["firstname"]))) {
            $firstname_err = "Please enter a valid name";
        } else {
            // Prepare a select statement
            $sql = "SELECT Firstname FROM user_acss WHERE firstname = ?";
            if ($stmt = mysqli_prepare($mysqli, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_firstname);
                // Set parameters
                $param_firstname = trim($_POST["firstname"]);
            }
        }
        // Validate lastname
        if (empty(trim($_POST["lastname"]))) {
            $lastname_err = "Please your lastname";
        } elseif (!preg_match('/^[a-zA-Z ]+$/', trim($_POST["lastname"]))) {
            $lastname_err = "Please enter a valid surname";
        } else {
            // Prepare a select statement
            $sql = "SELECT Lastname FROM user_acss WHERE lastname = ?";
            if ($stmt = mysqli_prepare($mysqli, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_lastname);
                // Set parameters
                $param_lastname = trim($_POST["lastname"]);
            }
        }
        // Validate Student ID
        $pattern = '/^\d\-\d+$/';
        if (empty(trim($_POST["studentID"]))) {
            $studentID_err = "Please your ID number";
        } elseif (!preg_match($pattern, trim($_POST["studentID"]))) {
            $studentID_err = "Please enter a valid ID number";
        } else {
            // Prepare a select statement
            $sql = "SELECT Student_ID FROM user_acss WHERE Student_ID = ?";
            if ($stmt = mysqli_prepare($mysqli, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_studentID);
                // Set parameters
                $param_studentID = trim($_POST["studentID"]);
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $studentID_err = "Student ID already exist!";
                    } else {
                        $studentID = trim($_POST["studentID"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        // Validate password
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have atleast 6 characters";
        } else {
            $password = trim($_POST["password"]);
        }
        // Validate year level
        if (empty(trim($_POST["yearlevel"]))) {
            $yearlevel_err = "Please your year level";
        } elseif (!preg_match('/^[a-zA-Z0-4 ]+$/', trim($_POST["yearlevel"]))) {
            $firstname_err = "Please enter your year level";
        } else {
            // Prepare a select statement
            $sql = "SELECT Year_level FROM user_acss WHERE Year_level = ?";
            if ($stmt = mysqli_prepare($mysqli, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_yearlevel);
                // Set parameters
                $param_yearlevel = trim($_POST["yearlevel"]);
                // Close statement
            }
        }
        // Validate Block
        if (empty(trim($_POST["block"]))) {
            $block_err = "Please your block";
        } elseif (!preg_match('/^[a-zA-Z0-4_]+$/', trim($_POST["block"]))) {
            $block_err = "Please enter your year level";
        } else {
            // Prepare a select statement
            $sql = "SELECT Block FROM user_acss WHERE block = ?";
            if ($stmt = mysqli_prepare($mysqli, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_block);
                // Set parameters
                $param_block = trim($_POST["block"]);
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        // Check input errors before inserting in database
        if (
            empty($firstname_err) && empty($lastname_err) && empty($studentID_err) && empty($password_err) && empty($yearlevel_err) && empty($block_err)
        ) {
            // Prepare an insert statement
            $sql = "INSERT INTO user_acss (Firstname, Lastname, Student_ID, Password, Year_level, Block
        ) VALUES (?, ?, ?, ?, ?, ?
        )";
            if ($stmt = mysqli_prepare($mysqli, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param(
                    $stmt,
                    "ssssss",
                    $param_firstname,
                    $param_lastname,
                    $param_studentID,
                    $param_password,
                    $param_yearlevel,
                    $param_block
                );
                // Set parameters

                // $param_firstname = $firstname;
                // $param_lastname = $lastname;
                // $param_studentID = $studentID;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a passwordhash
                // $param_yearlevel = $yearlevel;
                // $param_block = $block;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Redirect to login page
                    header("location: login.php");
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        // Close connection
        mysqli_close($mysqli);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Acss Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="page_wrapper">
        <div class="navbar">
            <div class="sitebrand">
                <a href="login.php">
                    <img src="../imgs/ACCSlconNavigation.png" alt="">
                </a>
            </div>
            <div class="loginfields">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="studIDfield">
                        <label>Student ID</label>
                        <input type="text" name="login_id"
                            class="form-control <?php echo (!empty($login_id_err)) ? 'is-invalid' : ''; ?>"
                            value="<?php echo $login_id; ?>">
                        <span class="invalid-feedback"><?php echo $login_id_err; ?></span>
                    </div>
                    <div class="passwordfield">
                        <label>Password</label>
                        <input type="password" name="login_password"
                            class="form-control <?php echo (!empty($login_password_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $login_password_err; ?></span>
                        <a href="#">Forgot password?</a>
                    </div>
                    <div class="loginbtn">
                        <input type="submit" class="btn btn-primary" name="Login" value="Login">
                    </div>
                </form>
            </div>
        </div>
        <div class="association_wrapper">
            <div class="department_wrapper">
                <div class="association_logo">
                    <img src="../imgs/BSCSLogo.png" alt="ascc logo">
                    <h2>Association of Computer Science Students</h2>
                </div>
                <h1>College of Information Technology Education</h1>
                <h3>NEMSU - Tandag Campus</h3>
            </div>
            <div class="registration_wrapper">
                <h2>Create an Account</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-studentname">
                        <div class="form-group">
                            <input type="text" name="firstname"
                                class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $firstname; ?>" placeholder="Firstname">
                            <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lastname"
                                class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $lastname; ?>" placeholder="Lastname">
                            <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
                        </div>
                    </div>
                    <div class="form-studentdetails">
                        <div class="form-group">
                            <input type="text" name="studentID"
                                class="form-control <?php echo (!empty($studentID_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $studentID; ?>" placeholder="Student ID">
                            <span class="invalid-feedback"><?php echo $studentID_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password"
                                class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $password; ?>" placeholder="Password">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" name="yearlevel"
                                class="form-control <?php echo (!empty($yearlevel_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $yearlevel; ?>" placeholder="Year level">
                            <span class="invalid-feedback"><?php echo $yearlevel_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" name="block"
                                class="form-control <?php echo (!empty($block_err)) ? 'is-invalid' : ''; ?>"
                                value="<?php echo $block; ?>" placeholder="Block">
                            <span class="invalid-feedback"><?php echo $block_err; ?></span>
                        </div>
                    </div>
                    <div class="signupbtn">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="Register" value="Sign Up">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>