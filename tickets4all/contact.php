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

                <!-- Contact -->
                    <section id="contact">
                        <div class="inner">
                            <section>
                                <h1>Contact Us</h1>
                                <form method="post" action="#" onsubmit="sendContactMessage()">
                                    <div class="fields">
                                        <div class="field half">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" />
                                        </div>
                                        <div class="field half">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" />
                                        </div>
                                        <div class="field">
                                            <label for="message">Message</label>
                                            <textarea name="message" id="message" rows="6"></textarea>
                                        </div>
                                    </div>
                                    <ul class="actions">
                                        <li><input type="submit" value="Send Message" class="primary" /></li>
                                        <li><input type="reset" value="Clear" /></li>
                                    </ul>
                                </form>
                            </section>
                            <section class="split">
                                <section>
                                    <div class="contact-method">
                                        <span class="icon alt fa-envelope"></span>
                                        <h3>Email</h3>
                                        <a href="#">information@tickets4all.tld</a>
                                    </div>
                                </section>
                                <section>
                                    <div class="contact-method">
                                        <span class="icon alt fa-phone"></span>
                                        <h3>Phone</h3>
                                        <span>(0030) 231058824X</span>
                                    </div>
                                </section>
                                <section>
                                    <div class="contact-method">
                                        <span class="icon alt fa-home"></span>
                                        <h3>Address</h3>
                                        <span>Alexandrou Papanastasiou 12<br />
                                        Thessaloniki, TK 57008<br />
                                        Greece</span>
                                    </div>
                                </section>
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