<?php
session_start();
if (!isset($_SESSION['Admin'])) {
    header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../Mystyle.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> kiddies Cove</title>

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

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cards</h1>
        </div>

        <div class="row">

        </div>

        <div class="row">

            <div class="col-lg-6">



                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Home</h6>
                    </div>
                    <div class="card-body">
                        <img src="img/pic10.jpg" class="card-img-top" alt="pic5">

                    </div>
                    <a href="../index.php" id="buttons" class="btn btn-lg">Home Page</a>
                </div>

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Home Page</h6>
                    </div>
                    <div class="card-body">
                        <img src="img/pic10.jpg" class="card-img-top" alt="pic5">

                    </div>
                    <a href="index-edit.php" id="buttons" class="btn btn-lg">Edit Home Page</a>
                </div>

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Registration Page</h6>
                    </div>
                    <div class="card-body">
                        <img src="img/pic10.jpg" class="card-img-top" alt="pic5">

                    </div>
                    <a href="registration_edit.php" id="buttons" class="btn btn-lg">Edit Registration Page</a>
                </div>


            </div>

            <div class="col-lg-6">


                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Day Details</h6>
                    </div>
                    <div class="card-body">
                        <img src="img/pic10.jpg" class="card-img-top" alt="pic5">

                    </div>
                    <a href="day_details_edit.php" id="buttons" class="btn btn-lg">Edit Day Details</a>
                </div>

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Manage Testimonials</h6>
                    </div>
                    <div class="card-body">
                        <img src="img/pic10.jpg" class="card-img-top" alt="pic5">

                    </div>
                    <a href="testimonial_manage.php" id="buttons" class="btn btn-lg">Manage Testimonials</a>
                </div>

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Manage Contact Page</h6>
                    </div>
                    <div class="card-body">
                        <img src="img/pic10.jpg" class="card-img-top" alt="pic5">

                    </div>
                    <a href="contact_us_manage.php" id="buttons" class="btn btn-lg">Manage Contact Page</a>
                </div>


            </div>

        </div>

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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>