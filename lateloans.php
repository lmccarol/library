<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Late Loans List</title>
</head>

<body>
    <h2>List of Late Loans</h2>
    <?php
    $currentDate = date('Y-m-d');
    echo '<p>Current Date is: ' . $currentDate;
    //Connect to datbase
    $db = new mysqli('localhost', 'admin', '6070', 'library_db');
    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br/>
   Please try again later.</p>';
        exit;
    }
    $query = "SELECT loan_id, member_code, document_code, expected_return_date FROM loan WHERE expected_return_date < ? AND returned_date IS NULL AND canceled IS NULL";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $currentDate);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($loan_id, $member_code, $document_code, $expected_return_date);
    if ($stmt->num_rows > 0) {
        echo "<p>Number of late loans found: " . $stmt->num_rows . "</p>";
        while ($stmt->fetch()) {
            echo "<p>Loan ID: " . $loan_id;
            echo "<br />Member Code: " . $member_code;
            echo "<br />Document Code: " . $document_code;
            echo "<br />Expected Return Date: " . $expected_return_date . "</p>";
        }
    } else {
        echo "<p>No late loans found.</p>";
    }
    $stmt->close();
    $db->close();
    echo "<br /><a href='employee.php'>Return to Employee Page</a>";
    echo "<br /><a href='loan.php'>Return to Loan Page</a>";
    echo '<br /><a href="logout.php">Log out</a></p>';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>