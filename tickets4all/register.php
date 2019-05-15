<?php
session_start();

if(isset($_SESSION['uid'])){
    header("Location: index.php");
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

                <!-- Register -->
                    <section id="register">
                        <div class="inner">
                            <section>
                                <form method="post" action="action_register.php" name="UserRegister" onsubmit="return validateUserRegisterFields()">
                                    <h1>Register</h1>
                                    <div class="fields">
                                        <div class="field half">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" maxlength='255' required />
                                        </div>
                                        <div class="field half">
                                            <label for="surname">Surname</label>
                                            <input type="text" name="surname" id="surname" maxlength='255' required />
                                        </div>
                                        <div class="field half">
                                            <label for="gender">Gender</label>
                                            <select name="gender">
                                                <option value="m" default>Male</option>
                                                <option value="f">Female</option>
                                                <option value="o">Other</option>
                                            </select>
                                        </div>
                                        <div class="field half">
                                            <label for="telephone">Telephone</label>
                                            <input type="tel" name="telephone" id="telephone" maxlength='10' required />
                                        </div>
                                        <div class="field half">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" id="address" maxlength='255' required />
                                        </div>
                                        <div class="field quarter">
                                            <label for="postalcode">Postal Code</label>
                                            <input type="text" name="postalcode" id="postalcode" maxlength='255' required />
                                        </div>
                                                                                
                                        <div class="field half">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" maxlength='255' required />
                                        </div>
                                        <div class="field half">
                                            <label for="pass">Password</label>
                                            <input type="password" name="pass" id="pass" minlength='6' maxlength='24' required />                                                
                                            <label>6-24 characters</label>
                                        </div>
                                    </div>
                                    <ul class="actions">
                                        <li><input type="submit" value="Register" class="primary" /></li>
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