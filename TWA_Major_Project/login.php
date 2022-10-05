<!-- 18114733 Zachari Belivanis-->

<?php
require_once("dbConn.php");
session_start();
session_regenerate_id(true);
//create error flags
$IdMessage = "";
$userNameMessage = "";
$pWordMessage = "";
$sql = '';

if (isset($_POST["submit"])) {

    $patientID = $dbConn->escape_string($_POST["patientID"]);
    $username = $dbConn->escape_string($_POST["username"]);
    $password = $dbConn->escape_string($_POST["password"]);

    //Check patientID validity

    if (empty($patientID)) {
        $IdMessage = '<span class="error_msg">Error! PatientID is mandatory. Please enter an ID.</span>';
    } else {
        $sql = "SELECT * FROM patient where patientID = '$patientID'";
        $recordSet = $dbConn->query($sql);
        if ($recordSet->num_rows) {
            $IdMessage = '';
        } else {
            $IdMessage = '<span class="error_msg">Error! No matching Patient ID found. Please enter a valid Patient ID.</span>';
        }
    }

    //Check username validity

    if (empty($username)) {
        $userNameMessage = '<span class="error_msg">Error! A username is required. Please enter a username.</span>';
    } else {
        $sql = "SELECT * FROM patient where username = '$username'";
        $recordSet = $dbConn->query($sql);
        if ($recordSet->num_rows) {
            $userNameMessage = '';
        } else {
            $userNameMessage = '<span class="error_msg">Error! No matching Username found. Please enter a valid Username.</span>';
        }
    }

    //check password validity

    if (empty($password)) {
        $pWordMessage = '<span class="error_msg">Error! The password field is empty. Please enter a password.</span>';
    } else {
        $pWordMessage = '';
    }

    //hash our password

    $pWordHash = hash('sha256', $password);

    //compare our password hash against our stored hash

    if(empty($pWordMessage)){
        $sql = "SELECT password FROM patient WHERE password = '$pWordHash';";
        $recordSet = $dbConn->query($sql);
        if($recordSet->num_rows){
            $pWordMessage = '';
        } else {
            $pWordMessage = '<span class="error_msg">Error! Incorrect password.</span>';
        }
    }

    //check our error flags to see if they are empty, if they are we can proceed with registration

    if (empty($IdMessage) && empty($userNameMessage) && empty($pWordMessage)) {
        $sql = "SELECT * FROM `patient` WHERE `patientID` = '$patientID' AND `username` = '$username' AND `password` = '$pWordHash'";
        $dbConn->query($sql);
        $_SESSION["username"] = $username;
        header('location:search.php');
    }


    $dbConn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Medbook | Login</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav>
    <ul>
            <?php
            if (!isset($_SESSION["username"])) { ?>
                <li><a href="register.php">Register</a></li>
                <li><a class="active" href="login.php">Log In</a></li>
                <li><a href="search.php">Clinic Search</a></li>

            <?php
            } else {
            ?>
                <li><a href="search.php">Clinic Search</a></li>
                <li><a href="bookinglist.php">Booking List</a></li>
                <li style="float:right"><a href="logout.php">Logout</a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
    <h2>Patient Login</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <p>
            <label for="patient_id">Enter a Patient ID</label>
            <input type="number" name="patientID" id="patientID">
            <?php echo $IdMessage; ?>
        </p>
        <p>
            <label for="username">Enter a Username</label>
            <input type="text" name="username" id="username">
            <?php echo $userNameMessage; ?>
        </p>
        <p>
            <label for="password">Enter a Password</label>
            <input type="password" name="password" id="password">
            <?php echo $pWordMessage; ?>
        </p>
        <p>
            <input type="submit" name="submit">
        </p>
    </form>
</body>