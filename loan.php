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
    <title>Loan page</title>
    <style>
        section {
            padding: 50px 0;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-xxl">
            <a href="#intro" class="navbar-brand">
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
                        <a class="nav-link" href="employee.php">Employee Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--intro to loan page-->
    <section id="intro">
        <div class="container-lg">
            <div class="row justify-content-center align-items-center">
                <div class="col md-5 text-center text-md-start text-primary">
                    <h2>Loan Page</h2>

                    <p class="lead my-3">Please choose one of the following options: </p>
                    <!--<div class="d-grid gap-2 d-md-block">-->
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <a href="#loan" class="btn btn-secondary btn-lg">Loan a document</a>
                        <a href="#return" class="btn btn-secondary btn-lg">Return a document</a>
                        <a href="#cancelloan" class="btn btn-secondary btn-lg">Cancel a loan</a>
                        <a href="#cancelrequest" class="btn btn-secondary btn-lg">Cancel a request</a>
                        <a href="lateloans.php" class="btn btn-secondary btn-lg">List of loans that are late</a>
                        <a href="borrowedlist.php" class="btn btn-secondary btn-lg">List of borrowed documents</a>
                        <a href="requestedlist.php" class="btn btn-secondary btn-lg">List of requested documents</a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--process a loan-->
    <section id="loan">

        <div class="container-lg">
            <div class="row justify-content-center align-items-center">
                <div class="col md-5 text-center text-md-start">
                    <div class="text-center">
                        <h2><span><i class="bi bi-bookmark-plus"></i></span>Loan a document</h2>

                        <p class="lead">Please fill out the form for a loan: </p>
                    </div>
                    <div class="row justify-content-center my-5">
                        <div class="col-lg-6">
                            <!--form to search document and check availability-->
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

                    </div>
                </div>
            </div>
    </section>

    <!--return a document-->
    <section id="return">
        <div class="container-lg">
            <div class="row justify-content-center align-items-center">
                <div class="col md-5 text-center text-md-start">
                    <div class="text-center">
                        <h2><span><i class="bi bi-arrow-return-left"></i></span>Return a document</h2>
                        <p class="lead">Please fill out the form for the document to be returned: </p>
                    </div>
                    <div class="row justify-content-center my-5">
                        <div class="col-lg-6">
                            <form action="return.php" method="post">
                                <label for="memberCode" class="form-label">Member Code:</label>
                                <div class="mb-4 input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="text" class="form-control" id="memberCode" name="memberCode"
                                        placeholder="e.g. 1000" required>
                                    <!-- tooltip -->
                                    <span class="input-group-text">
                                        <span class="tt" data-bs-placement="bottom" title="Please enter member code.">
                                            <i class="bi bi-question-circle text-muted"></i>
                                        </span>
                                    </span>
                                </div>
                                <label for="documentCode" class="form-label">Document Code:</label>
                                <div class="mb-4 input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-book-fill"></i>
                                    </span>
                                    <input type="text" class="form-control" id="documentCode" name="documentCode"
                                        placeholder="e.g. 1" required>
                                    <!-- tooltip -->
                                    <span class="input-group-text">
                                        <span class="tt" data-bs-placement="bottom" title="Please enter document code.">
                                            <i class="bi bi-question-circle text-muted"></i>
                                        </span>
                                    </span>
                                </div>

                                <div>
                                    <br><br>
                                    <button type="submit" class="btn btn-secondary btn-lg"
                                        value="Submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--cancel a loan-->
    <section id="cancelloan">
        <div class="container-lg">
            <div class="row justify-content-center align-items-center">
                <div class="col md-5 text-center text-md-start">
                    <div class="text-center">
                        <h2><span><i class="bi bi-x-circle"></i></span>Cancel a loan</h2>
                        <p class="lead">Please fill out the form for the loan to be canceled: </p>
                    </div>
                    <div class="row justify-content-center my-5">
                        <div class="col-lg-6">
                            <form action="cancelloan.php" method="post">
                                <label for="loanID" class="form-label">Loan ID:</label>
                                <div class="mb-4 input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-hash"></i>
                                    </span>
                                    <input type="text" class="form-control" id="loanID" name="loanID"
                                        placeholder="e.g. 1" required>
                                    <!-- tooltip -->
                                    <span class="input-group-text">
                                        <span class="tt" data-bs-placement="bottom" title="Please enter Loan ID.">
                                            <i class="bi bi-question-circle text-muted"></i>
                                        </span>
                                    </span>
                                </div>
                                <label for="documentCode" class="form-label">Document Code:</label>
                                <div class="mb-4 input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-book-fill"></i>
                                    </span>
                                    <input type="text" class="form-control" id="documentCode" name="documentCode"
                                        placeholder="e.g. 1" required>
                                    <!-- tooltip -->
                                    <span class="input-group-text">
                                        <span class="tt" data-bs-placement="bottom" title="Please enter Document Code.">
                                            <i class="bi bi-question-circle text-muted"></i>
                                        </span>
                                    </span>
                                </div>


                                <div>
                                    <br><br>
                                    <button type="submit" class="btn btn-secondary btn-lg"
                                        value="Submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--cancel a request-->
    <section id="cancelrequest">
        <div class="container-lg">
            <div class="row justify-content-center align-items-center">
                <div class="col md-5 text-center text-md-start">
                    <div class="text-center">
                        <h2><span><i class="bi bi-x-circle"></i></span>Cancel a request</h2>
                        <p class="lead">Please fill out the form for the request to be canceled: </p>
                    </div>
                    <div class="row justify-content-center my-5">
                        <div class="col-lg-6">
                            <form action="cancelrequest.php" method="post">
                                <label for="documentCode" class="form-label">Document Code:</label>
                                <div class="mb-4 input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-book-fill"></i>
                                    </span>
                                    <input type="text" class="form-control" id="documentCode" name="documentCode"
                                        placeholder="e.g. 1" required>
                                    <!-- tooltip -->
                                    <span class="input-group-text">
                                        <span class="tt" data-bs-placement="bottom" title="Please enter Document Code.">
                                            <i class="bi bi-question-circle text-muted"></i>
                                        </span>
                                    </span>
                                </div>
                                <label for="memberCode" class="form-label">Member Code:</label>
                                <div class="mb-4 input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="text" class="form-control" id="memberCode" name="memberCode"
                                        placeholder="e.g. 1000" required>
                                    <!-- tooltip -->
                                    <span class="input-group-text">
                                        <span class="tt" data-bs-placement="bottom" title="Please enter Member Code.">
                                            <i class="bi bi-question-circle text-muted"></i>
                                        </span>
                                    </span>
                                </div>
                                <div>
                                    <br><br>
                                    <button type="submit" class="btn btn-secondary btn-lg"
                                        value="Submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>