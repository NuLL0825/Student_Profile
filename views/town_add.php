
<?php
include_once("../db.php"); // Include the Database class file
include_once("../town_city.php");




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [    
    'town_name' => $_POST['town_name']
    ];

    // Instantiate the Database and Student classes
    $database = new Database();
    $townCity = new TownCity($database);
    $town_id = $townCity->create($data);
    
    if ($town_id) {
        // Student record successfully created
        
        // Retrieve student details from the form
        $townDetailsData = [
            'town_id' => $town_id, // Use the obtained student ID
            'town_name' => $_POST['town_name']
            // Other student details fields
        ];

        // Create student details linked to the student
        $townDetails = new TownCity($database);
        
        if ($studentDetails->create($townDetailsData)) {
            echo "Record inserted successfully.";
        } else {
            echo "Failed to insert the record.";
        }
    }

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <title>Add Town</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar.php'); ?>

    <div class="content">
    <h1>Add Town</h1>
    <form action="" method="post" class="centered-form">
        <label for="student_number">Enter Town Name:</label>
        <input type="text" name="town_name" id="town_name" required>

        <input type="submit" value="Add Town">
    </form>
    </div>
    
    <?php include('../templates/footer.html'); ?>
</body>
</html>