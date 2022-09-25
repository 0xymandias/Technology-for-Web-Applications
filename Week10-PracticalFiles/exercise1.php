<!--18114733 Zachari Belivanis-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Week 10 Exercise 1</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <?php $errorMessage = "" ?>
    <h1>New Account Registration</h1>
    <form id="registrationForm" name="registrationForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p>User Name: <input type="text" name="uName"></p>
        <p>Email: <input type="text" name="uEmail"></p>
        <p>Password: <input type="text" name="uPassword"></p>
        <p><input type="submit" value="Register" name="submit"></p>
    </form>
    <?php
    include('dbConn.php');
    $name = $_POST["uName"];
    $email = $_POST["uEmail"];
    $password = $_POST['uPassword'];
    if (isset($_POST["submit"])) {
        $name = $dbConn->escape_string($name);
        $email = $dbConn->escape_string($email);
        $password = $dbConn->escape_string($password);
        if (empty($name) || empty($email) || empty($password)) {
            $errorMessage = 'Empty fields for registration are not allowed';
            echo $errorMessage . ".";
        } else {
            $sql = "select * from account where username = '$name'";
            $recordSet = $dbConn->query($sql);
            if ($recordSet->num_rows) {
                $errorMessage = "The username provided already exists. Please use a different username.";
                echo $errorMessage . "";
            } else {
                $sql = "select * from account where email = '$email'";
                $recordSet = $dbConn->query($sql);
                if ($recordSet->num_rows) {
                    $errorMessage = "The email provided already exists. Please use a different email.";
                    echo $errorMessage . "";
                } else {
                    $sql = "insert into account values ('$name', '$email', '$password');";
                    $dbConn->query($sql);
                    $errorMessage = "Registration Successful!";
                    echo $errorMessage . "";
                    $dbConn->close();
                }
            }
        }
    }
    ?>
</body>
</html>