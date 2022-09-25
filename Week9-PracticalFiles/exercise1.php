<!--Zachari Belivanis 18114733-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf -8">
    <title>Week 9 PHP task 1</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    $dbConn = new mysqli("localhost", "root", "", "bookstore");
    if ($dbConn->connect_error) {
        die('Connection Error (' . $dbConn->connect_errno . ')' . $dbConn->connect_error);
    }
    $sql = "select * from book";
    $recordSet = $dbConn->query($sql);
    ?>
    <h1>Book table</h1>
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
    $sql1 = "SELECT * FROM author";
    $recordSet = $dbConn->query($sql1);
    ?>
    <h1>Author table</h1>
    <table>
        <tr>
            <th>Author ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Country</th>
        </tr>
        <?php
        while ($row = $recordSet->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row["authorID"] ?></td>
                <td><?php echo $row["firstname"] ?></td>
                <td><?php echo $row["lastname"] ?></td>
                <td><?php echo $row["birthdate"] ?></td>
                <td><?php echo $row["phone"] ?></td>
                <td><?php echo $row["email"] ?></td>
                <td><?php echo $row["address"] ?></td>
                <td><?php echo $row["country"] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <?php
    $sql2 = "SELECT * FROM publisher";
    $recordSet = $dbConn->query($sql2);
    ?>
    <h1>Publisher table</h1>
    <table>
        <tr>
            <th>Publisher ID</th>
            <th>Publisher Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Region</th>
        </tr>
        <?php
        while ($row = $recordSet->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row["publishID"] ?></td>
                <td><?php echo $row["name"] ?></td>
                <td><?php echo $row["postaddress"] ?></td>
                <td><?php echo $row["phone"] ?></td>
                <td><?php echo $row["email"] ?></td>
                <td><?php echo $row["region"] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <?php
    $sql2 = "SELECT * FROM writes";
    $recordSet = $dbConn->query($sql2);
    ?>
    <h1>Writer table</h1>
    <table>
        <tr>
            <th>Book ID</th>
            <th>Author ID</th>
        </tr>
        <?php
        while ($row = $recordSet->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row["bookID"] ?></td>
                <td><?php echo $row["authorID"] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <?php $dbConn->close();
?>
</body>

</html>