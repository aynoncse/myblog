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
				$username 	= $fm->validation($_POST['username']);
				$password 	= $fm->validation($_POST['password']);

				$username = mysqli_real_escape_string($db->link, $username);
				$password = mysqli_real_escape_string($db->link, $password);

				$password 	= md5($password);
				
				$query		= "SELECT * FROM user WHERE username = '$username' AND password = '$password'";

				$result 	= $db->selectData($query);
			
				if ($result != false) {
					$value 	= mysqli_fetch_array($result);
					Session::set("login", true);
					Session::set("username", $value['username']);
					Session::set("userID", $value['id']);
					Session::set("userRole", $value['role']);
					header("Location: index.php");
				}else{
					echo "<span style='error'>Username or password not matched!!</span>";
				}
			}	
		?>
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="forgetass.php">Forgort Password?</a>
		</div><!-- button -->
		<div class="button">
			<a href="../index.php" target="_blank">Code With Aynon</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>