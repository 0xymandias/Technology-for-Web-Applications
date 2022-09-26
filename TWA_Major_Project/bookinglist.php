<!-- 18114733 Zachari Belivanis-->
<?php
session_start();
include('dbConn.php');

if (isset($_SESSION["username"])) {
    $loginName = $_SESSION["username"];
    //get bookings associated with patientID from bookingList table
    $bookingSQL = "SELECT * FROM booking WHERE patientName = '$loginName';";
    $recordSet = $dbConn->query($bookingSQL);
    if ($recordSet->num_rows) {
?>
        <table>
            <tr>
                <th>Booking Number</th>
                <th>Patient Name</th>
                <th>Clinic ID</th>
                <th>Booking Date</th>
                <th>Booking Time</th>
                <th>Services</th>
            </tr>
            <?php
            while ($row = $recordSet->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php echo $row["bookNum"] ?>
                    </td>
                    <td>
                        <?php echo $row["patientName"] ?>
                    </td>
                    <td>
                        <a href="clinicdetails.php?clinicID=<?php echo $row["clinicID"] ?>"><?php echo $row["clinicID"] ?></a>
                    </td>
                    <td>
                        <?php echo $row["bookDate"] ?>
                    </td>
                    <td>
                        <?php echo $row["bookTime"] ?>
                    </td>
                    <td>
                        <?php echo $row["bookService"] ?>
                    </td>
                </tr>
    <?php
            }
        }
    } else {
        $dbConn->close();
        header('Refresh: 3; login.php');
    }

    ?>

    <!DOCTYPE html>
    <HTML lang="eng">

    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Booking List | Medbook</title>
    </head>

    <body>

    <ul>
            <?php
            if (!isset($_SESSION["username"])) { ?>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Log In</a></li>
                <li><a href="search.php">Clinic Search</a></li>

            <?php
            } else {
            ?>
                <li><a href="search.php">Clinic Search</a></li>
                <li><a class="active" href="bookinglist.php">Booking List</a></li>
                <li style="float:right"><a href="logout.php">Logout</a></li>
            <?php
            }
            ?>
        </ul>




    </body>

    </HTML>