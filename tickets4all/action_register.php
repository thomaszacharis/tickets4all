<?php
    
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $telephone =  $_POST['telephone'];
    $address = $_POST['address'];
    $postalcode = $_POST['postalcode'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'tickets4all';
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($conn->connect_error) {
        die('Could not connect: ' . $conn->connect_error);
    }

        

    $sqlCheckEmailExists = "SELECT * FROM login WHERE EMAIL='$email'";
    $result = $conn->query($sqlCheckEmailExists);
    $message = "";
    if ($result->num_rows > 0) {
        //means that the email is used by another user
        $message .= "Failure! This e-mail is already in-use\n";
        $message .= "Try again.. Go to " . "<a href='./register.php'>Register</a>";   
    } else {
		// insert into login table first
		
		 $sql0 = "INSERT INTO login (EMAIL, PASSWORD) VALUES ( '$email', '$pass')";    
		
        //after checking there isn't a user with that email, we continue with the register
        $sql = "INSERT INTO accountinfo (EMAIL, NAME, SURNAME, ADDRESS, GENDER, CONTACTNUM, postalcode) VALUES ( '$email', '$name', '$surname', '$address', '$gender', '$telephone', '$postalcode')";    
        if ( ($conn->query($sql) === TRUE) && ($conn->query($sql0) === TRUE) ) {       
            $message .=  "Registered successfully\n";
            $message .=  "Go to " . "<a href='./login.php'>Login</a>";    
        } else {
            $message .=  "Error: " . $sql . "\n" . $conn->error;
            $message .=  "Try again.. Go to " . "<a href='./register.php'>Register</a>";    
        }
    }

    
    
    $conn->close();

?>

<!DOCTYPE HTML>
<!--
    Forty by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <!-- Head -->
    <?php include "heading.html"; ?>

	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
                <?php include "header.php"; ?>

                <!-- Menu -->
                <?php include "menu.php"; ?>

                <!-- Message -->
                <section id="message">
                    <div class="inner">
                        <section>
                            <p><?php echo $message ?></p>
                        </section>
                    </div>
                </section>

                <!-- Footer -->
                <?php include "footer.html"; ?>

            </div>

        <!-- Scripts -->
            <?php include "allscripts.html"; ?>
    </body>
</html>