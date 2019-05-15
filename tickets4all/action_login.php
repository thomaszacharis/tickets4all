<?php
    session_start();
    include 'User.php';
    
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pageToGo = $_POST['pageToGo'];

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'tickets4all';
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if($conn->connect_error) {
        die('Could not connect: ' . $conn->connect_error);
    }
        

    $sqlCheckUserCredentials = "SELECT * FROM login WHERE EMAIL='$email' AND PASSWORD='$pass'";
    $result = $conn->query($sqlCheckUserCredentials);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
		$sqlGetUserId = "SELECT * FROM accountinfo WHERE EMAIL='$email' ";
        $result2 = $conn->query($sqlGetUserId);
	    $row2 = $result2->fetch_assoc();
        //means how the user was located with user and password        
        $_SESSION['uid'] = $row2['ID'];
        if(empty($pageToGo)){
            header("Location: index.php");
        }
        else{
            header("Location: {$pageToGo}");
        }
        
    } else {
        //after checking there is not a user and password
        header("Location: login.php");
    }

    
    
    $conn->close();

?>