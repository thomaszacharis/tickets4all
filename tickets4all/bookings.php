<?php
    session_start();
    if(!isset($_SESSION['uid'])){
        header("Location: index.php");
    }

    $userID = $_SESSION['uid'];
    include 'Booking.php';
        
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'tickets4all';
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($conn->connect_error) {
        die('Could not connect: ' . $conn->connect_error);
    }

    $sqlGetEvents = "SELECT booking.*, events.ID AS eventID, events.TITLE AS eventTitle FROM booking INNER JOIN events ON booking.EVENTID = events.ID WHERE booking.USERID='$userID' AND events.DATE >= CURDATE()";
    $result = $conn->query($sqlGetEvents);  
    
    $bookingsFound = false;
    $bookingsReceived = array();

    while ($row = $result->fetch_assoc()) {
        $newBooking = new Booking($row['ID'], $row['USERID'], $row['EVENTID'], $row['TICKETSAMOUNT']);            
        $newBooking->setEventTitle($row['eventTitle']);
		$eventID = $row['EVENTID'];
		$sqlGetTicketInfo = "SELECT * FROM tickets WHERE EVENTID='$eventID'";
        $result2 = $conn->query($sqlGetTicketInfo); 
		$row2 = $result2->fetch_assoc();
		
        $newBooking->setEventTicketPrice($row2['PRICE']);
        $bookingsReceived[] = $newBooking;
        $bookingsFound = true;
    }  
        
?>
<!DOCTYPE HTML>
<!--
	Forty by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <?php include 'heading.html'; ?>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
                <?php include 'header.php'; ?>

				<!-- Menu -->
                <?php include 'menu.php'; ?>

                <!-- Banner -->
				<!-- Note: The "styleN" class below should match that of the header element. -->
                <section id="banner" class="style2">
                    <div class="inner">
                        <span class="image">
                            <img src="images/pic07.jpg" alt="" />
                        </span>
                        <header class="major">
                            <h1>Bookings</h1>
                        </header>
                        <div class="content">
                            <p>Here is the list of your bookings:</p>
                        </div>
                    </div>
                </section>

				<!-- Main -->
					<div id="main" class="alt">

						<!-- One -->
                        <section id="one" class="spotlights">
                                <?php
                                    foreach($bookingsReceived as $booking){
                                        //echo "<p>{$event->getTitle()}</p>";
                                        //we take the image using a "blob" format to create an imgsource string
										//$imgSource = "data:image/jpeg;base64,".base64_encode($event->getImage());																				
                                        echo "<section>
												<a href='#' class='image left'>
													<img src='' alt='' data-position='center center' />
												</a>
												<div class='content'>
													<div class='inner'>
														<header class='major'>
															<h3>{$booking->getEventTitle()}</h3>
														</header>
                                                        <p>Tickets: {$booking->getTicketsAmount()}</p>		
                                                        <p>Price Sum: {$booking->getSumPrice()} €</p>												
													</div>
												</div>
											</section>";
									}
									if(count($bookingsReceived) == 0){
										echo "<div class='inner'><h3>No bookings found. Sorry.</h3></div>";
									}
                                ?>						
							</section>
					</div>				

				<!-- Footer -->
                <?php include 'footer.html'; ?>

			</div>

		<!-- Scripts -->
		<?php include 'allscripts.html'; ?>

	</body>
</html>