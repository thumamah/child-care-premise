<?php
session_start();
include "header.php";
?>
<!doctype html>
<html lang="en">

<head>
  <link rel="icon" type="image/png" href="images/logo_transparent.png" />
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- <!- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <link rel="stylesheet" href="Mystyle.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">



</head>

<body>


  <?php
  // calling connection
  require('/home/s3022041/sqlC/dbConnect.php');

  // select all from fee
  $select_query = "Select * from fee";
  // performing query function
  $select_result = mysqli_query($connection, $select_query);

  // if data availlable then display fee in form
  if (mysqli_num_rows($select_result) > 0) {
    // output data of each row
    // creating array to store fee
    $feeArr = array();
    while ($row = mysqli_fetch_assoc($select_result)) {
      // adding values of fees
      array_push($feeArr, $row['Fee']);
    }
  } else {
  }
  // checking if requested method is post
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // array to store errors
    $errors = false;


    //to get the number of days chosen from drop down menu inside show and hide function
    if ($_POST['Day'] == "fullDay") {
      $time = $_POST["time1"];
    } elseif ($_POST['Day'] == "halfDay") {
      $time = $_POST["time2"];
    } else {
    }

    //checking if any of the values are empty
    if (empty($_POST['babyType'])) {
      $error = true;
      $errors[] = "Baby type is required";
    }
    if (empty($_POST['Day'])) {
      $error = true;
      $errors[] = "Full day or Half Day type is required";
    }
    if (empty($time)) {
      $error = true;
      $errors[] = "Number of days is required";
    }
    if (empty($_POST['userName'])) {
      $errors[] = "User Name is required";
    }
    if (empty($_POST['childName'])) {
      $errors[] = "Child Name is required";
    }
    if (empty($_POST['email'])) {
      $error = true;
      $errors[] = "Email is required";
    } else {
      $email = trim($_POST['email']);
      $regex = '/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
      if (!preg_match($regex, $email)) { //matching the pattern
        $error = true;
        $errors[] = "Invalid Email Address";
      }
    }
    if (empty($_POST['password'])) {
      $error = true;
      $errors[] = "Password is required";
    }

    //when there is zero errors
    if (empty($errors)) {

      function validate($data)
      { //to minimize the error while entering value by the user
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      //to get the number of days chosen from drop down menu inside show and hide function
      if ($_POST['Day'] == "fullDay") {
        $time = $_POST["time1"];
      } elseif ($_POST['Day'] == "halfDay") {
        $time = $_POST["time2"];
      } else {
      }

      // validating inputs
      $babyType = validate($_POST['babyType']);
      $day = validate($_POST['Day']);
      $userName = validate($_POST['userName']);
      $childName = validate($_POST['childName']);
      $email = validate($_POST['email']);
      $password = validate($_POST['password']);

      require('/home/s3022041/sqlC/dbConnect.php');

      //query to check if the email exsits in the table
      $query = "SELECT * FROM child WHERE Email = '$email'";
      $result = mysqli_query($connection, $query);
      //if exists this will be executed
      if (mysqli_num_rows($result) > 0) {
        echo '<div class="succes-msg col-12 col-md-6">
                  <h4>Email already exist</h4>

              </div>';
      } else {
        //print_r($time);
        $query1 = "INSERT INTO `child` (`Category`, `Day`, `Price`, `UserName`, `ChildName`, `Email`, `Password`) VALUES ('$babyType', '$day', '$time', '$userName', '$childName', '$email', '$password');";
        //print_r($query1);
        $insert_result = mysqli_query($connection, $query1);


        // if query successfull
        if ($insert_result) {
         
          echo '<div class="succes-msg col-12 col-md-6">
                            <h4> Registration Successfull </h4>
                            <h4>well get back to you shortly </h4>
                        </div>';

          // sending email function
          $to = '' . $email;
          $subject = 'Registration Confirmation';
          $message = 'Hi ' . $Name . ', '  . "\r\n" . 'Thank you for registration with kiddies Cove.
                        will follow up shortly.
                        you have chosen to register for ' . $time . ' , ' .  $babyType . ' , ' . $day . ' , ' . $time . '
                        your login details are the following :
                        username : ' .  $userName . '
                        Password : ' . $password . '
                          '  . "\r\n" . '
                        Regards,
                        Kiddies Cove Head.';
          $message = wordwrap($message, 70);
          $headers = 'From: KiddiesCove@gmail.com' . "\r\n" . 'Reply-To: KiddiesCove@gmail.com' .
            "\r\n" . 'X-Mailer: PHP/' . phpversion();
          // send
          mail($to, $subject, $message, $headers);
        } else {
          echo '<div class="succes-msg col-12 col-md-6">
                            <h4>Message Not Sent </h4>

                        </div>';
        }
      }
    }
  } else { //printing out the errors if the value are not valid
    $errors[] = $err;
  }

  ?>
  <?php
  // if not submitted then show form
  if (!isset($_POST['add']) || (!empty($error))) {
  ?>
    <div id="container2" class="container py-5 col-12 col-md-6">
      <form id="myform" action="registration.php" method="POST" class="main-form">
        <h1> Child Registration Form </h1>
        <p> Choose the category of your Child </p>
        <select name="babyType" id="babyType" class="form-control"> //drop down menu for the baby type
          <option value="">--Select Baby Type--</option>
          <option value="baby"> Baby</option>
          <option value="wobbler"> Wobbler </option>
          <option value="toddler"> Toddler </option>
          <option value="preschool"> Preschool </option>
        </select>

        <p> Choose the length of the day and the number of days </p>
        <input type="radio" name="Day" id="type1" required="input" value="fullDay" onclick="func();" />
        <label for="kid1"> Full day </label>
        <fieldset id="dayCareInfo1" class="reg-option">
          <select name="time1" id="time1" style="display:none" class="form-control">
            <option value="">--Select Number of Days--</option>
            <option value="<?php echo $feeArr[0]; ?>"> 1 day ($<?php echo $feeArr[0]; ?>)</option>
            <option value="<?php echo $feeArr[1]; ?>"> 3 days ($<?php echo $feeArr[1]; ?>) </option>
            <option value="<?php echo $feeArr[2]; ?>"> 5 days ($<?php echo $feeArr[2]; ?>) </option>
          </select>
        </fieldset>

        <br>
        <input type="radio" name="Day" id="type2" required="input" value="halfDay" onclick="func();" />
        <label for="kid2"> Half day </label>
        <fieldset id="dayCareInfo2" class="reg-option">
          <select name="time2" id="time2" style="display:none" class="form-control">
            <option value="">--Select Number of Days--</option>
            <option value="<?php echo $feeArr[3]; ?>"> 1 day ($<?php echo $feeArr[3]; ?>)</option>
            <option value="<?php echo $feeArr[4]; ?>"> 3 days ($<?php echo $feeArr[4]; ?>) </option>
            <option value="<?php echo $feeArr[5]; ?>"> 5 days ($<?php echo $feeArr[5]; ?>) </option>
          </select>
        </fieldset>

        <br>
        UserName: <input type="text" name="userName" required="input" value="" class="form-control" />
        ChildName: <input type="text" name="childName" required="input" value="" class="form-control" />
        Email: <input type="email" name="email" required="input" value="" class="form-control" />
        Password: <input type="password" name="password" required="input" value="" class="form-control" />
        <input type="hidden" name="role" value="user" class="form-control" />
        <br>
        <button type="submit" name="add" class="btn btn-primary"> Submit </button>

        <?php
        if (isset($errors)) {
          foreach ($errors as $err) {  // looping through errors
            echo "<h4><strong style='color:red;'>$err</strong></h4>" . "<br>";
          }
        }
        ?>
      </form>
    <?php
  }
    ?>

    </div>

    <?php
    include "footer.html"
    ?>
    <script src="script.js">
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>
</body>

</html>