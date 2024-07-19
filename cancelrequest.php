<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Cancel a Request</title>
</head>

<body>
    <h2>Request Cancellation Result</h2>
    <?php
    // check that fields are filled in
    if (!isset($_POST['memberCode']) || !isset($_POST['documentCode'])) {
        //if not isset -> return to loan page
        echo '<p>You have not entered all the information.</p>';
        echo "<a href='loan.php'>Return to Loan Page</a>";
        exit;
    }
    // create variables
    $memberCode = trim($_POST['memberCode']);
    $documentCode = trim($_POST['documentCode']);

    //connect to database 
    $db = new mysqli('localhost', 'admin', '6070', 'library_db');

    if (mysqli_connect_errno()) {
        echo "<p>Error:  Could not connect to database.<br/>
        Please try again later.</p>";
        exit;
    }
    //cancel request in database
    $query1 = "UPDATE request SET status = 'canceled' WHERE document_code = ? AND member_code = ?";
    //Update document to 'loaned'
    $query2 = "UPDATE document SET status = 'loaned' WHERE document_code = ?";

    $stmt1 = $db->prepare($query1);
    $stmt1->bind_param('ss', $documentCode, $memberCode);
    $stmt1->execute();

    if ($stmt1->affected_rows > 0) {
        echo "<p>Request has been canceled.</p>";
        $stmt2 = $db->prepare($query2);
        $stmt2->bind_param('s', $documentCode);
        $stmt2->execute();

        if ($stmt2->affected_rows > 0) {
            echo "<p>Document status has been changed to loaned.";
        } else {
            echo "<p>An error has occurred.<br/>
        Document status has not been changed.</p>";
        }
        $stmt2->close();
    } else {
        echo "<p>An error has occurred.<br/>
        Request has not been canceled.</p>";

    }
    $stmt1->close();
    $db->close();
    echo "<br /><a href='loan.php'>Return to Loan Page</a>";
    echo "<br /><a href='logout.php'>Log out</a></p>";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>