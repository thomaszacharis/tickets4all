<?php
	session_start();
    include 'Event.php';
	
	$pageTitle = "Events list";
	$pagePurpose = "";

	if(!empty($_GET['cat'])){
		$categoryName = $_GET['cat'];
		$pageTitle = $categoryName;
		$pagePurpose = "category";
	}
    else if(!empty($_GET['q'])){
		$searchQuery = $_GET['q'];
		$pageTitle = "Results for '" . $searchQuery ."'";
		$pagePurpose = "search";
	}

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'tickets4all';
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($conn->connect_error) {
        die('Could not connect: ' . $conn->connect_error);
    }

	$eventsReceived = array();
	$sqlGetEvents = "";

	if($pagePurpose == "category"){
		$sqlGetEvents = "SELECT * FROM events WHERE CATEGORY='$categoryName' AND events.DATE >= CURDATE()";
	}
	else if($pagePurpose == "search"){
		$sqlGetEvents = "SELECT * FROM events WHERE TITLE LIKE '%$searchQuery%' AND events.DATE >= CURDATE()";
	}

    if($sqlGetEvents != ""){
		$result = $conn->query($sqlGetEvents);

		while ($row = $result->fetch_assoc()) {
			$newEvent = new Event($row['ID'], $row['TITLE'], $row['DESCRIPTION'], $row['TIME'],  $row['DATE'], $row['VENUEID'],  $row['AVAILABILITY'], $row['IMAGE'], $row['duration']);            
			$eventsReceived[] = $newEvent;    
		}
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
								<h1><?php echo $pageTitle; ?></h1>
							</header>
							<div class="content">
								<p>Here is the list of events:</p>
							</div>
						</div>
					</section>

				<!-- Main -->
					<div id="main">	

						<!-- One -->
							<section id="one" class="spotlights">
                                <?php
                                    foreach($eventsReceived as $event){
                                        //echo "<p>{$event->getTitle()}</p>";
                                        //we take the image with a "blob" format, create an imgsource string suitable for display
										$imgSource = "data:image/jpeg;base64,".base64_encode($event->getImage());																				
                                        echo "<section>
												<a href='eventmain.php?ev={$event->getEventID()}' class='image left'>
													<img src='$imgSource' alt='' data-position='center center' />
												</a>
												<div class='content'>
													<div class='inner'>
														<header class='major'>
															<h3>{$event->getTitle()}</h3>
														</header>
														<p>{$event->getDescription()}</p>
														<ul class='actions'>
															<li><a href='eventmain.php?ev={$event->getEventID()}' class='button'>Learn more</a></li>
														</ul>
													</div>
												</div>
											</section>";
									}
									if(count($eventsReceived) == 0){
										echo "<div class='inner'><h3>No events found matching the given criteria. Sorry.</h3></div>";
									}
                                ?>						
							</section>
					</div>				

				<!-- Footer -->
				<!-- <footer include-html="footer.html" id="footer">
					
				</footer> -->

				
				<?php include 'footer.html' ?>
				
			</div>

		<!-- Scripts -->			
			<?php include 'allscripts.html'; ?>

	</body>
</html>