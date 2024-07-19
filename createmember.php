<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Create member</title>
</head>

<body>
    <h2>Member Entry Results</h2>
    <?php
    // check that fields are filled in
    if (!isset($_POST['name']) || !isset($_POST['address']) || !isset($_POST['city']) || !isset($_POST['province']) || !isset($_POST['phone']) || !isset($_POST['password'])) {
        //if not isset -> return to member form
        echo '<p>You have not entered all the information.</p>';
        echo "<a href='admin.php'>Return to Admin Page</a>";
        exit;
    }

    // create variables
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $province = trim($_POST['province']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //connect to database 
    $db = new mysqli('localhost', 'admin', '6070', 'library_db');

    if (mysqli_connect_errno()) {
        echo "<p>Error:  Could not connect to database.<br/>
      Please try again later.</p>";
        exit;
    }

    $query = "INSERT INTO member(full_name, address, city, province, phone, email, password)
  VALUES (?,?,?,?,?,?,?)";

    $stmt = $db->prepare($query);
    $stmt->bind_param('sssssss', $name, $address, $city, $province, $phone, $email, $password);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<p>Member has been added to database.</p>";
        
    } else {
        echo "<p>An error has occurred.<br/>
    Member has not been added.</p>";
    
    }
    $db->close();
    echo "<a href='admin.php'>Return to Admin Page</a>";
    
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>