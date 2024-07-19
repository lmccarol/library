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

    <title>Member page</title>
</head>

<body>
    <!--nav bar-->
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-xxl">
            <a href="#" class="navbar-brand">
                <span class="fw-bold text-secondary">
                    <i class="bi bi-book-half"></i>
                    Port-Cartier Municipal Library
                </span>
            </a>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>

        </div>
    </nav>
    <div class="container-lg">
        <div class="row justify-content-center align-items-center">
            <div class="col md-5 text-center text-md-start text-primary">
                <h2>Search for a document</h2>
                
                <?php
                // check session variable
                if (isset($_SESSION['valid_user'])) {
                    echo '<p>You are logged in with your code: ' . $_SESSION['valid_user'] . '.</p>';

                } else {
                    echo '<p>You are not logged in.</p>';
                    echo '<a href="home.html">Return to home page.</a>';
                }
                ?>
            </div>

            <div class="container-lg">
                <div class="row justify-content-center my-5">
                    <div class="col-lg-6">
                        <!--form to search document-->
                        <form action="documentsearch.php" method="post">
                            <p><strong>Choose Search Type:</strong><br />
                                <select name="searchtype">
                                    <option value="Title">Title</option>

                                    <option value="Author">Author or Producer</option>
                                    <option value="ISBN">ISBN</option>
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
                                        title="Please enter a title, author/producer or ISBN.">
                                        <i class="bi bi-question-circle text-muted"></i>
                                    </span>
                                </span>
                            </div>

                            <p><input type="submit" name="submit" value="Search"></p>
                        </form>
                    </div>
                    <div class="col md-5 text-center d-none d-md-block">
                        <!--tooltip tt-->
                        <span class="tt" data-bs-placement="bottom" title="books image">
                            <img class="img-fluid" src="assets/books.png" alt="Port-Cartier">
                        </span>
                    </div>
                </div>
            </div>
        </div>


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