<?php
    session_start();
    include 'Event.php';
        
    $eventID = $_GET['ev'];

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'tickets4all';
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($conn->connect_error) {
        die('Could not connect: ' . $conn->connect_error);
    }

    $sqlGetEvents = "SELECT events.*, venues.VENUENAME FROM events INNER JOIN venues ON events.VENUEID = venues.ID WHERE events.ID='$eventID'";
    $result = $conn->query($sqlGetEvents);  
    
    $eventFound = false;

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
		
		$sqlGetTicketInfo = "SELECT * FROM tickets WHERE EVENTID='$eventID'";
        $result2 = $conn->query($sqlGetTicketInfo); 
		$row2 = $result2->fetch_assoc();
		
        $newEvent = new Event($row['ID'], $row['TITLE'], $row['DESCRIPTION'], $row['TIME'],  $row['DATE'], $row['VENUEID'], $row2['PRICE'], $row['AVAILABILITY'], $row['IMAGE'], $row['duration']);            
        $newEvent->setVenueName($row['VENUENAME']);
		$newEvent->setTicketPrice($row2['PRICE']);
        $eventFound = true;
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

				<!-- Main -->
					<div id="main" class="alt">

						<!-- One -->
							<section id="one">
								<div class="inner">
									<header class="major">
										<h1><?php if($eventFound) {echo $newEvent->getTitle();} else echo "Event Not Found" ?></h1>
                                    </header>
                                    
                                    <?php 
                                        if($eventFound) {
                                            //we take the image with a "blob" format, create an imgsource string suitable for display 
                                            $imgSource = "data:image/jpeg;base64,".base64_encode($newEvent->getImage());
                                            //display the image
                                            echo "<span class='image left'><img src='$imgSource' alt='' /></span>";
                                            //display time and date
                                           
                                            $formattedDate = date('d/m/Y', strtotime($newEvent->getDate()));
                                            $formattedTime = date('H:i', strtotime($newEvent->getTime()));

                                            echo "<label> Date: " . $formattedDate . "</label>";
                                            echo "<label> Time: " . $formattedTime . "</label>";
                                            //display venue
                                            echo "<label> Venue: " . $newEvent->getVenueName() . "</label>";
                                            //display price
                                            echo "<label> Price: " . $newEvent->getTicketPrice() . "€ </label>";
                                            //display description
                                            echo "<p>" . $newEvent->getDescription() . "</p>";
                                        }
                                    ?>									
                                </div>
                                
                            <!-- Booking -->
                                <div class="inner">
                                    <?php
                                        if($eventFound){
                                            if(isset($_SESSION['uid'])){ 

											
                                                echo "<form method='post' action='action_book.php' name='BookTicket' onsubmit='return validateBookTicket()' id='frmBooknow'><h2>Book now:</h2>
                                                        <div class='fields'>
                                                            <input type='hidden' name='eventid' value='{$newEvent->getEventID()}' />
                                                            <div class='field fifth'>
                                                                <label for='ticketsQuantity'>Tickets</label>
                                                                <input type='number' pattern='[0-9]*' inputmode='numeric' name='ticketsQuantity' id='ticketsQuantity' min='1' max='10' value='1' />                                                            
                                                            </div>    
															
                                                        </div>
                                                        ";
                                                        ?>
														<div class="col-4 col-12-small">
																<input type="radio" id="demo-priority-normal" name="demo-priority" value="online" checked>
																<label for="demo-priority-normal">Pay Online</label>
															</div>
														<div class="col-4 col-12-small">
																<input type="radio" id="demo-priority-low" name="demo-priority" value="cashier" >
																<label for="demo-priority-low">Pay at the Cashier</label>
															</div>
															
															<input style='display:none' type='submit' value='Book' class='primary' id='bookbtn'/>
                                                        </form>
															
															
                                                         <div id="paypal-button-container" ></div>

    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AevtE1ub7FVDHJpBeEF6s5fJbpJ7ATu4UPAZTzvZzJXsmwvNRNKwl_2YPRQbZ9aZd9LIQ0T53bB38dtq&currency=EUR"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        var totalPrice;
        paypal.Buttons({
        	onClick: function(){
        		price = <?php echo $newEvent->getTicketPrice()?>;
        		ticketsQuantity = jQuery('#ticketsQuantity').val();
        		totalPrice = price * ticketsQuantity;
        	},
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: totalPrice
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                    jQuery('#frmBooknow').submit();
                });
            }


        }).render('#paypal-button-container');
    </script>
	

                                                        <?php
                                            }
                                            else{
                                                echo "<p>In order to book tickets you must be <a href='login.php?r={$_SERVER["REQUEST_URI"]}'>logged in!</a></p>";
                                                echo "<p>Don't you have an account? <a href='register.php'>Register now!</a></p>";
                                            }
                                        }
                                    ?>
                                </div>
                            </section>

					</div>				

				<!-- Footer -->
                <?php include 'footer.html'; ?>

			</div>

		<!-- Scripts -->
		<?php include 'allscripts.html'; ?>

	</body>
</html>