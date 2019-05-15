<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<header id="header" class="alt">
    <a href="index.php" class="logo"><strong>Tickets4all</strong></a>
    <nav>
        <!--if there's been a login, we display the profile pic -->
        <?php if(isset($_SESSION['uid'])) echo "<a href='./bookings.php' title='User#{$_SESSION['uid']} \nGo to Bookings'><image src='images/user.png'/></a>"; ?>        
        <a href="#menu">Menu</a>
    </nav>
</header>