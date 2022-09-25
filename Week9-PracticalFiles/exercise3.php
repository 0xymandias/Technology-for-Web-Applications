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
    $sql = "select booktitle,price,quantity from book where quantity < 1000 order by price;";
    $recordSet = $dbConn->query($sql);
    if (!$recordSet->num_rows){
        echo "No records math the language criteria";
    } else {
    ?>
        <h1>Books with less than 1000 in stock</h1>
        <table>
            <tr>
                <th>Book Title</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php
            while ($row = $recordSet->fetch_assoc()) { ?>
                <tr>

                    <td>
                        <?php echo $row["booktitle"] ?>
                    </td>
                    <td>
                        <?php echo $row["price"] ?>
                    </td>
                    <td>
                        <?php echo $row["quantity"] ?>
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