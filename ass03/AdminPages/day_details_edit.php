<?php
session_start();
// if not logged in as admin then go to login page
if (!(($_SESSION['Admin']))) {
    header("Location: ../login.php");
  }
include "sidebar.php";
?>

<?php
// calling connection



// connection
require('/home/s3022041/sqlC/dbConnect.php');
// if search button clicked then 
if (isset($_POST['search'])) {
    $date = $_POST['date'];
    $child = $_POST['child'];
    // query to search by date and chilname 
    $query = "SELECT * FROM day where date = '$date' and name= '$child' "; //Searching by the day and the name of the child
    $query_run = mysqli_query($connection, $query);

    // getting the existing records in a form
    while ($row = mysqli_fetch_array($query_run)) {




        //Setting data in row as local variables to allow for ease of manipulation
        $date = $row['date'];
        $name = $row['name'];
        $temperature = $row['temperature'];
        $breakfast = $row['breakfast'];
        $lunch = $row['lunch'];
        $activities = $row['activities'];



        echo '<div id="updateForm" class="container index-edit">
						<div class="edit_index">';


        echo "<h3>Edit details for child " . $name . "</h3>";
        echo "<hr>";
        echo '<form id="form" action="day_details_edit.php" method="POST">

                            <label for="image">date: </label><br/>
							<input type="date" name="date" value="' . $date . '" class="form-control col-md-10"  required /><br/>

							<label for="title">name: </label><br/>
							<input type="text" name="name" value="' . $name . '" class="form-control col-md-10" /><br/>

                            <label for="title">temperature: </label><br/>
							<input type="text" name="temperature" value="' . $temperature . '" class="form-control col-md-10" /><br/>

                            <label for="title">breakfast: </label><br/>
							<input type="text" name="breakfast" value="' . $breakfast . '" class="form-control col-md-10" /><br/>

						
							<label for="link">lunch: </label><br/>
							<input type="text" name="lunch" value="' . $lunch . '" class="form-control col-md-10" required /><br/><br/>

                            <label for="link">Activities: </label><br/>
							<input type="text" name="activities" value="' . $activities . '" class="form-control col-md-10" required /><br/><br/>

                            <input type="submit" name="update" value="Update Feature" class="btn btn-dark float-left"><br/><br/>

							
						</form> ';

        echo '</div></div>';
    }
}







