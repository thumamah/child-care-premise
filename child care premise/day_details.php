<?php
// starting session
session_start();
// if anyone else acces this page apart from user or admin then redirect them to login
if (!(($_SESSION['User']) || ($_SESSION['Admin']))) {
    // bringing user to login page
    header("Location: login.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include "header.php";
    ?>


    <?php
    $name;
    // setting new variable name to to user name by session 
    if (!(($_SESSION['Admin']))) {
        $name = $_SESSION["User"];
    } else {
        $name = $_SESSION["Admin"];
    }
    // calling connection
    require('/home/s3022041/sqlC/dbConnect.php');

    // if search button pressed 
    if (isset($_POST['search'])) {
        // setting the variable date
        $date = $_POST['date'];
        $child;
        if ((($_SESSION['User']))) {
            // query to select all from child where username is equal to current session
            $query1 = "Select * from child where Username = '{$_SESSION['User']}'"; //Getting the child name
            $result = mysqli_query($connection, $query1);

            //Looping through the records and saving the child's name
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                     //Assigning the child name to the variable child
                    $child = strtolower($row["Childname"]);
                }
            }
            $child;
            //Searching by the day and the name of the child
            $query = "SELECT * FROM day where date = '$date' and name= '$child' "; 
            $query1 = mysqli_query($connection, $query);
            //echo $query;
            // if admin is logged in
        } else  if ((($_SESSION['Admin']))) {
            // searching by date 
            $query = "SELECT * FROM day where date = '$date'";
            $query1 = mysqli_query($connection, $query);
        }

        // if no records found 
        if (!(mysqli_num_rows($query1) > 0)) {
            echo '<div class="succes-msg col-12 col-md-6">
                    <h4>No Records Founded! Try Again  </h4>
                    
                </div>'; 
        }
        else{
            echo '<div class="succes-msg col-12 col-md-6">
                    <h4>You Have Some Records Below  </h4>
                    
                </div>';
        }

        
    }
    // exequting query
    ?>
    <?php
    // if user logged in 
    if ((($_SESSION['User']))) {
    ?>
        <div id="container2" class="container py-5 col-12 col-md-6">
            <form id="myform" action="day_details.php" method="POST" class="main-form">
                <?php echo "<h4>Welcome {$name}</h4>"; ?>
                <?php echo "<h1>  Know what your child did on a specific date</h1>"; ?>
                <input id="date" type='date' name="date" required="input" value="" min='1899-01-01' max='2000-13-13'>
                <button type="submit" name="search" class="btn btn-primary"> Search </button>

            </form>
        </div>
    <?php
    }
    ?>


    <?php
    // if admin is logged in 
    if ((($_SESSION['Admin']))) {
    ?>
        <div id="container2" class="container py-5 col-12 col-md-6">
            <form id="myform" action="day_details.php" method="POST" class="main-form">
                <?php echo "<h4>Welcome {$name}</h4>"; ?>
                <?php echo "<h1>  Know what your child did on a specific date</h1>"; ?>
                <input type='date' name="date" required="input" value="" min='1899-01-01' max='2000-13-13'>
                <button type="submit" name="search" class="btn btn-primary"> Search </button>
                <?php //echo $query; 
                //echo mysqli_error($connection);
                ?>


            </form>
        </div>

    <?php
    }
    ?>
    <div class="tabl">
        <table class="table table-success table-striped" class="table-responsive">
            <thead>
                <tr>

                    <th scope="col">Date</th>
                    <th scope="col">Name</th>
                    <th scope="col">Temperature (°C)</th>
                    <th scope="col">Breakfast</th>
                    <th scope="col">Lunch</th>
                    <th scope="col">Activities</th>


                </tr>
            </thead>

            <?php
            // if query successfull
            if ($query1) {
                // loop through details
                foreach ($query1 as $row) {  // for each looping through the records
            ?>

                    <tbody>
                        <tr>
                            <td> <?php echo $row['date']; ?></td>
                            <td> <?php echo $row['name']; ?> </td>
                            <td> <?php echo $row['temperature']; ?> </td>
                            <td> <?php echo $row['breakfast']; ?> </td>
                            <td> <?php echo $row['lunch']; ?> </td>
                            <td> <?php echo $row['activities']; ?> </td>

                        </tr>

                    </tbody>

            <?php
                }
            } else {
            }
            ?>

        </table>
    </div>
    <?php
    include "footer.html";
    ?>
</body>
<script>
    function showSearch() {
        var x = document.getElementById("searched");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
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
    document.getElementById("date").setAttribute("max", todayMax);
    document.getElementById("date").setAttribute("min", todayMin);
</script>

</html>