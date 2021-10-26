<?php
 
    // starting session
    session_start();
    // if not logged in as admin then go to login page
    if (!(($_SESSION['Admin']))) {
        header("Location: ../login.php");
  }


    // calling connection 
    require('/home/s3022041/sqlC/dbConnect.php');
    include "sidebar.php";
    // qeury to select * from contact us table
    $query = "SELECT * FROM contact_us";
    $result = mysqli_query($connection, $query);

    // if query successfull 
    if($result)
    {
        echo '<div class="row justify-content-around">
        <h2>List of all messages</h2>
            </div>';
        echo "<br>";
        echo "<br>";

        //getting all messages from database and displaying them
        while($row = mysqli_fetch_array($result)){									
            echo "<h4 class='pl-3'>Message number: " . $row['message_id'] . "<br />\n</h4>";
            echo "<br>";
            echo '<div class="containerWordWrap pl-4 pr-4 pt-2 pb-2 bg-white fw-bolder border border-dark rounded">
            <p>First name: ' . $row['Name'] . '</p>
            <p>Last name: ' . $row['Email'] . '</p>
            <p>Phone number: ' . $row['phone_no'] . '</p>
            <p>Message: "' . $row['Message'] . '"</p>
        </div>';
    echo "<br>";						
}
echo "<p>Back to <a href='index.php' class='text-dark'>Home</a> page.</p>";
}
