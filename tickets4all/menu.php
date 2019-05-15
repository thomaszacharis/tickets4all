<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- Menu -->
<nav id="menu">
    <ul class="links">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="help.php">Help</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <ul class="actions stacked">
            <?php if(isset($_SESSION['uid'])){
                echo "<li><a href='action_logout.php' class='button fit'>Log Out</a></li>";
            }
            else{
                echo "<li><a href='register.php' class='button primary fit'>Register</a></li>";
                echo "<li><a href='login.php"; 
                if(!basename($_SERVER['PHP_SELF']) == "login.php") {
                    echo "?r={$_SERVER["REQUEST_URI"]}";
                }
                echo "' class='button fit'>Log In</a></li>";
            }
            ?>
        </ul>
</nav>