// checking if requested method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['insert'])) {

        // creating array to store errors
        $error = false;

        // checking if service name is empty
        if (empty($_POST['date'])) {
            $error = true;
            $msg[] = "date is required";
        } else {
            $date = trim($_POST['date']);
            if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $date)) {
                $msg[] = 'Invalid date! use only date format dd/mm/yyyy';
            }
        }

        //    // checking if name is empty
        if (empty($_POST['name'])) {
            $error = true;
            $msg[] = "name is required";
        } else {
            // triming the name
            $name = trim($_POST['name']);
        }
        // checking if user has entered the correct pattern for the name
        if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
            $msg[] = "invalid input, use only letters for name";
        }


        // checking if name is empty
        if (empty($_POST['temperature'])) {
            $error = true;
            $msg[] = "temperature is required";
        } else {
            // triming the name
            $temperature = trim($_POST['temperature']);
        }
        // checking if user has entered the correct pattern for the name
        if (!preg_match("/^[a-zA-Z 0-9 ]+$/", $temperature)) {
            $msg[] = "invalid input, use only letters for temperature";
        }


        // checking if name is empty
        if (empty($_POST['breakfast'])) {
            $error = true;
            $msg[] = "breakfast is required";
        } else {
            // triming the name
            $breakfast = trim($_POST['breakfast']);
        }
        // checking if user has entered the correct pattern for the name
        if (!preg_match("/^[a-zA-Z ]+$/", $breakfast)) {
            $msg[] = "invalid input, use only letters for breakfast";
        }

        // checking if name is empty
        if (empty($_POST['lunch'])) {
            $error = true;
            $msg[] = "lunch is required";
        } else {
            // triming the name
            $lunch = trim($_POST['lunch']);
        }
        // checking if user has entered the correct pattern for the name
        if (!preg_match("/^[a-zA-Z ]+$/", $lunch)) {
            $msg[] = "invalid input, use only letters for lunch";
        }

        // checking if name is empty
        if (empty($_POST['activities'])) {
            $error = true;
            $msg[] = "activities is required";
        } else {
            // triming the name
            $activities = trim($_POST['activities']);
        }
        // checking if user has entered the correct pattern for the name
        if (!preg_match("/^[a-zA-Z ]+$/", $activities)) {
            $msg[] = "invalid input, use only letters for activities";
        }

        if (empty($error)) { // if no errors process input

            //stripping possible html inputs
            $date = htmlentities($date);
            $name = htmlentities($name);
            $temperature = htmlentities($temperature);
            $breakfast = htmlentities($breakfast);
            $lunch = htmlentities($lunch);
            $activities = htmlentities($activities);


            require('/home/s3022041/sqlC/dbConnect.php');


            if (isset($_POST['insert'])) {

                $query_insert = "INSERT INTO day(date, name, temperature, breakfast, lunch, activities) 
                    VALUES('$date', '$name', '$temperature',  '$breakfast', '$lunch', '$activities')";
                $child = $_SESSION['childName'];



                // perfomring query function
                $result_insert = mysqli_query($connection, $query_insert);
                // cheking if there are any errors
                $error = mysqli_error($connection);
            }


            // if add details button pressed then 
            if (isset($_POST['insert'])) {
                // if query successfull
                if ($result_insert) {


                    echo '<div class="succes-msg col-12 col-md-6">
            <h4> Details Added successfully </h4>

        </div>';
                } else {
                    echo '<div class="succes-msg col-12 col-md-6">
            <h4>Details Not Added </h4>

            </div>
            ';
                }
            }
        } else {
            $msg[] = "invalid details";
            // foreach($errors as $newError){
            // echo "<h1>$newError</h1>";
            // }
        }
    }

    // validation for search form //

    // if search button presssed then 
    if (isset($_POST['search'])) {

        // creating array to store errors
        $error = false;

        // checking if service name is empty
        if (empty($_POST['date'])) {
            $error = true;
            $msg[] = "date is required";
        } else {
            $date = trim($_POST['date']);
            if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $date)) {
                $msg[] = 'Invalid date! use only date format dd/mm/yyyy';
            }
        }

        //   

        // checking if child name is empty
        if (empty($_POST['child'])) {
            $error = true;
            $msg[] = "child is required";
        } else {
            // triming the name
            $child = trim($_POST['child']);
        }
        // checking if user has entered the correct pattern for the name
        if (!preg_match("/^[a-zA-Z ]+$/", $child)) {
            $msg[] = "invalid input, use only letters for child name";
        }






        if (empty($error)) { // if no errors process input
            //stripping possible html inputs
            $date = htmlentities($date);
            $child = htmlentities($child);
            $name = htmlentities($name);
            $temperature = htmlentities($temperature);
            $breakfast = htmlentities($breakfast);
            $lunch = htmlentities($lunch);
            $activities = htmlentities($activities);


            // if search button pressed
            if (isset($_POST['search'])) {

                echo '<div class="succes-msg col-12 col-md-6">
            <h4> Form enabled below which you can edit </h4>

        </div>';
            }
        } else {
            $msg[] = "invalid details";
        }
    }


    //  validation for update form **************************// 

    // if update button pressed
    if (isset($_POST['update'])) {

        // creating array to store errors
        $error = false;

        // checking if service name is empty
        if (empty($_POST['date'])) {
            $error = true;
            $msg[] = "date is required";
        } else {
            $date = trim($_POST['date']);
            if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $date)) {
                $msg[] = 'Invalid date! use only date format dd/mm/yyyy';
            }
        }

        //    // checking if name is empty
        if (empty($_POST['name'])) {
            $error = true;
            $msg[] = "name is required";
        } else {
            // triming the name
            $name = trim($_POST['name']);
        }
        // checking if user has entered the correct pattern for the name
        if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
            $msg[] = "invalid input, use only letters for name";
        }


        // checking if name is empty
        if (empty($_POST['temperature'])) {
            $error = true;
            $msg[] = "temperature is required";
        } else {
            // triming the name
            $temperature = trim($_POST['temperature']);
        }
        // checking if user has entered the correct pattern for the name
        if (!preg_match("/^[a-zA-Z 0-9 ]+$/", $temperature)) {
            $msg[] = "invalid input, use only letters for temperature";
        }


        // checking if name is empty
        if (empty($_POST['breakfast'])) {
            $error = true;
            $msg[] = "breakfast is required";
        } else {
            // triming the name
            $breakfast = trim($_POST['breakfast']);
        }
        // checking if user has entered the correct pattern for the name
        if (!preg_match("/^[a-zA-Z ]+$/", $breakfast)) {
            $msg[] = "invalid input, use only letters for breakfast";
        }

        // checking if name is empty
        if (empty($_POST['lunch'])) {
            $error = true;
            $msg[] = "lunch is required";
        } else {
            // triming the name
            $lunch = trim($_POST['lunch']);
        }
        // checking if user has entered the correct pattern for the name
        if (!preg_match("/^[a-zA-Z ]+$/", $lunch)) {
            $msg[] = "invalid input, use only letters for lunch";
        }

        // checking if name is empty
        if (empty($_POST['activities'])) {
            $error = true;
            $msg[] = "activities is required";
        } else {
            // triming the name
            $activities = trim($_POST['activities']);
        }
        // checking if user has entered the correct pattern for the name
        if (!preg_match("/^[a-zA-Z ]+$/", $activities)) {
            $msg[] = "invalid input, use only letters for activities";
        }

        if (empty($error)) { // if no errors process input
            //stripping possible html inputs
            $date = htmlentities($date);
            $name = htmlentities($name);
            $temperature = htmlentities($temperature);
            $breakfast = htmlentities($breakfast);
            $lunch = htmlentities($lunch);
            $activities = htmlentities($activities);


            // if update button pressed
            if (isset($_POST['update'])) {


                // update query for day details 
                $query = "UPDATE day SET date = '$date', name = '$name', temperature = '$temperature', breakfast = '$breakfast', lunch = '$lunch' WHERE name = '$name';";


                // perfomring query function
                $result_insert = mysqli_query($connection, $query);

                //$error = mysqli_error($connection);
            }


            // if query successfull

            if ($result_insert) {

                echo $result_insert;
                echo $query;


                echo '<div class="succes-msg col-12 col-md-6">
            <h4> Details updated successfully </h4>

        </div>';
            } else {
                echo '<div class="succes-msg col-12 col-md-6">
            <h4>Details Not updated </h4>

            </div>
            ';
            }
        } else {
            $msg[] = "invalid details";
        }
    }
}
?>


