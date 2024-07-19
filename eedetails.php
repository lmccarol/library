<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Employee Details</title>

<body>
    <h2>Employee Details</h2>
    <?php
    //check that employee id field has been filled in
    if (!isset($_POST['employeeId'])) {
        echo '<p>You have not entered the employee ID.</p>';
        exit;
    }

    //create variable
    $employeeId = trim($_POST['employeeId']);

    //connect to database
    $db = new mysqli('localhost', 'admin', '6070', 'library_db');

    if (mysqli_connect_errno()) {
        echo "<p>Error:  Could not connect to database.<br/>
                    Please try again later.</p>";
        exit;
    }

    $query = "SELECT employee_id, full_name, type FROM employee WHERE employee_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $employeeId);
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($employeeId, $full_name, $type);

    while ($stmt->fetch()) {
        echo "<p>Employee ID: " . $employeeId;
        echo "<br />Name: " . $full_name;
        echo "<br />Type: " . $type . "</p>";
    }
    $stmt->free_result();
    $db->close();
    echo "<a href='admin.php'>Return to Admin Page</a>";

    ?>
    </head>