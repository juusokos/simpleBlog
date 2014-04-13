<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.
 
    if (login($email, $password, $mysqli) == true) {
        // Login success 
        
        $user_id = htmlentities($_SESSION['user_id']);
        $SQL = "SELECT simple_sites.ID FROM simple_sites
                    		INNER JOIN simple_users ON simple_users.ID = simple_sites.user_ID
    						WHERE simple_users.ID = '$user_id';";
	
					$STH = @$DBH->query($SQL);
					$STH->setFetchMode(PDO::FETCH_OBJ);
					$site_id = $STH->fetch();
					
					$_SESSION['site_id'] = $site_id->ID;
        header('Location: ./artikkelit.php');
    } else {
        // Login failed 
        header('Location: ../index.php?error=1');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}      
?>
