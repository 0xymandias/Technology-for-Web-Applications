<!--Zachari Belivanis 18114733-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf -8">
    <title>Week 9 PHP task 2</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    include('dbconn.php');
    $sql = "select * from book where lang = 'English'";
    $recordSet = $dbConn->query($sql);
    if (!$recordSet->num_rows){
        echo "No records matching the language criteria";
    } else {
    ?>
        <h1>Books with English as Language</h1>
        <table>
            <tr>
                <th>Book ID</th>
                <th>Book Title</th>
                <th>ISBN</th>
                <th>Price</th>
                <th>Genre</th>
                <th>Edition</th>
                <th>Language</th>
                <th>Quantity</th>
                <th>Publisher</th>
            </tr>
            <?php
            while ($row = $recordSet->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php echo $row["bookID"] ?>
                    </td>
                    <td>
                        <?php echo $row["booktitle"] ?>
                    </td>
                    <td>
                        <?php echo $row["ISBN"] ?>
                    </td>
                    <td>
                        <?php echo $row["price"] ?>
                    </td>
                    <td>
                        <?php echo $row["genre"] ?>
                    </td>
                    <td>
                        <?php echo $row["edition"] ?>
                    </td>
                    <td>
                        <?php echo $row["lang"] ?>
                    </td>
                    <td>
                        <?php echo $row["quantity"] ?>
                    </td>
                    <td>
                        <?php echo $row["publishID"] ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    }
    ?>
    <?php $dbConn->close(); ?>
</body>

</html>