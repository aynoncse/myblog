<?php
	include '../lib/Session.php';
	Session:: checkLogin();
?>

<?php
	include '../config/config.php';
	include '../lib/DB.php';
	include '../helpers/Format.php';
	$db = new DB();
	$fm = new Format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$email 	= $fm->validation($_POST['email']);
				$email = mysqli_real_escape_string($db->link, $email);
			
				$query		= "SELECT * FROM user WHERE email = '$email' LIMIT 1";
				$result 	= $db->selectData($query);

				if ($result != false) {
					$value 		= mysqli_fetch_array($result);
					$userid 	= $value['id'];
					$username 	= $value['username'];

					$text 		= substr($email, 0,3);
					$rand 		= rand(1000, 9999);
					$newpass	= "$text$rand";
					$password 	= md5($newpass);

					$query      = "UPDATE user SET                               
                                password  = '$password'
                                WHERE id = $userid AND email = '$email'";
                    $updated   = $db->updateData($query);

                    $to 		= $email;
                    $from 		= "aynonbiz@gmail.com";
                    $headers 	= "From: $from\n";
                    $headers 	.= "MIME-Version: 1.0" . "\r\n";
					$headers 	.= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$subject 	= "Your new password";
					$message 	= "hello $username your new password is $newpass. Now You can login and visit Code with Aynon. Thank You. ";

                    $sendmail = mail($to,$subject, $message,$headers);


                    if ($sendmail) {
                        echo "<span style ='color:green'>Password recovered successfully. Your New password has sent to your email.</span>";
                    }else{
                        echo "<span class='error'>Failed to recover your password. Try again.</span>";
                    }
				}else{
					echo "<span style='error'>This email is not exist.</span>";
				}

			}	
		?>
		<form action="" method="post">
			<h1 style="font-size: 20px">Recover Password</h1>
			<div>
				<input type="email" placeholder="Enter Your Email" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Submit" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="Login.php">Login</a>
		</div><!-- button -->
		<div class="button">
			<a href="../index.php" target="_blank">Code With Aynon</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>