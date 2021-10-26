<?php
// starting session
session_start();
// if your not logged in as user then go to login page
if (!(($_SESSION['User']) || ($_SESSION['Admin']))) {
    // bringing user to login page
    header("Location: login.php");
}
include "header.php";
// calling connection
require('/home/s3022041/sqlC/dbConnect.php');


// checking if requested method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // creating array to store errors
    $error = false;

    // checking if service name is empty
    if (empty($_POST['serviceName'])) {
        $error = true;
        $msg[] = "serviceName is required";
    } else {
        // triming the name
        $serviceName = trim($_POST['serviceName']);
    }
    //$serviceName = $_POST['serviceName'];

    // checking if name is empty
    if (empty($_POST['name'])) {
        $error = true;
        $msg[] = "name is required";
    } else {
        // triming the name
        $name = trim($_POST['name']);
    }
    // checking if user has entered the correct pattern for the name
    if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $msg[] = "invalid input, use only letters";
    }

    if (empty($_POST['date'])) {
        $error = true;
        $msg[] = "date is required";
    } else {
        $date = trim($_POST['date']);
        if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $date)) {
            $msg[] = 'Invalid date! use only date format dd/mm/yyyy';
        }
    }

    // checking if comment  is empty
    if (empty($_POST['comment'])) {
        $error = true;
        $msg[] = "comment is required";
    } else {
        // triming the comment
        $Mycomment = trim($_POST['comment']);
    }

    if (empty($error)) { // if no errors process input
        //stripping possible html inputs
        $serviceName = htmlentities($serviceName);
        $name = htmlentities($name);
        $date = htmlentities($date);
        $Mycomment = htmlentities($Mycomment);

        // adding testimonial to the database
        $query = "INSERT INTO testimonial(service_Name, parent_name, testi_date, comment) VALUES('$serviceName', '$name', '$date', '$Mycomment')";
        $result = mysqli_query($connection, $query);
        // cheking if there are any errors
        $error = mysqli_error($connection);


        // if query successfull
        if ($result) {
            echo '<div class="succes-msg col-12 col-md-6">
                        <h4> Testimonial Added successfully </h4>
                       
                    </div>';
        } else {

            echo '<div class="succes-msg col-12 col-md-6">
                        <h4>Testimonial Not Added </h4>
          
                    </div>
                    ';
            echo $query;
            echo $qq;
        }
    } else {
        $msg[] = "invalid details";
        // foreach($errors as $newError){
        //     echo "<h1>$newError</h1>";
        // }
    }
}
?>


<div id="container2" class="container py-5 col-12 col-md-6">
    <form action="testimonial_add.php" method="POST">

        <?php
        // priting errors
        if (isset($msg)) {
            foreach ($msg as $err) {  // looping through errors
                echo "<h4><strong style='color:red;'>$err</strong></h4>" . "<br>";
            }
        ?>

        <?php
        }

        ?>
        <?php
        // if not submitted then show form
        if (!isset($_POST['submit']) || (!empty($error))) {
        ?>

            <h2> Add Testimonial </h2>
            <br>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Service Name</label>
                <select class="form-control" name="serviceName" id="exampleFormControlSelect1">

                    <?php
                    //connect to database,get all classes and add them as select options

                    $query = "SELECT name FROM service";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                    }
                    mysqli_close($connection);
                    ?>

                </select>
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput">Parent Name</label>
                <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Parent Name">
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput">Date</label>
                <input type="date" class="form-control" name="date" id="formGroupExampleInput" placeholder="Date">
            </div>



            <div class="form-group">
                <label for="exampleFormControlTextarea1">Comment</label>
                <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="4"></textarea>
            </div>


            <button type="submit" class="btn btn-primary">Add Testimonial</button>
    </form>
</div>


<?php
        }
        include "footer.html";
?>