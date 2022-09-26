<!-- 18114733 Zachari Belivanis-->

<?php
session_start();
session_destroy();
header('Refresh: 5; search.php');
?>

<!DOCTYPE html>
<HTML lang="eng">

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Log Out | Medbook</title>
</head>

<body>
    <h2>Logging out</h2>
    <p>Thank you for using Medbook. Redirecting you to the search page in 5 seconds...</p>
</body>

</HTML>