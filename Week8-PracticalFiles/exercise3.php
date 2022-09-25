<!--Zachari Belivanis 18114733-->
<?php
// Here is where your preprocessing code goes
// An example is already given to you for the student name
$name = $_POST['sName'];
$sID = $_POST['sID'];
$sType = $_POST['studenttype'];
$sAddress = $_POST['address'];
$inquiry = $_POST['Inquiry'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Week 8 Exercise 3: PHP Postback</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <img src="service.png" alt="service booking">
  <h1>Task 3: PHP Postback</h1>
  <form id="appinfo" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <p>All fields are mandatory in the form for student service</p>

    <p>
      <label for="sName">Student Name:</label>
      <input type="text" id="sName" name="sName">
    </p>

    <p>
      <label for="sID">Student ID:</label>
      <input type="text" id="sID" name="sID">
    </p>
    <p>
    <p>Please select your student type:</p>
    <input type="radio" id="local" name="studenttype" value="LocalStudent">
    <label for="local">Local Student</label>
    <br>
    <input type="radio" id="overseas" name="studenttype" value="InterStudent">
    <label for="overseas">International Student</label>
    </p>
    <p>
      <label for="address">Residential Address:</label>
      <textarea rows="5" cols="320" id="address" name="address"></textarea>
    </p>

    <p>
      <label for="Inquiry">Type of Inquiry: </label>
      <select id="Inquiry" name="Inquiry[]" size="5" multiple>
        <option value="SubmissionExtension">Submission Extension</option>
        <option value="AcademicSupport">Academic Support</option>
        <option value="CourseInformation">Course Information</option>
        <option value="SchoolEvents">School Events</option>
        <option value="ServiceComplaint">Service Complaint</option>
      </select>
    </p>

    <p><input type="submit" value="submit"> &nbsp; <input type="reset" value="Reset"></p>
  </form>

  <section>
    <h2>The following information was received from the service </h2>

    <p><strong>Student Name:</strong> <?php echo $name; ?></p>
    <!--output the other form inputs here -->
    <p><strong>Student ID:</strong> <?php echo $sID; ?></p>
    <p><strong>Student Type:</strong> <?php echo $sType; ?></p>
    <p><strong>Residential Address:</strong> <?php echo $sAddress; ?></p>
    <p><strong>Type of Inquiry:</strong>
      <?php
      if (!isset($inquiry)) {
        echo "<p>You did not select any service inquiry options.<p><br>";
      } else {
        $options = count($inquiry);
        for ($i = 0; $i < $options; $i++) {
          echo $inquiry[$i] . " ";
        }
      }
      ?>
  </section>
</body>

</html>