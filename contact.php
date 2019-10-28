<?php 
	include 'inc/header.php';
?>
<div class="contentsection template clear">
	<div class="maincontent clear">
		<div class="contact">
			<h2>Contact Us</h2>
	<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$fname 	= $fm->validation($_POST['fname']);
				$lname 	= $fm->validation($_POST['lname']);
				$email 	= $fm->validation($_POST['email']);
				$body 	= $fm->validation($_POST['body']);
				$fname 	= mysqli_real_escape_string($db->link, $fname);
				$lname 	= mysqli_real_escape_string($db->link, $lname);
				$email 	= mysqli_real_escape_string($db->link, $email);
				$body 	= mysqli_real_escape_string($db->link, $body);

				$error = "";
				if (empty($fname)) {
					$error = 'First name must not be empty !';
				}elseif (empty($lname)) {
					$error = 'Last name must not be empty !';
				}elseif (empty($email)) {
					$error = 'Email address must not be empty !';
				}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$error = 'Invalid Email Address!';
				}elseif (empty($body)) {
					$error = 'Message field must not be empty !';
				}else{
					$query = "INSERT INTO contact (fname, lname, email, body) VALUES ('$fname', '$lname', '$email', '$body')";
                    $inserted   = $db->createData($query);
                    if ($inserted){
                        $msg = "Message Sent";
                    }else{
                       	$msg = "Message Not Sent";
                    }
				}
			}	

		?>

		<?php
			if (isset($error)) {
				echo "<span class='error'>".$error."</span>";
			}
			if (isset($msg)) {
				echo "<span class='success'>".$msg."</span>";
			}
		?>
		<form action="" method="post">
			<table>
			<tr><td>First Name</td> <td>:</td><td><input type="text" name="fname" placeholder="First Name"/></td></tr>
			<tr><td>Last Name</td> <td>:</td><td><input type="text" name="lname" placeholder="Last Name"/></td></tr>
			<tr><td>Email</td> <td>:</td><td><input type="text" name="email" placeholder="Enter email address"/></td></tr>
			<tr><td>Your Message</td> <td>:</td><td><textarea name="body" placeholder="Message"></textarea></td></tr>
			<tr><td></td> <td></td><td><input type="submit" name="send" value="Send"/></td></tr>
			</table>
		</form>
		</div>
		
		<div class="gmap">
		 <div id="map"></div>
		</div>
	</div>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>