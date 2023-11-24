<?php
include_once("../db.php"); // Include the Database class file
include_once("../student.php"); // Include the Student class file
include_once("../student_details.php");
include_once("../town_city.php");
include_once("../province.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch student data by ID from the database
    $db = new Database();
    $student = new Student($db);
    $studentData = $student->read($id); // Implement the read method in the Student class
    
    $db1 = new Database();
    $studentDetails = new StudentDetails($db1);
    $studentData1 = $studentDetails->read($id); // Implement the read method in the Student class

    if ($studentData && $studentData) {
        // The student data is retrieved, and you can pre-fill the edit form with this data.
    } else {
        echo "Student not found.";
    }
} else {
    echo "Student ID not provided.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'id' => $_POST['id'],
        'student_number' => $_POST['student_number'],
        'first_name' => $_POST['first_name'],
        'middle_name' => $_POST['middle_name'],
        'last_name' => $_POST['last_name'],
        'gender' => $_POST['gender'],
        'birthday' => $_POST['birthday'],
    ];
    $studentDetailsData = [
        'student_id' => $id, // Use the obtained student ID
        'contact_number' => $_POST['contact_number'],
        'street' => $_POST['street'],
        'zip_code' => $_POST['zip_code'],
        'town_city' => $_POST['town_city'],
        'province' => $_POST['province'],
        // Other student details fields
    ];

    $db = new Database();
    $student = new Student($db);
    $student_id = $student->update($id, $data);

    $db2 = new Database();
    $student_Details1 = new StudentDetails($db2);
    $studentD_id = $student_Details1->update($id, $studentDetailsData);


    // $db = new Database();
    // $student = new StudentDetails($db);
    // $student_id = $student->update($data);



    // if ($student_id) {
    //     // Student record successfully created
        
    //     // Retrieve student details from the form
    //     $studentDetailsData = [
    //         'student_id' => $student_id, // Use the obtained student ID
    //         'contact_number' => $_POST['contact_number'],
    //         'street' => $_POST['street'],
    //         'zip_code' => $_POST['zip_code'],
    //         'town_city' => $_POST['town_city'],
    //         'province' => $_POST['province'],
    //         // Other student details fields
    //     ];
    //     $studentDetails = new StudentDetails($db);

    //     // Call the edit method to update the student data
    //     if ($student->update($id, $studentDetailsData)) {
    //         echo "Record updated successfully.";
    //     } else {
    //         echo "Failed to update the record.";
    //     }
    // }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <title>Edit Student</title>
</head>
<body>
    <!-- Include the header and navbar -->
    <?php include('../templates/header.html'); ?>
    <?php include('../includes/navbar_2.php'); ?>

    <div class="content">
    <h2>Edit Student Information</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $studentData['id']; ?>">
        
        <label for="student_number">Student Number:</label>
        <input type="text" name="student_number" id="student_number" value="<?php echo $studentData['student_number']; ?>">
        
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo $studentData['first_name']; ?>">
        
        <label for="middle_name">Middle Name:</label>
        <input type="text" name= "middle_name" id="middle_name" value="<?php echo $studentData['middle_name']; ?>">
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $studentData['last_name']; ?>">
        
        <label for="last_name">Gender:</label>
        <select name="gender" id="gender" required>
            <option value="0" <?php if ($studentData['gender']==0) {echo "selected";} ?>>Male</option>
            <option value="1" <?php if ($studentData['gender']==1) {echo "selected";} ?>>Female</option>
        </select>
        
        <label for="birthday">Birthdate:</label>
        <input type="text" name="birthday" id="birthday" value="<?php echo $studentData['birthday']; ?>">
        <!-- -------------------------------- -->
        <?php 
            $db = new Database();
            $studentD = new StudentDetails($db);
            $results = $studentD->getAll();
            foreach($results as $result) {
                if ($result['student_id']==$studentData['id']){
                    $studentD_Data = [
                        'student_id' => $studentData['id'],
                        'contact_number' => $result['contact_number'],
                        'street' => $result['street'],
                        'zip_code' => $result['zip_code'],
                        'town_city' => $result['town_city'],
                        'province' => $result['province'],
                    ];
                }
            }
        ?>
        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" value="<?php echo $studentD_Data['contact_number']; ?>" required>

        <label for="street">Street:</label>
        <input type="text" id="street" name="street" value="<?php echo $studentD_Data['street']; ?>" required>

        

        <label for="town_city">Town / City:</label>
        <select name="town_city" id="town_city" required>
        <?php

            $database = new Database();
            $towns = new TownCity($database);
            $results = $towns->getAll();
            foreach($results as $result)
            {
                if ($result['id']==$studentD_Data['town_city']) {
                    echo '<option value="' . $result['id'] . '" selected>' . $result['name'] . '</option>';
                } else {
                    echo '<option value="' . $result['id'] . '">' . $result['name'] . '</option>';
                }
            }
        ?>      
        </select>
        <label for="province">Province:</label>
        <select name="province" id="province" required>
        <?php

            $database = new Database();
            $provinces = new Province($database);
            $results = $provinces->getAll();
            foreach($results as $result)
            {
                if ($result['id']==$studentD_Data['province']) {
                    echo '<option value="' . $result['id'] . '" selected>' . $result['name'] . '</option>';
                } else {
                    echo '<option value="' . $result['id'] . '">' . $result['name'] . '</option>';
                }
            }
        ?>  
        </select>
        <label for="zip_code">Zip Code:</label>
        <input type="text" id="zip_code" name="zip_code" value="<?php echo $studentD_Data['zip_code']; ?>" required>

        <!-- -------------------------------- -->
        <input type="submit" value="Update">
    </form>
    </div>
    <?php include('../templates/footer.html'); ?>
</body>
</html>
