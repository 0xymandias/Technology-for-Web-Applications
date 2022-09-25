<!--Zachari Belivanis 18114733-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Prac Set 2 Week 8 Exercise 1 PHP Form Processing</title>
</head>

<body>
    <?php
    //obtain the student name input from the $_GET
    $name = $_POST["sName"];
    $studentID = $_POST["sID"];
    $studentType = $_POST["studenttype"];

    if (!isset($_POST["studenttype"])) {
        $studentType = "unknown";
    } else {
        $studentType = $_POST["studenttype"];
    }

    $address = $_POST["address"];
    $inquiries = $_POST["Inquiry"];
    //obtain the values for the other input devices here
    ?>
    <p>The following information was received from the
        student:</p>
    <p><strong>Student Name= </strong>
        <?php echo "$name"; ?></p>
    <p><strong>Student ID= </strong>
        <?php echo "$studentID"; ?></p>
    <p><strong>Student Type= </strong>
        <?php echo "$studentType"; ?></p>
    <p><strong>Residential Address= </strong>
        <?php echo "$address"; ?></p>
    <p><strong>Inquiry Type:<br> </strong>
        <?php
        if (!isset($_POST["Inquiry"])) {
            echo "<p>You did not select any service inquiry options.<p><br>";
        } else {
            $options = count($inquiries);
            for ($i = 0; $i < $options; $i++) {
                echo $inquiries[$i] . "<br> ";
            }
        }
        ?>


        <!--output the other form inputs here -->
</body>

</html>