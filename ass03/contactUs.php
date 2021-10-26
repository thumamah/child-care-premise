<?php

// include header file
include "header.php";

// calling conneection file
require('/home/s3022041/sqlC/dbConnect.php');

// checking if post method requested
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // creating array to store errors
    $error = false;

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

    // checking if email is empty
    if (empty($_POST['email'])) {
        $error = true;
        $msg[] = "name is required";
    } else {
        // triming the email
        $email = trim($_POST['email']);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    }
    // checking if user has entered the correct pattern for the email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $msg[] = 'Not a valid email.';
    }

    // checking if phone number is empty
    if (empty($_POST['phone'])) {
        $error = true;
        $msg[] = "phone number is required";
    } else {
        // triming the name
        $phone = trim($_POST['phone']);
    }
    // checking if user has entered the correct pattern for the phone number
    if (!preg_match("/^[0-9 ]+$/", $phone)) {
        $error = true;
        $msg[] = "invalid input, use only numbers";
    }

    // checking if message  is empty
    if (empty($_POST['message'])) {
        $error = true;
        $msg[] = "message is required";
    } else {
        // triming the name
        $Mymessage = trim($_POST['message']);
    }

    if (empty($error)) { // if no errors process input
        //stripping possible html inputs
        $Name = htmlentities($name);
        $Email = htmlentities($email);
        $phoneNumber = htmlentities($phone);
        $messages = htmlentities($Mymessage);

        $to = '' . $email;
        $subject = 'Confirmation Email';
        $message = 'Hi ' . $Name . ', '  . "\r\n" . 'Thank you for getting in touch. We will be with you very soon. Due to very high volume of emails it may take some 
            time before we reach out to you. For the mean time you can navigate through out site 
            https://knuth.griffith.ie/~s000000/childcare-premise-php-project and get some interesting information.
            '  . "\r\n" . '
            Regards,
            Kiddies Cove Head.
            '  . "\r\n" . '
            YOUR MESSAGE BELOW :
            ' . $messages . '
            ';
        $message = wordwrap($message, 70);
        $headers = 'From: KiddiesCove@gmail.com' . "\r\n" . 'Reply-To: KiddiesCove@gmail.com' .
            "\r\n" . 'X-Mailer: PHP/' . phpversion();
        // send
        mail($to, $subject, $message, $headers);

        // query to insert message details into databse
        $query = "INSERT INTO contact_us(Name, Email, phone_no, Message) VALUES('$Name', '$Email', '$phoneNumber', '$messages')";
        $result = mysqli_query($connection, $query);


        // if query successfull
        if ($result) {
            echo '<div class="succes-msg col-12 col-md-6">
                    <h4>Message Sent Successfully </h4>
                    <h4>well get back to you shortly </h4>
                </div>';
        } else {

            echo '<div class="succes-msg col-12 col-md-6">
                    <h4>Message Not Sent </h4>
                    
                </div>';
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
    // if form not submitted
    if (!isset($_POST['submit']) || (!empty($error))) {
    ?>
        <h3>Contact Form</h3>
        <form action="contactUs.php" method="POST">
            <label for="Name">First Name</label>
            <input type="text" id="fname" name="name" placeholder="Your name.." required>

            <label for="Email">Email</label>
            <input type="email" id="lname" name="email" placeholder="Your Email" required>

            <label for="phone">Phone Number</label>
            <input type="tel" id="lname" name="phone" placeholder="Phone Number.." required>


            <label for="message">Message</label>
            <textarea id="subject" name="message" required placeholder="Write something.." style="height:200px"></textarea>

            <input type="submit" name="submit" value="Submit">
        </form>
    <?php
    }
    ?>
</div>


<?php

include "footer.html";
?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
</script>