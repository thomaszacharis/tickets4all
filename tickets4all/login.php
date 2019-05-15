<?php
session_start();
$sourcePage = "";

if(isset($_SESSION['uid'])){
    header("Location: index.php");
}
elseif(!empty($_GET['r'])){
    //if the user was re-directed here from another webpage, then a GET argument is inserted in the link and we store it in order to 
    //redirect the user back to the webpage he got re-directed from.
    $sourcePage = $_GET['r'];
}
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

                <!-- Login -->
                    <section id="login">
                        <div class="inner">
                            <section>
                                <form method="post" action="action_login.php" name="UserLogin" onsubmit="return validateUserLoginCredentials()">
                                    <h1>Login</h1>
                                    <div class="fields">
                                        <div class="field half">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" required />
                                        </div>
                                        <div class="field half">
                                                <label for="pass">Password</label>
                                                <input type="password" name="pass" id="pass" required />                                                
                                            </div>
                                    </div>
                                    <input type="hidden" value='<?php echo $sourcePage; ?>' name='pageToGo'/>
                                    <ul class="actions">
                                        <li><input type="submit" value="Login" class="primary" /></li>
                                        <li><input type="reset" value="Clear" /></li>
                                    </ul>
                                </form>
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