<?php
include_once("../db.php"); // Include the Database class file
include_once("../province.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'name' => $_POST['name'],
    ];

    // Instantiate the Database and Province classes
    $database = new Database();
    $province = new Province($database);
    $province_id = $province->create($data);

    echo "Record added successfully.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <title>Add Province Data</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar_2.php'); ?>

    <div class="content">
        <h1>Add Province</h1>
        <form action="" method="post" class="centered-form">
            <label for="name">Province Name:</label>
            <input type="text" name="name" id="name" required>

            <input type="submit" value="Add Province">
        </form>
    </div>

    <?php include('../templates/footer.html'); ?>
</body>
</html>
