<!--18114733 Zachari Belivanis-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Week 10 Exercise 2</title>
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
        if(!empty($name) && !empty($email) && !empty($password)){
            $sql = "select * from account where username = '$name'";
            $recordSet = $dbConn->query($sql);
            if ($recordSet->num_rows) {
                $sql = "select * from account where email = '$email'";
                $recordSet = $dbConn->query($sql);
                if ($recordSet->num_rows){
                    $sql = "select * from account where password = '$password'";
                    $recordSet = $dbConn->query($sql);
                    if($recordSet->num_rows){
                    $errorMessage = "Welcome to TWA Prac Set 2, $name.";
                    echo $errorMessage . "";
                    }else {
                        $errorMessage = "Error! Incorrect password.";
                    echo $errorMessage . "";
                    }
                } else {
                    $errorMessage = "Error! No matching email found.";
                echo $errorMessage . "";
                }
            } else {
                $errorMessage = "Error! No matching username found.";
                echo $errorMessage . "";
            }
    } else {
        $errorMessage = "Error! Empty fields for login are not allowed.";
        echo $errorMessage . "";
    }
}
    ?>
</body>
</html>