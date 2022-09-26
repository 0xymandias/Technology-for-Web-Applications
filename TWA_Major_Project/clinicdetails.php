<!-- 18114733 Zachari Belivanis-->
<?php
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];

    $serviceMessage = $dateMessage = $timeMessage = $bookingService = '';

    include('dbConn.php');
    //set our clinicID based on whether it is in the URL or persists from our form submission
    if (isset($_GET["clinicID"])) {
        $clinicID = $dbConn->escape_string($_GET["clinicID"]);
        $_SESSION["clinicID"] = $clinicID;
        $sql = "select * from clinic where clinicID = '$clinicID'";
        $recordSet = $dbConn->query($sql);
    } elseif (isset($_SESSION["clinicID"])) {
        $clinicID = $_SESSION["clinicID"];
        $sql = "select * from clinic where clinicID = '$clinicID'";
        $recordSet = $dbConn->query($sql);
    }
    if (isset($_POST["submit"])) {
        //confirm that services have been selected
        if (empty($bookingService)) {
            $serviceMessage = '<span class="error_msg">Error! No services selected. Please select a service.</span>';
        } else {
            $bookingService = implode(', ', $_POST['services']);
        }
        $clinicID = $dbConn->escape_string($_POST["clinicID"]);
        $bDate = $dbConn->escape_string($_POST["bookDate"]);
        $bTime = $dbConn->escape_string($_POST["bookTime"]);
        $bookingDate = date('Y-m-d', strtotime($bDate));
        $bookingTime = date('H:i:s', strtotime($bTime));

        //confirm a booking date has been selected
        if (empty($bDate)) {
            $dateMessage = '<span class="error_msg">Error! No date selected. Please select a booking date.</span>';
        }
        //confirm booking time
        if (empty($bTime)) {
            $timeMessage = '<span class="error_msg">Error! No time selected. Please select a booking time.</span>';
        }
        //all checks cleared, create booking and bookingList entries
        if (empty($serviceMessage) && empty($dateMessage) && empty($timeMessage)) {
            //use sql insert statement to add a new booking record with $bookingDate and $bookTime
            $bookingSQL = "INSERT INTO `booking` ( `patientName`, `clinicID`, `bookDate`, `bookTime`, `bookService`) VALUES ('$username','$clinicID', '$bookingDate', '$bookingTime', '$bookingService');";
            //with our booking inserted into the booking table next handle bookingList table
            //find our patientID based on the username
            $getPatientIDSQL = "SELECT patientID FROM patient WHERE username = '$username';";
            $recordSet = $dbConn->query($getPatientIDSQL);
            $row = $recordSet->fetch_assoc();
            $patientID = $row['patientID'];
            $bookingListSQL = "INSERT INTO `bookinglist` (`patientID`, `clinicID`, `listDate`, `listTime`, `serviceType`) VALUES ('$patientID', '$clinicID', '$bookingDate', '$bookingTime', '$bookingService');";
            $recordSet = $dbConn->query($bookingSQL);
            $recordSet = $dbConn->query($bookingListSQL);
            $redirectNotification = "Congratulations! Booking has been placed. Redicting in 5 seconds.";
            header('Refresh: 5; bookinglist.php');
        }
    }
} else {
?>
    <form id="notLoggedInBooking" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="bookService"><span>Service Type(s): </span></label>
        <select multiple id="bookService" name="services">
            <option value="nutrition">Nutrtion Support</option>
            <option value="dental">Dental Care</option>
            <option value="pharma">Pharmaceutical</option>
            <option value="physical">Physical Therapy</option>
            <option value="diagnosis">Diagnosis Care</option>
        </select><br>
        <label for="bookDate"><span>Booking Date: </span></label>
        <input type="date" name="bookDate"><br>
        <label><span>Booking Time: </span></label>
        <input type="time" name="bookTime"><br>
        <input type="submit" value="Submit">
    </form>
<?php
    if (isset($_POST["submit"])) {
        //find the next available bookingID
        $clinicID = $_POST["clinicID"];
        $sql = "select bookNum from booking where bookingID > 0";
        $recordSet = $dbConn->query($sql);
        echo $sql . "";
        $bDate = $_POST["bookDate"];
        $bTime = $_POST["bookTime"];
        $bookingDate = date('Y-m-d', strtotime($bDate));
        $bookingTime = date('H:i:s', strtotime($bTime));
        //use sql insert statement to add a new booking record with $bookingDate and $bookTime
        //$bookingSQL = "INSERT INTO `booking` (`bookNum`, `patientName`, `clinicID`, `bookDate`, `bookTime`, `bookService`) VALUES ('1', '$username','$clinicID', '$bookingDate', '$bookingTime', '$bookingService');";
        //$bookingListSQL = "INSERT INTO `bookinglist` (`bookNum`, `patientName`, `clinicID`, `bookDate`, `bookTime`, `bookService`) VALUES ('1', '$username', '$bookingDate', '$bookingTime', '$bookingService');";
        //echo $bookingSQL;
        //echo $bookingListSQL;
        header('location:bookingList.php');
    }
}
?>
<?php

?>


<!DOCTYPE html>
<HTML lang="eng">

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Clinic Details | Medbook</title>
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
                    <?php echo $row["clinicID"] ?>
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

        if (isset($_SESSION["username"])) {
        ?>

            <form id="loggedInBooking" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <? // store our Clinic ID as readonly so it be sent as part of the form 
                ?>
                <p>
                    <label for="clinicID">Clinic ID:</label>
                    <input type="text" name="clinicID" value="<?php echo $clinicID; ?>" readonly><br><br>
                </p>
                <p>
                    <label for="services[]">Services</label>
                    <select multiple id="bookService" name="services[]">
                        <option value="nutrition">Nutrtion Support</option>
                        <option value="dental">Dental Care</option>
                        <option value="pharma">Pharmaceutical</option>
                        <option value="physical">Physical Therapy</option>
                        <option value="diagnosis">Diagnosis Care</option>
                    </select><br>
                    <?php echo $serviceMessage; ?>
                </p>
                <p>
                    <label for="bookDate"><span>Booking Date: </span></label>
                    <input type="date" name="bookDate"><br>
                    <?php echo $dateMessage; ?>
                </p>
                <p>
                    <label><span>Booking Time: </span></label>
                    <input type="time" name="bookTime"><br>
                    <?php echo $timeMessage; ?>
                </p>
                <input type="submit" name="submit">
            </form>
        <?php
        } else {
        ?>


        <?php
        }
        ?>
</body>

</HTML>