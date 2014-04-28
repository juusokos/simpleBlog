
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unohtunut salasana</title>
</head>
<body>
   <head>
                <title> Salasana unohtui </title>
				
				<meta charset="utf-8">
                <script type="text/javascript" src="js/sha512.js"></script>
                <script type="text/javascript" src="js/forms.js"></script>
                <script src="./js/jquery-2.0.3.min.js"></script>
                <link href="css/bootstrap.min.css" rel="stylesheet">
				<link href="css/login.css" rel="stylesheet">
        </head>
        <body>
	
		<a id="luoBlogi" class="btn btn-success" href="register.php">Luo Blogi</a>
			<div id="logo">
				<a class="brand" href="index.php"><img src="img/logo.png" alt="Simple Blog logo" width= "200px"></a>
            </div>
			

<form class="form-signin" method="post" name="login_form" action="">

<h1 class="form-signin-heading">Luo uusi salasana</h1>

<p>Syötä sähköpostiosoitteesi, lähetämme sinulle uuden salasanan</p>

<p>Sähköpostiosoite: <input class="form-control" type="text" name="email" size="20″ maxlength="40″ value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>

<input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Lähetä" 
				onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);"/>

</form>

</body>
</html>

<?php session_start();
include "db_connect.php"; //connects to the database
if (isset($_POST['email'])){
    $email = $_POST['email'];
    $SQL="SELECT * FROM simple_users where email='$email'";
    //$result   = mysql_query($query);
	$STH = @$DBH->query($SQL);
	$STH->setFetchMode(PDO::FETCH_OBJ);

    // If the count is equal to one, we will send message other wise display an error message.
    if($STH->rowCount() == 0)
    {
	  if ($_POST ['email'] != "") {
    echo '<span style="color: #ff0000;">Sähköpostiosoitetta ei ole</span>';
        }
      
    } else {
	
		function generate_password( $length = 8 ) {
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
			$password = substr( str_shuffle( $chars ), 0, $length );
			return $password;
		}
	
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
		include_once 'new_password.php';
        }
    //If the message is sent successfully, display sucess message otherwise display an error message.
    if($sentmail==1)
    {
        echo '<span style="color:green;"> Salasanan lähetys onnistui!</span>';
    }
        else
        {
        if($_POST['email']!="")
        echo '<span style="color:red"> Ongelma salasanan lähettämisessä</span>';
    }
}
?>
