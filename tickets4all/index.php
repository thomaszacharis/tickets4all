<?php
session_start();
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

				<!-- Banner -->
					<section id="banner" class="major">
						<div class="inner">
							<header class="major">
								
								<form name="searchForm" id="searchForm" method="get" action="eventslist.php"><h1>Search event:</h1>
									<input type="text" name="q" id="q" value="" placeholder="e.g. The Mode"/>
								</form>
								
							</header>
							<div class="content">
								<p>Search an event or venue</p>
								<ul class="actions">
									<li><button type="submit" form="searchForm" value="Search Now" class="button next">Search Now</button><!--<a href="eventslist.php?q=" class="button next scrolly" onclick="headerSearch()">Search Now</a></li>-->
								</ul>
							</div>
						</div>
					</section>

				<!-- Main -->
					<div id="main">

						<!-- One -->
							<section id="one" class="tiles">
								<article>
									<span class="image">
										<img src="images/picArts.jpg" alt="" />
									</span>
									<header class="major">
										<h3><a href="eventslist.php?cat=Arts" class="link">Arts</a></h3>
										<p>Exhibitions, Performances etc.</p>
									</header>
								</article>
								<article>
									<span class="image">
										<img src="images/picSports.jpg" alt="" />
									</span>
									<header class="major">
										<h3><a href="eventslist.php?cat=Sports" class="link">Sports</a></h3>
										<p>Football, Basketball, Volley, Tae Kwon Do etc.</p>
									</header>
								</article>
								<article>
									<span class="image">
										<img src="images/picCinema.jpg" alt="" />
									</span>
									<header class="major">
										<h3><a href="eventslist.php?cat=Cinema" class="link">Cinema</a></h3>
										<p>Movies</p>
									</header>
								</article>
								<article>
									<span class="image">
										<img src="images/picMusic.jpg" alt="" />
									</span>
									<header class="major">
										<h3><a href="eventslist.php?cat=Music" class="link">Music</a></h3>
										<p>Lives, Events etc.</p>
									</header>
								</article>
							</section>

						<!-- Two -->
							<section id="two">
								<div class="inner">
									<header class="major">
										<h2>Register Now</h2>
									</header>
									<p>If you want to book a ticket you can <a href="register.php">register here!</a></p>
									<ul class="actions">
										<li><a href="register.php" class="button next">Register Now</a></li>
									</ul>
								</div>
							</section>

					</div>

				<!-- Footer -->				
				<?php include "footer.html"; ?>

			</div>

		<!-- Scripts -->
		<?php include 'allscripts.html'; ?>

	</body>
</html>