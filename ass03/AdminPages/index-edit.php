<?php
// starting sesssion
session_start();
// if admin your not loggen as admin then go to login page
if (!isset($_SESSION['Admin'])) {
	// redirecting to login page
	header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Kiddies Cove</title>

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



	<?php
	// using the require function to call the connection
	require('/home/s3022041/sqlC/dbConnect.php');


	// checking if used the post method
	if ($_SERVER['REQUEST_METHOD'] == "POST") {

		//We Take in the page_id associated with update button pressed
		$page_id = $_POST['page_id'];

		//Array to hold any errors in updated data
		$errors = array();

		// checking of title empty or not
		if (empty($_POST['title'])) {
			// storing erros
			$errors[] = "Feature title required";
		} else {
			// using validating input function to validate
			$title = validating_input($_POST['title']);
		}

		// checking of text empty or not
		if (empty($_POST['text'])) {
			// storing errors
			$errors[] = "Feature text required";
		} else {
			// using validating input function to validate
			$text = validating_input($_POST['text']);
		}


		// checking of link empty or not
		if (empty($_POST['link'])) {
			// storing errors
			$errors[] = "Feature link required";
		} else {
			// Checking if the variable link is a valid URL:
			if (filter_var($_POST['link'], FILTER_VALIDATE_URL)) {
				$link = $_POST['link'];
			} else {
				$errors[] = "Invalid link url";
			}
		}

		// checking of image empty or not
		if (empty($_POST['image'])) {
			$errors[] = "Feature image required";
		} else {
			// Checking if the variable image is a valid URL:
			if (filter_var($_POST['image'], FILTER_VALIDATE_URL)) {
				$image = $_POST['image'];
			} else {
				$errors[] = "Invalid image url";
			}
		}

		// checking of link_text empty or not
		if (empty($_POST['link_text'])) {
			$errors[] = "Feature link text required";
		} else {
			// using validating input function to validate
			$link_text = validating_input($_POST['link_text']);
		}

		// if erros are empty then proceed to the query
		if (empty($errors)) {

			//Sending query to update record
			$query = "UPDATE page SET image = '$image', title = '$title', text = '$text', link = '$link', link_text = '$link_text' WHERE page_id = '$page_id';";
			// function to perform query
			$result = mysqli_query($connection, $query);

			// printing message if query is succes or fails
			if ($result) {
				echo '<div class="container p-5 mt-3 mb-3 bg-info text-light rounded">
								<div class="edit_index">';

				echo "<h3>Feature details successfully updated</h3>";
				echo '</div></div>';
			} else {
				echo '<div class="container p-5 mt-3 mb-3 bg-info text-light rounded">
								<div class="edit_index">';
				echo "<h3>Something went wrong - please try editing details again";
				echo '</div></div>';
			}
		}

		//Printing any errors in update attempt to alert admin as to why it failed
		else {
			echo '<div class="container ">
								<div class="edit_index">';

			echo "<h3 class='warning'>Error! The following problems were detected with your submission:</h3>" . "<br/>";
			// using for each loop to loop through the errors
			foreach ($errors as $warning) {
				echo "<div class='warning'>$warning</div>" . "<br/>";
			}
			echo "Please go back and try again";

			echo '</div></div>';
		}
	}


	//Getting all records from page table
	$query = "select * from page;";
	// function to perform query
	$result = mysqli_query($connection, $query);

	//If query successful
	if ($result) {
		//  loop for all records using while loop and fetching results row  an associative array
		while ($row = mysqli_fetch_assoc($result)) {

			//Setting data in row as local variables to allow for ease of manipulation
			$page_id = $row['page_id'];
			$image = $row['image'];
			$title = $row['title'];
			$text = $row['text'];
			$link = $row['link'];
			$link_text = $row['link_text'];

			echo '<div class="container index-edit">
									<div class="edit_index">';

			echo "<h3>Edit details for feature box " . $page_id . "</h3>";
			echo "<hr>";
			echo '<form id="form" action="index-edit.php" method="POST">

										<label for="image">Image URL: </label><br/>
										<input type="text" name="image" value="' . $image . '" class="form-control col-md-10"  required /><br/>

										<label for="title">Title: </label><br/>
										<input type="text" name="title" value="' . $title . '" class="form-control col-md-10" /><br/>


										<label for="text">Text: </label><br/>
										<textarea name="text" class="form-control col-md-10" rows="12" required>' . $text . '</textarea><br/>
										
										
										<label for="link">Link: </label><br/>
										<input type="text" name="link" value="' . $link . '" class="form-control col-md-10" required /><br/><br/>

										<label for="link">Link Text: </label><br/>
										<input type="text" name="link_text" value="' . $link_text . '" class="form-control col-md-10" required /><br/><br/>

										<input type="hidden" name="page_id" value="' . $page_id . '" />
										<input type="submit" value="Update Feature" class="btn btn-dark float-left"><br/><br/>
									</form> ';

			echo '</div></div>';
		}
	}
	//give an error message if the query is failed
	else {
		echo "Try Again";
	}

	//Function which  validates inputData
	function validating_input($inputData)
	{
		// Remove characters from both sides of a string
		$inputData = trim($inputData);
		// removes backslashes
		$inputData = stripslashes($inputData);
		// Convert some characters to HTML entities:
		$inputData = htmlentities($inputData, ENT_QUOTES);
		return $inputData;
	}

	//Closing the connection
	mysqli_close($connection);

	?>

	</div>


	</div>


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