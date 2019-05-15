<?php
    session_start();
    if(!isset($_SESSION['uid'])){
        header("Location: index.php");
    }

    $userid = $_SESSION['uid'];
    $eventid = $_GET['ei'];
    $opt = $_GET['opt'];

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'tickets4all';
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($conn->connect_error) {
        die('Could not connect: ' . $conn->connect_error);
    }


    $message = "";

	
	if ($opt =="receive_email"){
		
		
		$sqlGetEventInfo = "SELECT * FROM events WHERE ID='$eventid'";
        $result = $conn->query($sqlGetEventInfo); 
		$row = $result->fetch_assoc();
		
		$eventName = $row['TITLE'];
		$eventDesc = $row['DESCRIPTION'];
		$eventTime = $row['TIME'];
		$eventDate = $row['DATE'];
		

     
	  
	  $sql = "SELECT * FROM accountinfo WHERE id = $userid  ";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				
				$from_email = $row['EMAIL'];
				$from_name = $row['NAME'].' '.$row['SURNAME'];
		
		$to = 'cmartinezpimentel@gmail.com'; 
			
				    $headers = "From: $from_name <$from_email> \r\n";
					$headers .= "Reply-To: $from_email \r\n";

					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		
                  $subject = " $from_name your Ticket for $eventName is here!!!\r\n"; 
                  $body = '<html>                    
                           <body style="margin:0px auto; max-width:600px;">
                           
                           <h2>'.$eventName.'</h2>
                           <p style="font-size: 17px;padding-right: 30px;padding-left: 30px;line-height:24px;">'.$eventDesc.' </p>
						  
                           </body></html>';		
					
                    
                  $mail_result= mail($to,$subject,$body,$headers);
		
		 
		if($mail_result){
		header("location: bookings.php?ok=Yeah");
		}else{
			echo 'Sorry, email was not sent';
		}
	}
    
	if ($opt =="receive_from_cashier"){
		header("location: bookings.php");
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
                        </section
                    </div>
                </section>

                <!-- Footer -->
                <?php include "footer.html"; ?>

            </div>

        <!-- Scripts -->
            <?php include "allscripts.html"; ?>
    </body>
</html>