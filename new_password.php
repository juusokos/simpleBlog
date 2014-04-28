<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
 
function generate_password( $length = 8 ) {
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
			$password = substr( str_shuffle( $chars ), 0, $length );
			return $password;
}
 
if (isset($_POST['email'],$_POST['p'])) {
    // Sanitize and validate the data passed in
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
	
	
   $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //

 
    if (empty($error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 
        // Create salted password 
        $password = hash('sha512', $password . $random_salt);
        
    	$SQL="SELECT * FROM simple_users where email='$email'";
    	//$result   = mysql_query($query);
		$STH = @$DBH->query($SQL);
		$STH->setFetchMode(PDO::FETCH_OBJ);

    	// If the count is equal to one, we will send message other wise display an error message.
    	if($STH->rowCount() == 0){
	  		if ($_POST ['email'] != "") {
   				echo '<span style="color: #ff0000;"> Not found your email in our database</span>';
        	}
      	} else {

			while ($row = $STH->fetch()):
        	$pass  =  $row->password;//FETCHING PASS
			$new_pass = generate_password();
			echo "generated pass:".($new_pass)."";
        	$to = $row->email;
        	//echo "your email is ::".$email;
        	//Details for sending E-mail
        	$from = "Simple Blog";
        	$url = "simpleblog.fi";
        	$body  =  "Coding Cyber password recovery Script
        	-----------------------------------------------
        	Url : $url;
        	email Details is : $to;
        	Here is your password  : $new_pass;
        	Sincerely,
        	Simple Blog";
        	$from = "simpleblog@simpleblog.com";
        	$subject = "simpleBlog Password recovered";
        	$headers1 = "From: $from\n";
        	$headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
        	$headers1 .= "X-Priority: 1\r\n";
        	$headers1 .= "X-MSMail-Priority: High\r\n";
        	$headers1 .= "X-Mailer: Just My Server\r\n";
       		$sentmail = mail ( $to, $subject, $body, $headers1 );
			endwhile; 
        }
    	//If the message is sent successfully, display sucess message otherwise display an error message.
    	if($sentmail==1){
       		echo '<span style="color:green;"> Salasanan lähetys onnistui!</span>';
    	} else {
        if($_POST['email']!="")
        	echo '<span style="color:red"> Ongelma salasanan lähettämisessä</span>';
    	}	
		 
       header('Location: login.php?newpass=success');
	
    }
	
	
}
?>
