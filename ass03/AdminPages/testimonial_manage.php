<?php
	 session_start();
	 // if your not logged in as admin then go to login page
	 if(!$_SESSION['Admin']){
		 header("Location: ../login.php");
	 }
    include "sidebar.php";


    
    // calling connection 
    require('/home/s3022041/sqlC/dbConnect.php');
   

    // checking requested method
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $errors = array(); // create an errors array to record errors if any.

        //getting input from form
        $testimonialNumber = $_POST['testimonial_id'];
        $visibility = $_POST['display'];
        
        //setting up value for display in database,opposite of the one that is current
        if($visibility == "SHOW"){
            $visibilityDB = "HIDE";
        }
        else{
            $visibilityDB = "SHOW";
        }
        
            
        //updating display in db for specific testimonial so switching bewtween show/hide
        $query = "UPDATE testimonial SET display = '$visibilityDB' WHERE testimonial_id = '$testimonialNumber'";
        $result = mysqli_query($connection, $query);
        if($result){

			echo '<div class="row justify-content-around">
			<h4>Display was updated successfully</h4>
		</div>';
        			
        }
        else{
            echo '<div class="row justify-content-around">
                        <h4>Display was not updated!</h4>
                    </div>';
            
            echo "<br>";
            
            echo "<p>Go back to <a href='testimonial_manage.php' class='text-dark'>testimonial manage</a> if you want to do more changes.</p>";
            echo "<br>";
            echo "<p>Or go back to <a href='index.php' class='text-dark'>Home</a> page.</p>";
        }
    }

		//qeury to select * from contact us table
		$query = "SELECT * FROM testimonial";
		$result = mysqli_query($connection, $query);
	
		// if query successfull 
		if($result)
		{
			echo '<div class="testi p-2 mt-2 rounded-top border border-dark bd-highlight">
			<h2>List of all Testimonials</h2>
				</div>
				<br>';
				
			
	
			//getting all messages from database and displaying them
			while($row = mysqli_fetch_array($result)){

				 
				$testimonialNumber = $row['testimonial_id'];					
 				$visibilityCheck = $row['display'];	
												
				echo "<h4 class='testi p-2 rounded-top border border-dark bd-highlight'> Testimonial from : " . $row['parent_name'] . "</h4>";
				
				echo '<div class="testi border border-bottom border-dark rounded-bottom p-2 bd-highlight">
				
				<p>Service name: ' . $row['service_Name'] . '</p>
				<p>Parent name: ' . $row['parent_name'] . '</p>
				<p>Date: ' . $row['testi_date'] . '</p>
				<p>Message: "' . $row['comment'] . '"</p>
				

				<!--adding form that sends specific testimonial data to update script,triggered by Change visibility button-->
					<form action="testimonial_manage.php" method="POST">
						<div>
							<input type="hidden" name="testimonial_id" value=' . $testimonialNumber . ' />
							<input type="hidden" name="display" value=' . $visibilityCheck . ' />
							<button class="btn btn-success ml-4 mt-1" type="checkbox">	
							<div class="switch-toggle">
							<div class="button-check" id="button-check">
							 
							  <p class=""><strong> ' . $row['display'] . ' TESTIMONIAL </strong></p>
							
						  </button>		

						</div>
					</form>
			</div>';
		echo "<br>";						
	}
			}	
			//close connection
			mysqli_close($connection);
