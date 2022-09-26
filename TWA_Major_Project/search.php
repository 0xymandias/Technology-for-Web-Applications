<!-- 18114733 Zachari Belivanis-->


<?php
    $errorMsg = '';
    session_start();

    include('dbConn.php');
    if (isset($_POST["submit"])) {

        $suburb = $dbConn->escape_string($_POST["suburb"]);

        if (empty($suburb)) {
            $errorMsg = '<span class="error_msg">Error! A suburb is required. Please enter a subrub.</span>';
        } else {
            $suburb = $dbConn->escape_string($_POST["suburb"]);
            $sql = "select * from clinic where clinicSuburb = '$suburb'";
            $recordSet = $dbConn->query($sql);
            if ($recordSet->num_rows) {
    ?>
                <table>
                    <tr>
                        <th>Clinic ID</th>
                        <th>Clinic Name</th>
                        <th>Clinic Suburb</th>
                        <th>Clinic Address</th>
                    </tr>
                    <?php
                    while ($row = $recordSet->fetch_assoc()) { ?>
                        <tr>
                            <td>
                                <a href="clinicdetails.php?clinicID=<?php echo $row["clinicID"] ?>"><?php echo $row["clinicID"] ?></a>
                            </td>
                            <td>
                                <?php echo $row["clinicName"] ?>
                            </td>
                            <td>
                                <?php echo $row["clinicSuburb"] ?>
                            </td>
                            <td>
                                <?php echo $row["clinicAddress"] ?>
                            </td>
                        </tr>
        <?php
                    }
                } else {
                    $errorMsg = "Unable to locate clinics in the request suburb. Please try a different suburb.";
                }
            }
        }


        ?>


<!DOCTYPE html>
<HTML lang="eng">

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Clinic Search | Medbook</title>
</head>

<body>

    <nav>
        <ul>
            <?php
            if (!isset($_SESSION["username"])) { ?>
                <li><a href="register.php">Register</a></li>
            <?php
            } else {
                $username = $_SESSION["username"];
                echo "Welcome, $username";
            ?>

                <li><a href="logout.php">Logout</a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
    <h1> Clinic Search </h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <p>
            <label for="suburb">Enter a Suburb</h3>
                <input type="text" name="suburb" id="suburb">
                <?php echo $errorMsg; ?>
        </p>
        <p>
            <input type="submit" name="submit">
        </p>
    </form>

</body>

</html>