<?php

// starting session
session_start();
// calling connection
require('/home/s3022041/sqlC/dbConnect.php');
//include "header.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //Array to hold any errors in updated data
    //$errors = array();
    $error = false;

    //Checking entered email
    if (empty($_POST['username'])) {
        $error = true;
        $msg[] = " Enter Username";
    } else {
        $username = $_POST['username'];
        if (filter_var($_POST['username'])) {
            $username = $_POST['username'];
        } else {
            $error = true;
            $msg[] = " Username required";
        }
    }

    if (empty($_POST['password'])) {
        $msg[] = " Username required";
    } else {
        $password = validating_input($_POST['password']);
    }


    // if login button is pressed 
    if (isset($_POST["btnLogin"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];



        // query for admin login
        $query = "SELECT * FROM user WHERE username = '$username' AND password='$password'";
        // query for user login
        $query2 = "SELECT * FROM child WHERE Username = '$username' AND password='$password'";
        // executing query

        // performing query function
        $result = mysqli_query($connection, $query);
        $result2 = mysqli_query($connection, $query2);

        // if login records available then 
        if ((mysqli_num_rows($result) > 0) || (mysqli_num_rows($result2) > 0)) {
            // loop through it
            while (($row = mysqli_fetch_assoc($result)) || ($row = mysqli_fetch_assoc($result2))) {
                // if user logs in 
                if ($row["role"] == "user") //|| ($row["role"] == "admin"))
                {
                    //Creating session variables to hold relevant information about who is logged in
                    $_SESSION['User'] = $row["Username"];
                    $_SESSION['Role'] == $row["role"];




                    // redirecting to home page after 5 seconds..
                    header("refresh:5;url=index.php");
                    $text = "<h4>Welcome {$_SESSION['User']}</h4>";
                    $text1 = "<h4>welcome to kiddies,</h4>";
                    $text2 = "<h5>you'll be redirected  in 5 seconds...</h5>";
                }
                // if admin logs in
                elseif ($row["role"] == "admin") {
                    //Creating session variables to hold relevant information about who is logged in
                    $_SESSION['Admin'] = $row["username"];
                    $_SESSION['Role'] == $row["role"];

                    //redirecting to home page after 5 seconds..
                    header("refresh:5;url=AdminPages/adminDashboard.php");
                    $text = "<h4>Welcome {$_SESSION['Admin']}</h4>";
                    $text1 = "<h4>welcome to kiddies,</h4>";
                    $text2 = "<h5>you'll be redirected to <strong>admin panel</strong> in 5 seconds...</h5>";
                }
            }
        } else {
            $msg[] = " Invalid Username or Password";
        }
    }
}

?>

<?php
include "header.php";
?>


<div class="container">
    <div class="col-12 col-md-6">
        <div class="global-container">

            <?php

            // print welcome message if admin and user logs in
            if ((($_SESSION['User']) || ($_SESSION['Admin']))) {
                echo "<div class='welcome'>$text";
                echo "$text1";
                echo  "$text2</div>";
            } else {

            ?>
                <div class="card login-form">
                    <div class="card-body">
                        <h3 class="card-title text-center">Log in to Kiddies Cove</h3>
                        <div class="card-text">
                            <!--
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                            <form method="POST" action="login.php">
                                <!-- to error: add class "has-danger" -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">User Name</label>
                                    <input type="text" name="username" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>

                                    <input type="password" name="password" class="form-control form-control-sm" id="myInput">
                                    <br>
                                    <!-- function to show password -->
                                    <input type="checkbox" onclick="FunctionPass()"> Show Password

                                </div>

                                <?php
                                // priting errors
                                if (isset($msg)) {
                                    foreach ($msg as $err) {  // looping through errors
                                        echo "<h4><strong style='color:red;'>$err</strong></h4>" . "<br>";
                                    }
                                }
                                ?>
                                <button type="submit" name="btnLogin" class="btn btn-primary btn-block">Sign in</button>

                                <div class="sign-up">
                                    Don't have an account? <a href="registration.php">Create One</a>
                                </div>

                            </form>
                        <?php
                    }

                        ?>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<?php
//Function which  validates inputData
function validating_input($inputData)
{
    $inputData = trim($inputData);
    $inputData = stripslashes($inputData);
    $inputData = htmlentities($inputData, ENT_QUOTES);
    return $inputData;
}
?>

<?php
include "footer.html"
?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
</script>

</body>

</html>