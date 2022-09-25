<!-- 18114733 Zachari Belivanis-->

<?php
require_once("dbConn.php");

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
            $IdMessage = 'Error! The PatientID provided already exists. Please use a different PatientID.';
        } else {
            $IdMessage = '';
        }
    }

    //Check username validity

    if (empty($username)) {
        $userNameMessage = 'Error! A username is required. Please enter a username.';
    } else {
        $sql = "SELECT * FROM patient where username = '$username'";
        $recordSet = $dbConn->query($sql);
        if ($recordSet->num_rows) {
            $userNameMessage = '<span class="error_msg">Error! The Username provided already exists. Please use a different Username.</span>';
        } else {
            $userNameMessage = '';
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

    //check our error flags to see if they are empty, if they are we can proceed with registration

    if (empty($IdMessage) && empty($userNameMessage) && empty($pWordMessage)) {
        $sql = "insert into patient values ('$patientID', '$username', '$pWordHash')";
        $dbConn->query($sql);
        header('location:login.php');
    }


    $dbConn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Medbook | Register</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav>

    </nav>
    <h2>Patient Registration</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <p>
            <label for="patient_id">Enter a Patient ID</h3>
                <input type="number" name="patientID" id="patientID">
                <?php echo $IdMessage; ?>
        </p>
        <p>
            <label for="username">Enter a Username</h3>
                <input type="text" name="username" id="username">
                <?php echo $userNameMessage; ?>
        </p>
        <p>
            <label for="password">Enter a Password</h3>
                <input type="password" name="password" id="password">
                <?php echo $pWordMessage; ?>
        </p>
        <p>
            <input type="submit" name="submit">
        </p>
    </form>
</body>

</html>