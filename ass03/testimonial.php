<?php
        // calling connection 
    require('/home/s3022041/sqlC/dbConnect.php');
    include "header.php";
    
        // qeury to select * from contact us table
    $query = "SELECT * FROM testimonial";
        // performing query function
    $result = mysqli_query($connection, $query);

        // if query successfull 
    if ($result) {
        echo '<div class="testi p-2 mt-2 rounded-top border border-dark bd-highlight">
            <h2>List of all Testimonials</h2>
                </div>
                <br>';
    
            //  loop for all records using while loop and fetching results row an associative array
        while ($row = mysqli_fetch_array($result)) {	
                // if display value is show then show the testimonial
            if ($row['display'] == "HIDE") {		
                    // printing out the parent name form who the testimonial was added						
                echo "<h4 class='testi p-2 rounded-top border border-dark bd-highlight'> Testimonial from : " . $row['parent_name'] . "</h4>";
                // printing out the rest of testimomial feilds
                echo '<div class="testi border border-bottom border-dark rounded-bottom p-2 bd-highlight">
                <p>Service name: ' . $row['service_Name'] . '</p>
                <p>Parent name: ' . $row['parent_name'] . '</p>
                <p>Date: ' . $row['testi_date'] . '</p>
                <p>Message: "' . $row['comment'] . '"</p>
            </div>';
                echo "<br>";
            }
        }
    }
    ?>

<?php
// include footer file
include "footer.html";
?>