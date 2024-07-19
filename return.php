<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Return page</title>

</head>

<body>
    <h2>Return Results</h2>
    <?php
    // check that fields are filled in
    if (!isset($_POST['documentCode']) || !isset($_POST['memberCode'])) {
        //if not isset -> return to loan page
        echo '<p>You have not entered all the information.</p>';
        echo "<a href='loan.php'>Return to Loan Page</a>";
        exit;
    }
    // create variables
    $memberCode = trim($_POST['memberCode']);
    $documentCode = trim($_POST['documentCode']);
    $returnDate = date('Y-m-d');

    //connect to database 
    $db = new mysqli('localhost', 'admin', '6070', 'library_db');

    if (mysqli_connect_errno()) {
        echo "<p>Error:  Could not connect to database.<br/>
        Please try again later.</p>";
        exit;
    }
    //Update return to document and loan tables
    $query1 = "UPDATE loan SET returned_date = ? WHERE member_code = ? AND document_code = ?";

    $stmt1 = $db->prepare($query1);
    $stmt1->bind_param('sss', $returnDate, $memberCode, $documentCode);
    $stmt1->execute();

    if ($stmt1->affected_rows > 0) {
        echo "<p>Document has been returned.</p>";
        //Change status to available in document table unless it is reserved
        //if document is reserved (see request table) change status from reserved to loaned
        $query2 = "SELECT document_code, member_code FROM request WHERE document_code = ? AND status = 'accepted'";
        $stmt2 = $db->prepare($query2);
        $stmt2->bind_param('s', $documentCode);
        $stmt2->execute();
        $stmt2->store_result(); // Store the result set
        if ($stmt2->num_rows > 0) {
            // Fetch the result
            $stmt2->bind_result($document_code, $member_code);
            $stmt2->fetch();

            // document has been requested by another member
            echo "<p>Document has been requested by: " . $member_code . "</p>";
        } else {
            //document has not been requested
            $query3 = "UPDATE document SET status = 'available' WHERE document_code = ?";
            $stmt3 = $db->prepare($query3);
            $stmt3->bind_param('s', $documentCode);
            $stmt3->execute();


            if ($stmt3->affected_rows > 0) {
                echo "<p>Document status has been changed to 'available'.</p>";
            } else {
                echo "<p>An error has occurred.<br/>
        Document status has not been updated.</p>";
            }
            $stmt3->close();

        }
        $stmt2->close();
    } else {
        echo "<p>An error has occurred.<br/>
        Document has not been returned.</p>";

    }
    $stmt1->close();
    $db->close();
    echo "<a href='loan.php'>Return to Loan Page</a>";
    echo '<br /><a href="logout.php">Log out</a></p>';

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>