<?php
// starting session
session_start();
// if not logged in as admin then go to login page
if (!(($_SESSION['Admin']))) {
  header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Kiddies Cove</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <?php
  include "sidebar.php";
  ?>

  <?php
  // calling connection
  require('/home/s3022041/sqlC/dbConnect.php');
  // selecting all from fee table
  $select_query = "Select * from fee";
  $select_result = mysqli_query($connection, $select_query);

  // if fee values availabe then get thier values 
  if (mysqli_num_rows($select_result) > 0) {
    // output data of each row
    $feeArr = array();
    while ($row = mysqli_fetch_assoc($select_result)) {
      array_push($feeArr, $row['Fee']);
      // $Full1Day = $row[0]['Fee'];
      // $Full3Day = $row[1]['Fee'];
      // $Full5Day = $row[2]['Fee'];
      // $Half1Day = $row[3]['Fee'];
      // $Half3Day = $row[4]['Fee'];
      // $Half5Day = $row[5]['Fee'];
    }
    // else add the values
  } else {
  }
  echo "<div id='container2' class='container py-5 col-12 col-md-6'>
  <form id = 'myform' action='registration_edit.php' method='POST' class='main-form'>
           <h1> Child Registration Form </h1>
           <p> Choose the category of your Child </p>
             <p> Choose the length of the day and the number of days </p>
             <label for ='kid1'> Full day </label>
             <div class='row'>
                <div class='col'>1 Day:</div>
                <div class='col'> <input type = 'number' name = 'f1day' required='input'  value='$feeArr[0]' class='form-control'/></div>
                <div class='col'>3 Day:</div>
                <div class='col'> <input type = 'number' name = 'f3day' required='input'  value='$feeArr[1]' class='form-control'/></div>
                <div class='col'>5 Day:</div>
                <div class='col'> <input type = 'number' name = 'f5day' required='input'  value='$feeArr[2]' class='form-control'/></div>
              </div>
               <br>

               <label for ='kid2'> Half day </label>
               <div class='row'>
                  <div class='col'>1 Day:</div>
                  <div class='col'> <input type = 'number' name = 'h1day' required='input'  value='$feeArr[3]' class='form-control'/></div>
                  <div class='col'>3 Day:</div>
                  <div class='col'> <input type = 'number' name = 'h3day' required='input'  value='$feeArr[4]' class='form-control'/></div>
                  <div class='col'>5 Day:</div>
                  <div class='col'> <input type = 'number' name = 'h5day' required='input'  value='$feeArr[5]' class='form-control'/></div>
                </div>
               <br>
               <button type = 'submit' name='add' class='btn btn-primary' onclick='reload();'> Submit </button>
               </form>";

  // using the require function to call the connection


  // if add button pressed then add values
  if (isset($_POST['add'])) {
    $Full1Day = $feeArr[0] = $_POST['f1day'];
    $Full3Day = $feeArr[1] = $_POST['f3day'];
    $Full5Day = $feeArr[2] = $_POST['f5day'];
    $Half1Day = $feeArr[3] = $_POST['h1day'];
    $Half3Day = $feeArr[4] = $_POST['h3day'];
    $Half5Day = $feeArr[5] = $_POST['h5day'];

    // echo  $babyType;
    // echo  $Full1Day;
    // echo  $Full3Day;
    // echo  $Full5Day ;
    // echo  $Half1Day;
    // echo  $Half3Day;
    // echo  $Half5Day;

    // if requested method is post
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

      $errors = false;
      // checking for empty feilds
      if (empty($_POST['f1day'])) {
        $error = true;
        $errors[] = "1 day full time is required";
      }

      if (empty($_POST['f3day'])) {
        $error = true;
        $errors[] = "3 days full time fee is required";
      }

      if (empty($_POST['f5day'])) {
        $error = true;
        $errors[] = "5 days full time fee is required";
      }

      if (empty($_POST['h1day'])) {
        $error = true;
        $errors[] = "1 day half time fee is required";
      }

      if (empty($_POST['h3day'])) {
        $error = true;
        $errors[] = "3 day half time fee is required";
      }

      if (empty($_POST['h5day'])) {
        $error = true;
        $errors[] = "5 day half time fee is required";
      }

      if (empty($errors)) {
        function validate($data)
        {
          //to minimize the error while entering value by the user
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

        $Full1Day = validate($_POST['f1day']);
        $Full3Day = validate($_POST['f3day']);
        $Full5Day = validate($_POST['f5day']);
        $Half1Day = validate($_POST['h1day']);
        $Half3Day = validate($_POST['h3day']);
        $Half5Day = validate($_POST['h5day']);


        // query to delete previous fee value 
        $delete_query = "DELETE FROM `fee`";
        $delete_result = mysqli_query($connection, $delete_query);
        // query to insert into new fee value
        $insert_query = "INSERT INTO  `fee`(`ID`,`Fee`, `Day`, `Duration`)
             VALUES
             (1, '$Full1Day', 'fullDay', '1'),
             (2, '$Full3Day', 'fullDay', '3'),
             (3, '$Full5Day', 'fullDay', '5'),
             (4, '$Half1Day', 'halfDay', '1'),
             (5, '$Half3Day', 'halfDay', '3'),
             (6, '$Half5Day', 'halfDay', '5')";
        $insert_result = mysqli_query($connection, $insert_query);
      }
    }
  }


  ?>


  </div>
  <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  <!-- Footer -->
  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; Your Website 2020</span>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../script.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>