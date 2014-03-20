<?php
include 'db_connect.php';
include 'functions.php';
sec_session_start();

if(isset($_POST['email'], $_POST['p'])){
	$email = $_POST['email'];
	$password = $_POST['p'];  
	if(login($email, $password, $mysqli) == true){
		echo 'Success: You have been logged in!';1
	} else {
		echo 'nope';
		//header('Location: ./');
	}
} else {
	echo 'Invalid Request';
}

/**
//... process_login.php
        
//include 'functions.php';
//login processing page
sec_session_start();
//Unset all session values
$_SESSION= array();
$params= session_get_cookie_params();
setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
session_destroy();
header('Location: ./');
/**
//Logout script
$password = $_POST['p'];
$random_salt= hash('sha512', uniqid(mt_rand(1, my_getrandmax()),true));
$password =hash('sha512', $password.$random_salt);
        
//insert to database script here
if($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)")){
        $insert_stmt->bind_param('ssss',$username, $email, $password, $random_salt);
        $insert_stmt->execute();
        
}
        
 **/       

?>
