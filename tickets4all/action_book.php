<?php
    session_start();
    if(!isset($_SESSION['uid'])){
        header("Location: index.php");
    }

    $userid = $_SESSION['uid'];
    $eventid = $_POST['eventid'];
    $ticketsamount = $_POST['ticketsQuantity'];

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'tickets4all';
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($conn->connect_error) {
        die('Could not connect: ' . $conn->connect_error);
    }


   $sqlCheckAvailableTickets = "SELECT events.AVAILABILITY-(CASE WHEN SUM(booking.TICKETSAMOUNT) IS NOT NULL THEN SUM(booking.TICKETSAMOUNT) ELSE 0 END) AS availableTickets FROM events LEFT JOIN booking ON events.ID = booking.EVENTID WHERE events.ID = '$eventid'";
    $ticketsResult = $conn->query($sqlCheckAvailableTickets);
	
    $message = "";
	$receive_email_option = "";
	
    if($ticketsResult->num_rows > 0){
        $row = $ticketsResult->fetch_assoc();
        $availableTickets = $row['availableTickets'];

        if($availableTickets >= $ticketsamount){
            $sqlMakeBooking = "INSERT INTO booking (USERID, EVENTID, TICKETSAMOUNT) VALUES ('$userid', '$eventid', '$ticketsamount')";      // ON DUPLICATE KEY UPDATE TICKETSAMOUNT = TICKETSAMOUNT + $ticketsamount";
            $result = $conn->query($sqlMakeBooking);
            
            if ($result === TRUE) {       
                $message .= "Booking created successfully\n";
                $availableTickets -= $ticketsamount;
                $message .= "There are '{$availableTickets}' tickets available now!\n";
                
                
				$message .= '<div class="col-4 col-12-small">
										<input type="radio" id="opt-ticket-email" name="opt-ticket" value="receive_email" checked>
										<label for="opt-ticket-email">Send ticket to my email address</label>
									</div>
								<div class="col-4 col-12-small">
										<input type="radio" id="opt-ticket-cashier" name="opt-ticket" value="receive_from_cashier" >
										<label for="opt-ticket-cashier">Receive ticket from the cashier once paid</label>
									</div>';	
									
                $message .= "Go to " . "<a href='#' id='go-to-bookings'>Bookings</a>";  
									
            } else {
                $message .= "Error: " . $sqlMakeBooking . "\n" . $conn->error;
                $message .= "Try again.. " . "<a href='javascript:history.back()'>Go Back</a>";    
            }
        }
        else{
            $message .= "There are only '{$availableTickets}'! You asked for '{$ticketsamount}'!";
            $message .= "Try again.. " . "<a href='javascript:history.back()'>Go Back</a>";
        }
    }   
    else
    {
        $message .= "COULDN'T CALCULATE AVAILABLE TICKETS AMOUNt";
        $message .= "Try again.. " . "<a href='javascript:history.back()'>Go Back</a>";   
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
							<input type="hidden" value="<?php echo $eventid; ?>" id="eventId" />
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