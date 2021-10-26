
<?php
// starting the session 
session_start();
 // if user/admin logged in then print welcome message and redirect to the home page 
 if ((isset($_SESSION['Admin'])) || (isset($_SESSION['User']))) {
    header( "refresh:5;url=index.php" );
    
    $text0 = "<h2 style='color:red;'>Logged Out Successfully,</h2>";
    $text1 = "<h4>Thank you for visiting kiddies,</h4>";
    $text2 = "<h5>you'll be redirected to home page in 5 seconds...</h5>";
 } else {
 echo "Please login again!"; 
    
 }
// if logged out then destroy the session
if ((isset($_SESSION['Admin'])) ||  (isset($_SESSION['User']))) {
    // destroying session
    session_unset();
    session_destroy();
    } else {
    echo "Already logged out!";
    }

?>

<!doctype html>
<html lang="en">
  <head>
  <link rel="icon" type="image/png" href="images/logo_transparent.png"/>
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="Mystyle.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 

    <style>
         .card{
            padding: 2rem;
            
        } 

          .global-container{
            margin-top: 10rem;
            margin-bottom: 5rem;
        }

        .welcome{
            padding: 3rem;
            background-color: white;
            color: black;
            font-weight: bold;
            font-family: 'Cherry Swash';
            font-size: 15rem;
        } 
    </style>
    
  </head>
  <body>

            <?php
                include "header.php";
            ?>

    <div class="container"> 
                    <div class="col-12 col-md-6">

                
                         <div class="global-container">
                    

                    <?php
                    // if logged out successfully, print the confirmation message
                    if(!(isset($_SESSION['Admin'])) || (isset($_SESSION['User'])))
                    {
                        echo "<div class='welcome'>$text0";
                        echo  "$text1";
                        echo  "$text2</div>";
                    }
                    else 
                    {
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
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" name="username" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                
                                                <input type="password" name="password" class="form-control form-control-sm" id="exampleInputPassword1">
                                            </div>
                                            <?php echo "<h1> $message </h1> " ?>
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
              include "footer.html" // inclding the footer
            ?>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

  </body>
</html>