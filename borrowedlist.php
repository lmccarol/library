<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Loans List</title>
</head>

<body>
    <h2>List of Borrowed Documents</h2>
    <?php
    //Connect to datbase
    $db = new mysqli('localhost', 'admin', '6070', 'library_db');
    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br/>
   Please try again later.</p>';
        exit;
    }
    $query = "SELECT loan.loan_id, loan.document_code, document.title FROM loan, document WHERE loan.document_code = document.document_code AND loan.returned_date IS NULL;";
    $result = $db->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>Loan ID: " . $row['loan_id'];
            echo "<br />Document Code: " . $row['document_code'];
            echo "<br />Title: " . $row['title'] . "</p>";
        }
    } else {
        echo "<p>No borrowed documents found.</>";
    }
    $result->free_result();
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