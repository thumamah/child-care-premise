<?php
// starting session
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="images/logo_transparent.png" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="script.js"></script>
    <link rel="stylesheet" href="Mystyle.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="images/logo_transparent.png" />
    <title>Kiddies Cove</title>



</head>

<body>

    <div class="nv">
        <nav>
            <div id="logo">
                <a class="navbar-brand" href="index.php">
                    <img src="images/logo_transparent.png" width="100" height="100" alt="">
                </a>

            </div>

            <label href="javascript:void(0);" for="drop" class="toggle">≡</label>
            <input type="checkbox" id="drop" />

            <ul class="menu">

                <li><a href="index.php">Home</a></li>
                <li> <a class="nav-link1" href="registration.php">Registration </a></li>
                <li> <a class="nav-link1" href="services.php">Services</a></li>
                <li> <a class="nav-link1" href="testimonial.php">Testimonials</a></li>
                <li> <a class="nav-link1" href="contactUs.php">Contact</a></li>


                <?php
                // if admin is logged in then give access to the following part of navbar
                if (($_SESSION['Admin']))  {
                ?>

                    <div class="btn2">
                        <li>

                            <!-- First Tier Drop Down -->
                            <label for="drop-22" class="toggle1"></label>
                            <a class="btn btn-danger" href="#">Admin Acoount</a>

                            <ul>
                                <li><a href="AdminPages/adminDashboard.php">Admin DashBoard</a></li>
                                <li><a href="AdminPages/index-edit.php">Edit Home Page</a></li>
                                <li><a href="AdminPages/registration_edit.php">Edit Registration</a></li>
                                <li><a href="AdminPages/day_details_edit.php">Edit DayDetails</a></li>
                                <li><a href="AdminPages/testimonial_manage.php">Manage Testimonials</a></li>
                                <li><a href="AdminPages/contact_us_manage">Manage Contact</a></li>
                                <li><a class="nav-link-Admin" href="logout.php">Log Out</a></li>
                            </ul>
                        </li>
                    </div>

                <?php
                }

                // if user is logged in then give access to the following part of navbar
                elseif (($_SESSION['User'])) {
                ?>

                    <div class="btn2">
                        <li>

                            <!-- First Tier Drop Down -->
                            <label for="drop-22" class="toggle1"></label>
                            <a class="btn btn-danger" href="#">User Acoount</a>

                            <ul>


                                <li><a href="testimonial_add.php">Add Testimonial</a></li>
                                <li><a href="day_details.php">Day Details</a></li>
                                <li><a class="nav-link-Admin" href="logout.php">Log Out</a></li>

                            </ul>
                        </li>

                    </div>

                <?php
                } else {
                ?>

                    <div class="btn2">
                        <li>

                            <!-- First Tier Drop Down -->
                            <label for="drop-2" class="toggle1"></label>
                            <a class="btn btn-danger" href="#">Menu</a>

                            <ul>
                                <li> <a href="registration.php">Sign Up</a></li>
                                <li><a href="login.php">Log In</a></li>
                            </ul>
                        </li>

                    </div>
                <?php
                }

                ?>
            </ul>

        </nav>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>