<div id="container2" class="container py-5 col-12 col-md-6">

    <!-- button for updating details -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">
        Update Details
    </button>
    <br>
    <br>
    OR

    <form action="day_details_edit.php" method="POST">

        <?php
        // priting errors
        if (isset($msg)) {
            foreach ($msg as $err) {  // looping through errors
                echo "<h4><strong style='color:red;'>$err</strong></h4>" . "<br>";
            }
        }
        ?>


        <h2> Add Details </h2>
        <br>

        <div class="form-group">
            <label for="formGroupExampleInput">Date</label>
            <input type="date" class="form-control" name="date" id="date" min='1899-01-01' max='2000-13-13' placeholder="Date" required>
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Name</label>
            <input type="text" class="form-control" name="name" id="formGroupExampleInput" required>
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Temperature</label>
            <input type="text" class="form-control" name="temperature" id="formGroupExampleInput" required>
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Breakfast</label>
            <input type="text" class="form-control" name="breakfast" id="formGroupExampleInput" required>
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Lunch</label>
            <input type="text" class="form-control" name="lunch" id="formGroupExampleInput" required>
        </div>

        <div class="form-group">
            <label for="formGroupExampleInput">Activities</label>
            <input type="text" class="form-control" name="activities" id="formGroupExampleInput" required>
        </div>

        <button type="submit" name="insert" class="btn btn-primary">Add Details</button>



    </form>
</div>



<!-- search model Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search child by its name and Date To Enable Update Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div id="container2" class="container py-5 col-12 col-md-6">
                    <form id="myform " action="day_details_edit.php" method="POST" class="main-form">

                        <?php echo "<h1>  Update child information</h1>"; ?>
                        <label for="formGroupExampleInput">Date</label>
                        <input id="date" type='date' name="date" required="input" value="" min='1899-01-01' max='2000-13-13'>
                        <label for="formGroupExampleInput">Child Nmae</label>
                        <input id="name" type='text' name="child" required="input" value="">
                        <button type="submit" name="search" class="btn btn-primary"> Search </button>

                    </form>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>


<?php
// calling connection



// connection
require('/home/s3022041/sqlC/dbConnect.php');
// editing records
if (isset($_POST['search'])) {
    $date = $_POST['date'];
    $child = $_POST['child'];
    // getting the records query 
    $query = "SELECT * FROM day where date = '$date' and name= '$child' "; //Searching by the day and the name of the child
    $query_run = mysqli_query($connection, $query);

    // getting the existing records in a form
    while ($row = mysqli_fetch_array($query_run)) {




        //Setting data in row as local variables to allow for ease of manipulation
        $date = $row['date'];
        $name = $row['name'];
        $temperature = $row['temperature'];
        $breakfast = $row['breakfast'];
        $lunch = $row['lunch'];
        $activities = $row['activities'];



        echo '<div id="updateForm" class="container index-edit">
						<div class="edit_index">';


        echo "<h3>Edit details for child " . $name . "</h3>";
        echo "<hr>";
        echo '<form id="form" action="day_details_edit.php" method="POST">


                            <label for="image">date: </label><br/>
							<input type="date" name="date" value="' . $date . '" class="form-control col-md-10"  required /><br/>

							<label for="title">name: </label><br/>
							<input type="text" name="name" value="' . $name . '" class="form-control col-md-10" /><br/>

                            <label for="title">temperature: </label><br/>
							<input type="text" name="temperature" value="' . $temperature . '" class="form-control col-md-10" /><br/>

                            <label for="title">breakfast: </label><br/>
							<input type="text" name="breakfast" value="' . $breakfast . '" class="form-control col-md-10" /><br/>

						
							<label for="link">lunch: </label><br/>
							<input type="text" name="lunch" value="' . $lunch . '" class="form-control col-md-10" required /><br/><br/>

                            <label for="link">Activities: </label><br/>
							<input type="text" name="activities" value="' . $activities . '" class="form-control col-md-10" required /><br/><br/>

                            <input type="submit" name="update" value="Update Feature" class="btn btn-dark float-left"><br/><br/>

							
						</form> ';

        echo '</div></div>';
    }
}

?>




<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    todayMin = yyyy + '-' + mm + '-' + (dd - 3);
    todayMax = yyyy + '-' + mm + '-' + (dd - 0);
    document.getElementById("date").setAttribute("max",
        todayMax);
    document.getElementById("date").setAttribute("min", todayMin);
</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>