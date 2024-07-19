<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Cancel a Loan</title>
</head>

<body>
    <h2>Loan Cancellation Result</h2>
    <?php
    // check that fields have been filled in
    if (!isset($_POST['loanID']) || !isset($_POST['documentCode'])) {
        //if not isset -> return to loan page
        echo '<p>You have not entered all the information.</p>';
        echo "<a href='loan.php'>Return to Loan Page</a>";
        exit;
    }
    // create variables
    $loanID = trim($_POST['loanID']);
    $documentCode = trim($_POST['documentCode']);
    $currentDate = date('Y-m-d');

    //connect to database 
    $db = new mysqli('localhost', 'admin', '6070', 'library_db');

    if (mysqli_connect_errno()) {
        echo "<p>Error:  Could not connect to database.<br/>
        Please try again later.</p>";
        exit;
    }
    //Remove loan from database
    $query1 = "UPDATE loan SET canceled = ? WHERE loan_id = ?";
    $query2 = "UPDATE document SET status = 'available' WHERE document_code = ? AND status = 'loaned'";
    $query3 = "SELECT member_code FROM request WHERE document_code = ? AND status = 'accepted'";

    $stmt1 = $db->prepare($query1);
    $stmt1->bind_param('ss', $currentDate, $loanID);
    $stmt1->execute();

    if ($stmt1->affected_rows > 0) {
        echo "<p>Loan has been canceled.</p>";
        //Update document table to available if not reserved
        $stmt2 = $db->prepare($query2);
        $stmt2->bind_param('s', $documentCode);
        $stmt2->execute();

        if ($stmt2->affected_rows > 0) {
            echo "<p>Document table has been updated.</p>";
        } else { //end if statement for $stmt2; Document is reserved
            //If document is reserved, show member code
            $stmt3 = $db->prepare($query3);
            $stmt3->bind_param('s', $documentCode);
            $stmt3->execute();
            $stmt3->store_result();

            $stmt3->bind_result($memberCode);

            while ($stmt3->fetch()) {
                echo "<p><p>Document has been requested by Member Code: " . $memberCode . "</p>";
            }

            $stmt3->close();
        }
        $stmt2->close();

    } else { //end if statement for $stmt1
        echo "<p>An error has occurred.<br/>
        Loan has not been canceled.</p>";

    }


    $stmt1->close();

    $db->close();
    echo "<a href='loan.php'>Return to Loan Page</a>";
    echo "<br /><a href='logout.php'>Log out</a></p>";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>