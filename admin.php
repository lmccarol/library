<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Administration page</title>
    <style>
        section {
            padding: 50px 0;
        }
    </style>
</head>

<body>
    <!--nav bar-->
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
                        <a class="nav-link" href="loan.php">Loan Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--intro to admin page-->
    <section id="intro">
        <div class="container-lg">
            <div class="row justify-content-center align-items-center">
                <div class="col md-5 text-center text-md-start text-primary">
                    <h2>Administration Page</h2>
                    <?php
                    // check session variable
                    if (isset($_SESSION['valid_user'])) {
                        echo '<p>You are logged in as ' . $_SESSION['valid_user'] . '.</p>';
                    } else {
                        echo '<p>You are not logged in.</p>';
                    }
                    ?>
                    <p class="lead my-3">Please choose one of the following options: </p>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="#member" class="btn btn-secondary btn-lg">Add a member</a>
                        <a href="#employee" class="btn btn-secondary btn-lg">Add an employee</a>
                        <a href="#eedetails" class="btn btn-secondary btn-lg">View employee details</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!--add a member-->
    <section id="member">
        <div class="container-lg">
            <div class="text-center">
                <h2><span><i class="bi bi-person-plus-fill"></i></span> Add a Member to the Library</h2>
                <p class="lead">Please fill out the form: </p>
            </div>
            <div class="row justify-content-center my-5">
                <div class="col-lg-6">
                    <form action="createmember.php" method="post">
                        <label for="name" class="form-label">Name:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Jane Doe"
                                required>
                            <!-- tooltip tt-->
                            <span class="input-group-text">
                                <span class="tt" data-bs-placement="bottom" title="Please enter full name.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>
                        <label for="address" class="form-label">Street Address:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-signpost"></i>
                            </span>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="e.g. 15 Main St." required>
                            <!-- tooltip tt-->
                            <span class="input-group-text">
                                <span class="tt" data-bs-placement="bottom"
                                    title="Please enter number and street address.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>
                        <label for="city" class="form-label">City:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-buildings"></i>
                            </span>
                            <input type="text" class="form-control" id="city" name="city" placeholder="e.g. Montreal"
                                required>
                            <!-- tooltip tt-->
                            <span class="input-group-text">
                                <span class="tt" data-bs-placement="bottom" title="Please enter city.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>
                        <label for="province" class="form-label">Province:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-geo-alt-fill"></i>
                            </span>
                            <input type="text" class="form-control" id="province" name="province"
                                placeholder="e.g. Quebec" required>
                            <!-- tooltip tt-->
                            <span class="input-group-text">
                                <span class="tt" data-bs-placement="bottom" title="Please enter province.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>
                        <label for="phone" class="form-label">Phone Number:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-telephone"></i>
                            </span>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="e.g. (000)000-0000" required>
                            <!-- tooltip tt-->
                            <span class="input-group-text">
                                <span class="tt" data-bs-placement="bottom" title="Please enter phone number.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>

                        <label for="email" class="form-label">Email address:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="e.g. name@example.com">
                            <!-- tooltip tt-->
                            <span class="input-group-text">
                                <span class="tt" data-bs-placement="bottom"
                                    title="Please enter an email address we can reply to.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>
                        <label for="password" class="form-label">Password:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                            <input type="text" class="form-control" id="password" name="password"
                                placeholder="e.g. xxxx" required>
                            <!-- tooltip tt-->
                            <span class="input-group-text">
                                <span class="tt" data-bs-placement="bottom" title="Please enter password.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>
                        <div>
                            <br><br>
                            <button type="submit" class="btn btn-secondary btn-lg" value="Submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- add an employee -->
    <section id="employee">
        <div class="container-lg">
            <div class="text-center">
                <h2><span><i class="bi bi-person-fill-add"></i></span> Add an Employee to the Database</h2>
                <p class="lead">Please fill out the form: </p>
            </div>
            <div class="row justify-content-center my-5">
                <div class="col-lg-6">
                    <form action="createemployee.php" method="post">
                        <label for="name" class="form-label">Name:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Jane Doe"
                                required>
                            <!-- tooltip tt-->
                            <span class="input-group-text">
                                <span class="tt" data-bs-placement="bottom" title="Please enter full name.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>
                        <label for="type" class="form-label">Type of employee:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-rolodex"></i>
                            </span>
                            <select class="form-select" id="type" name="type">
                                <option selected>Open this select menu</option>
                                <option value="regular">Regular</option>
                                <option value="admin">Admin</option>
                            </select>
                            <!-- tooltip tt-->
                            <span class="input-group-text">
                                <span class="tt" data-bs-placement="bottom" title="Please select Regular or Admin.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>
                        <label for="password" class="form-label">Password:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                            <input type="text" class="form-control" id="password" name="password"
                                placeholder="e.g. xxxx" required>
                            <!-- tooltip tt-->
                            <span class="input-group-text">
                                <span class="tt" data-bs-placement="bottom" title="Please enter password.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>
                        <div>
                            <br><br>
                            <button type="submit" class="btn btn-secondary btn-lg" value="Submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!--employee details -->
    <section id="eedetails">
        <div class="container-lg">
            <div class="text-center">
                <h2><span><i class="bi bi-eye"></i></span> View Employee details</h2>
                <p class="lead">Please fill out the form: </p>
            </div>
            <div class="row justify-content-center my-5">
                <div class="col-lg-6">
                    <form action="eedetails.php" method="post">
                        <label for="employeeId" class="form-label">Employee ID:</label>
                        <div class="mb-4 input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" class="form-control" id="employeeId" name="employeeId"
                                placeholder="Enter employee ID" required>
                            <!-- tooltip tt-->
                            <span class="input-group-text">
                                <span class="tt" data-bs-placement="bottom"
                                    title="Please enter employee ID to view details.">
                                    <i class="bi bi-question-circle text-muted"></i>
                                </span>
                            </span>
                        </div>
                        <div>
                            <br><br>
                            <button type="submit" class="btn btn-secondary btn-lg" value="Submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        
</body>

</html>