<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styles.css">

    <title>Employee page</title>
    <style>
        section {
            padding: 50px 0;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-xxl">
            <a href="#" class="navbar-brand">
                <span class="fw-bold text-secondary">
                    <i class="bi bi-book-half"></i>
                    Port-Cartier Municipal Library
                </span>
            </a>
            <!--toggle button for mobile nav -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- navbar link-->
            <div class="collapse navbar-collapse justify-content-end align-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="loan.php">Loan Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--intro to employee page-->
    <section id="intro">

        <div class="container-lg">
            <div class="row justify-content-center align-items-center">
                <div class="col md-5 text-center text-md-start text-primary">
                    <h2>Employee Page</h2>
                </div>
                <div class="col md-5 text-center d-none d-md-block">

                    <!--tooltip tt-->
                    <span class="tt" data-bs-placement="bottom" title="books image">
                        <img class="img-fluid" src="assets/books.png" alt="Port-Cartier">
                    </span>
                </div>
                <?php
                // check session variable
                if (isset($_SESSION['valid_user'])) {
                    echo '<p>You are logged in with your code: ' . $_SESSION['valid_user'] . '.</p>';
                } else {
                    echo '<p>You are not logged in.</p>';
                }
                ?>
                <p class="lead my-3">Please choose one of the following options: </p>
                <div class="d-grid gap-2 d-md-block">
                    <a href="#member" class="btn btn-secondary btn-lg">View member details</a>
                    <a href="memberlist.php" class="btn btn-secondary btn-lg">List of members</a>
                    <a href="documentlist.php" class="btn btn-secondary btn-lg">List of documents</a>
                    <a href="member.php" class="btn btn-secondary btn-lg">Document Search</a>
                </div>

            </div>
        </div>
    </section>

    <!--section for member details, include active loans and requests-->
    <section id="member">
        <div class="container-lg">
            <div class="text-center">
                <h2><span><i class="bi bi-person-fill"></i></span> Member Details</h2>
            </div>
            <div class="row justify-content-center my-5">
                <div class="col-lg-6">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        // form has been submitted, process the data
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
                            case 'member_code':
                            case 'full_name':
                                break;
                            default:
                                echo '<p>That is not a valid search type. <br/>
        Please go back and try again.</p>';
                                exit;
                        }
                        //connect to database 
                        $db = new mysqli('localhost', 'admin', '6070', 'library_db');

                        if (mysqli_connect_errno()) {
                            echo "<p>Error:  Could not connect to database.<br/>
      Please try again later.</p>";
                            exit;
                        }

                        $query1 = "SELECT * FROM member WHERE $searchtype = ?";
                        $query2 = "SELECT * FROM loan WHERE member_code = ? AND returned_date IS NULL AND canceled IS NULL";
                        $query3 = "SELECT * FROM request WHERE member_code = ? AND status = 'accepted'";

                        $stmt1 = $db->prepare($query1);
                        $stmt1->bind_param("s", $searchterm);
                        $stmt1->execute();
                        $stmt1->store_result();

                        $stmt1->bind_result($member_code, $full_name, $address, $city, $province, $phone, $email, $password);
                        //display results of first query
                        while ($stmt1->fetch()) {
                            echo "<p>Member Code: " . $member_code;
                            echo "<br /><strong>Name: " . $full_name . "</strong>";
                            echo "<br />Address: " . $address;
                            echo "<br />City: " . $city;
                            echo "<br />Province: " . $province;
                            echo "<br />Phone: " . $phone;
                            echo "<br />Email: " . $email . "</p>";
                        }

                        $stmt2 = $db->prepare($query2);
                        $stmt2->bind_param("s", $member_code);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();

                        // Display the results of the second query
                        while ($row = $result2->fetch_assoc()) {
                            echo "<p>Loan ID: " . $row['loan_id'];
                            echo "<br />Document Code: " . $row['document_code'];
                            echo "<br />Loan Date: " . $row['loan_date'];
                            echo "<br />Expected Return Date: " . $row['expected_return_date'] . "</p>";
                        }

                        //display results of third query
                        $stmt3 = $db->prepare($query3);
                        $stmt3->bind_param("s", $member_code);
                        $stmt3->execute();
                        $result3 = $stmt3->get_result();

                        while ($row = $result3->fetch_assoc()) {
                            echo "<p>Document Code: " . $row['document_code'];
                            echo "<br />Request Date: " . $row['request_date'] . "</p>";
                        }


                        $stmt1->free_result();
                        $stmt2->close();
                        $stmt3->close();
                        $db->close();

                        // display the form again
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <!-- form fields go here -->
                            <p><strong>Choose Search Type:</strong><br />
                                <select name="searchtype">
                                    <option value="member_code">Member Code</option>

                                    <option value="full_name">Full Name</option>
                                </select>
                            </p>
                            <label for="name" class="form-label"><strong>Search Term:</strong></label>
                            <div class="mb-4 input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-info-circle"></i>
                                </span>
                                <input type="text" class="form-control" id="searchterm" name="searchterm" required>
                                <!-- tooltip tt-->
                                <span class="input-group-text">
                                    <span class="tt" data-bs-placement="bottom"
                                        title="Please enter member code or full name.">
                                        <i class="bi bi-question-circle text-muted"></i>
                                    </span>
                                </span>
                            </div>

                            <p><input type="submit" name="submit" value="Search"></p>
                        </form>
                        <?php
                    } else {
                        // form has not been submitted, display the form
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <!-- form fields go here -->

                            <p><strong>Choose Search Type:</strong><br />
                                <select name="searchtype">
                                    <option value="member_code">Member Code</option>

                                    <option value="full_name">Full Name</option>
                                </select>
                            </p>
                            <label for="name" class="form-label"><strong>Search Term:</strong></label>
                            <div class="mb-4 input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-info-circle"></i>
                                </span>
                                <input type="text" class="form-control" id="searchterm" name="searchterm" required>
                                <!-- tooltip tt-->
                                <span class="input-group-text">
                                    <span class="tt" data-bs-placement="bottom"
                                        title="Please enter member code or full name.">
                                        <i class="bi bi-question-circle text-muted"></i>
                                    </span>
                                </span>
                            </div>

                            <p><input type="submit" name="submit" value="Search"></p>
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        const tooltips = document.querySelectorAll('.tt')
        tooltips.forEach(t => {
            new bootstrap.Tooltip(t)
        })
    </script>

</body>

</html>