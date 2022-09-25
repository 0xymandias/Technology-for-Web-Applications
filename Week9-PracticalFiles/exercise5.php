<!--Zachari Belivanis 18114733-->
<!DOCTYPE html>
<HTML lang="eng">

<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Week 9 Task 5</title>
</head>
<body>
    <header><h1> Week 9 Task 5 </h1></header>
    <?php
        include("dbConn.php");
        $pubID = $dbConn->escape_string($_GET["publisherID"]);
        $sql = "select p.publishID, name, booktitle FROM book b, publisher p
        where p.publishID = b.publishID and p.publishID = '$pubID' order by p.publishID";
        $recordSet = $dbConn->query($sql);
        if(!$recordSet->num_rows){
            echo "No mathing publisher ID found.";
        } else {
            ?>
                <h1>Publishers</h1>
                <table>
                    <tr>
                        <th>Publisher ID</th>
                        <th>Publisher Name</th>
                        <th>Book Title</th>
                    </tr>
                    <?php
                        while($row = $recordSet->fetch_assoc()){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row["publishID"] ?>
                                </td>
                                <td>
                                    <?php echo $row["name"] ?>
                                </td>
                                <td>
                                    <?php echo $row["booktitle"] ?>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
                <?php
        }
    ?>
</body>
</HTML>