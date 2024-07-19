<?php
session_start();
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Results of Document Search</title>
</head>

<body>
    <h2>Results of Document Search</h2>
    <?php

    if (!isset($_POST['searchtype']) || !isset($_POST['searchterm'])) {
        echo '<p>You have not entered search details.<br/>
Please go back and try again.</p>';
        exit;
    }
    // create short variable names
    $searchtype = $_POST['searchtype'];
    $searchterm = trim($_POST['searchterm']);

    // whitelist the searchtype
    switch ($searchtype) {
        case 'Title':
        case 'Author':
        case 'ISBN':
            break;
        default:
            echo '<p>That is not a valid search type. <br/>
            Please go back and try again.</p>';
            exit;
    }
    //connect to database
    $db = new mysqli('localhost', 'admin', '6070', 'library_db');
    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br/>
       Please try again later.</p>';
        exit;
    }
    $query = "SELECT * FROM document WHERE $searchtype = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $searchterm);
    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($document_code, $title, $author, $publication_year, $category_id, $type_id, $genre_id, $description, $isbn, $status);

    echo "<p>Number of documents found: " . $stmt->num_rows . "</p>";

    //List document details
    while ($stmt->fetch()) {
        echo "<p>Document Code: " . $document_code;
        echo "<br /><strong>Title: " . $title . "</strong>";
        echo "<br />Author: " . $author;
        echo "<br />Publication Year: " . $publication_year;
        switch ($category_id) {
            case 1:
                $category = "novel";
                break;
            case 2:
                $category = "comic";
                break;
            case 3;
                $category = "video game";
                break;
            case 4:
                $category = "DVD";
                break;
            case 5:
                $category = "Blu-ray";
                break;
            case 6;
                $category = "CD";
                break;
            default:
                $category = "";
                break;
        }
        echo "<br />Category: " . $category;
        switch ($type_id) {
            case 1:
                $type = "children";
                break;
            case 2:
                $type = "teens";
                break;
            case 3;
                $type = "adult";
                break;
            default:
                $type = "null";
                break;
        }
        echo "<br />Type: " . $type;
        switch ($genre_id) {
            case 1:
                $genre = "comedy";
                break;
            case 2:
                $genre = "drama";
                break;
            case 3;
                $genre = "fantasy";
                break;
            case 4:
                $genre = "documentary";
                break;
            case 5:
                $genre = "action";
                break;
            case 6;
                $genre = "pop rock";
                break;
            case 7;
                $genre = "musical";
                break;
            default:
                $genre = "";
                break;
        }
        echo "<br />Genre: " . $genre;
        echo "<br />Description: " . $description;
        echo "<br />ISBN: " . $isbn;
        echo "<br /><strong>Status: " . $status . "</strong></p>";

    }

    // Add buttons for loan and request
    //check value of $status
    if ($status == "available") {
        $currentDate = date("Y-m-d");
        $returnDate = date("Y-m-d", strtotime($currentDate . " + 2 weeks"));
        echo "<form action ='createloan.php' method = 'post'>";
        echo "<p><label for='memberCode'>Enter Member Code for a loan: </label>";
        echo "<input type='text' name='memberCode' id='memberCode'/></p>";
        echo "<input type='hidden' name='documentCode' value= '" . $document_code . "'>";
        echo "<button type='submit' name='createLoan'>Loan Document</button>";
        echo "<button type='submit' name='request' disabled>Request Document</button>";
        echo "</form>";
    } else if ($status == "loaned") {
        echo "<form action ='request.php' method = 'post'>";
        echo "<p><label for='memberCode'>Enter Member Code for a request: </label>";
        echo "<input type='text' name='memberCode' id='memberCode'/></p>";
        echo "<input type='hidden' name='documentCode' value= '" . $document_code . "'>";
        echo "<button type='submit' name='createLoan' disabled>Loan Document</button>";
        echo "<button type='submit' name='request'>Request Document</button>";
        echo "</form>";


    } else if ($status == "reserved") {
        echo "<button type='submit' name='createLoan' disabled>Loan Document</button>";
        echo "<button type='submit' name='request' disabled>Request Document</button>";

        echo "<p>Document is reserved. You are unable to loan or request it at this time.</p>";
    }

    $stmt->free_result();
    $db->close();
    
    echo "<br /><a href='member.php'>Return to Member Page</a>";
    echo '<br /><a href="logout.php">Log out</a></p>';

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>