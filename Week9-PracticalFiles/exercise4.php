<!--Zachari Belivanis 18114733-->
<!DOCTYPE html>
<HTML lang="eng">

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Week 9 Task 4</title>
</head>

<body>
    <?php
    session_start();

    $name = $_POST["personName"];
    $_SESSION["user"] = $name;
    $selected_hobby = "";
    if (isset($_POST["hobby"])) {
        $hobbyList = $_POST["hobby"];
        foreach ($hobbyList as $hobby){
            $selected_hobby = $hobby ."<br>" . $selected_hobby;
        }
        $_SESSION["hobbies"] = $selected_hobby;
        ?>
        <a href="exercise4a.php">Next page.</a>
        <?php
    } else {
        header("Location:task4.html");
    }
    ?>

</body>