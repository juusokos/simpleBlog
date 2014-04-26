<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
 
if (isset($_POST['username'], $_POST['email'], $_POST['p'])) {
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
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
 
    $prep_stmt = "SELECT ID FROM simple_users WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
        }
    } else {
        $error_msg .= '<p class="error">Database error</p>';
    }
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 
    if (empty($error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 
        // Create salted password 
        $password = hash('sha512', $password . $random_salt);
		
		
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO simple_users (username, email, password, salt) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ./error.php?err=Registration failure: INSERT');
            }else{
				 // SIVUSTON LUOMINEN
				// Valitaan ID tietokannasta
				$select = $mysqli->prepare("SELECT ID FROM simple_users WHERE email=?");
				
				$select->bind_param('s', $email);
				// Execute the prepared query.
				$select->execute();
				$select->bind_result($user_id);
				$select->fetch();
				$select->close();
				
				// Luodaan uusi sivu oletusteksteillä 
				//  Tähän voit kirjoittaa kuvauksen itsestäsi tai blogistasi. Muokkaa tätä tekstiä Asetukset - välilehdellä.
				$theme_id = 1;
				$font_id = 1;
				$about = 'Hei! Kerro, jotain sinustasi tai blogistasi';
				$blog_title = 'Uusi Simple Blogi';
				$blog_description = 'Kirjoita halutessasi blogillesi kuvaus';
				
				$luoBlogi = $mysqli->prepare("INSERT INTO simple_sites (user_ID, theme_ID, font_ID, about, blog_title, blog_description) VALUES (?, ?, ?, ?, ?, ?)");
				$luoBlogi->bind_param('iiisss', $user_id, $theme_id, $font_id, $about, $blog_title, $blog_description);
				$luoBlogi->execute();
				$luoBlogi->close();
				
				$select2 = $mysqli->prepare("SELECT simple_sites.ID FROM simple_sites, simple_users WHERE simple_sites.user_ID = simple_users.ID AND simple_users.email = ?");			
				$select2->bind_param('s', $email);
				$select2->execute();
				$select2->bind_result($site_id);
				$select2->fetch();
				$select2->close();
				
				$banner_url = './img/defaultBanner.JPG';
				$banner_url_thumb = './img/defaultBanner.JPG';
				$luoBanner = $mysqli->prepare("INSERT INTO simple_banner (site_ID, banner_url, banner_url_thumb) VALUES (?, ?, ?)");
				$luoBanner->bind_param('iss', $site_id, $banner_url, $banner_url_thumb);
				$luoBanner->execute();
				
			}
        }
       header('Location: login.php?register=success');
	
    }
	
	
}
?>
