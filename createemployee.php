<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Create employee</title>
</head>

<body>
    <h2>Employee Entry Results</h2>
    <?php
    // check that fields are filled in
    if (!isset($_POST['name']) || !isset($_POST['type']) || !isset($_POST['password'])) {
        //if not isset -> return to employee form
        echo '<p>You have not entered all the information.</p>';
        //header('Location: admin.php');
        echo "<a href='admin.php'>Return to Admin Page</a>";
        exit;
    }

    // create variables
    $name = trim($_POST['name']);
    $type = trim($_POST['type']);
    $password = trim($_POST['password']);

    //connect to database 
    $db = new mysqli('localhost', 'admin', '6070', 'library_db');

    if (mysqli_connect_errno()) {
        echo "<p>Error:  Could not connect to database.<br/>
      Please try again later.</p>";
        exit;
    }

    $query = "INSERT INTO employee(full_name, type, password)
  VALUES (?,?,?)";

    $stmt = $db->prepare($query);
    $stmt->bind_param('sss', $name, $type, $password);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<p>Employee has been added to database.</p>";
        
    } else {
        echo "<p>An error has occurred.<br/>
    Employee has not been added.</p>";
    
    }
    $db->close();
    echo "<a href='admin.php'>Return to Admin Page</a>";
    
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>