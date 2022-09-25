<!--Zachari Belivanis 18114733-->
<!DOCTYPE html>
<HTML lang="eng">

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Week 9 Task 4a</title>
</head>

<body>
    <?php
    session_start();
    if ((empty($_SESSION["user"])) || (empty($_SESSION["hobbies"]))) {
        header("Location:task4.html");
    } else {
        echo "Hello, " . $_SESSION["user"];
        echo "<br>Your hobby is: <br>" . $_SESSION["hobbies"];
        session_destroy();
    ?>
        <a href="task4.html">Return to start.</a>
    <?php
    }
    ?>
</body>

</HTML>