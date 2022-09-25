<!--PHP script to view all 3 tables and records from the medbook database-->

<?php

require_once("dbConn.php");
$sql = "SHOW TABLES";
$tables = $dbConn->query($sql);
$tablesAndTheirData = array();
while ($tableName = $tables->fetch_array()) {
    $sql = "SELECT * FROM $tableName[0] limit 200";
    $data = $dbConn->query($sql);
    array_push($tablesAndTheirData, array(
        'name' => $tableName[0],
        'fields' => $data->fetch_fields(),
        'data' => $data
    ));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Database Tables for Major Project</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php foreach ($tablesAndTheirData as $table) : ?>
        <h2><code><?php echo $table['name']; ?></code> Table</h2>
        <?php if ($table['data']->num_rows) : ?>
            <table>
                <thead>
                    <tr style="font-weight:bold">
                        <?php foreach ($table['fields'] as $field) : ?>

                            <td><?php echo $field->name; ?></td>

                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $table['data']->fetch_assoc()) : ?>
                        <tr>
                            <?php foreach ($row as $key => $value) : ?>
                                <td><?php echo $value; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Table does not have any data</p>
        <?php endif; ?>
    <?php endforeach;
    $dbConn->close();
    ?>
</body>

</html>