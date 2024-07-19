<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Login</title>
</head>

<body>
  <?php
  session_start();

  // create variables
  $code = trim($_POST['code']);
  $password = trim($_POST['psw']);
  $role = $_POST['btnradio'];

  if (!isset($_POST['code'])) {
    //if not isset -> return to home page
    echo '<p>You have not entered your code.</p>';
    echo "<a href='home.html'>Return to Login</a>";
    exit;
  }
  if (!isset($_POST['psw'])) {
    //if not isset -> return to home page
    echo '<p>You have not entered your password.</p>';
    echo "<a href='home.html'>Return to Login</a>";
    exit;
  }

  //connect to database 
  $db = new mysqli('localhost', 'admin', '6070', 'library_db');

  if (mysqli_connect_errno()) {
    echo "<p>Error:  Could not connect to database.<br/>
      Please try again later.</p>";
    exit;
  }
  //Validate usernames and passwords
  
  // Redirect users based on their roles
  if ($role === 'member') {
    $query = "select * from member where member_code ='" . $code . "' and  password='" . $password . "'";

    $result = $db->query($query);

    if ($result->num_rows) {
      // if they are in the database register the user name
      $_SESSION['valid_user'] = $code;
    }
    $db->close();
    if (isset($_SESSION['valid_user'])) {
      // send logged in member to member page
      header('Location: member.php');
      } else {
        if (isset($code)) {
          // member has tried to log in and failed
          echo '<p>Could not log you in.</p>';
          echo '<p><a href="home.html">Return to home page.</a></p>';

        } else {
          //they have not tried to log in yet or have logged out
          echo '<p>You are not logged in.</p>';
          echo '<p><a href="home.html">Return to home page.</a></p>';

        }
    }
  } elseif ($role === 'employee') {
    //query the employee table to see if valid user
    $query1 = "select * from employee where employee_id ='" . $code . "' and  password='" . $password . "'";
    $result = $db->query($query1);

    if ($result->num_rows) {
      // if they are in the database register the user name
      $_SESSION['valid_user'] = $code;
    }
    $db->close();
    if (isset($_SESSION['valid_user'])) {
      //send logged in employee to employee page
      header('Location: employee.php');
    } else {
      if (isset($code)) {
        // employee has tried to log in and failed
        echo '<p>Could not log you in.</p>';
        echo '<p><a href="home.html">Return to home page.</a></p>';

      } else {
        //they have not tried to log in yet or have logged out
        echo '<p>You are not logged in.</p>';
        echo '<p><a href="home.html">Return to home page.</a></p>';

      }
    }
  } elseif ($role === 'admin') {
   //query the employee table to see if valid admin user
   $query1 = "select * from employee where employee_id ='" . $code . "' and  password='" . $password . "'";
   $result = $db->query($query1);

   if ($result->num_rows) {
     // if they are in the database register the user name
     $_SESSION['valid_user'] = $code;
   }
    $db->close();
    if (isset($_SESSION['valid_user'])) {
      //send logged in admin to admin page
      header('Location: admin.php');
  } else {
    if (isset($code)) {
      // admin has tried to log in and failed
      echo '<p>Could not log you in.</p>';
      echo '<p><a href="home.html">Return to home page.</a></p>';

    } else {
      //they have not tried to log in yet or have logged out
      echo '<p>You are not logged in.</p>';
      echo '<p><a href="home.html">Return to home page.</a></p>';

    }
  }
  } else {
    // Handle invalid role or login failure
    echo '<p>Invalid code or password.</p>';
    echo '<a href="home.html">Return to Login</a>';
    exit;
  }
  ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>