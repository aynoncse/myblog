<?php
	include 'config/config.php';
	include 'lib/DB.php';
	include 'helpers/Format.php';

	$db = new DB();
	$fm = new Format();

	if (isset($_GET['theme']) && $_GET['theme']=='blue') {
		$query = 'UPDATE themes SET theme = "blue" WHERE id =1';
		$updatheme = $db->updateData($query);
	}
	if (isset($_GET['theme']) && $_GET['theme']=='green') {
		$query = 'UPDATE themes SET theme = "green" WHERE id =1';
		$updatheme = $db->updateData($query);
	}
	if (isset($_GET['theme']) && $_GET['theme']=='dark') {
		$query = 'UPDATE themes SET theme = "dark" WHERE id =1';
		$updatheme = $db->updateData($query);
	}if (isset($_GET['theme']) && $_GET['theme']=='default')  {
		$query = 'UPDATE themes SET theme = "default" WHERE id =1';
		$updatheme = $db->updateData($query);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include 'scripts/meta.php'?>
		<?php include 'scripts/CSS.php'?>
<?php
	$query = "SELECT * FROM themes WHERE id =1";
	$theme = $db->selectData($query);
	if ($theme) {
		$theme = mysqli_fetch_array($theme);
		$theme = $theme['theme'];
	}
?>
		<?php if ($theme == 'blue'){?>
			<link rel="stylesheet" href="themes/blue.css">
		<?php } elseif ($theme == 'green'){?>
			<link rel="stylesheet" href="themes/green.css">
		<?php } elseif ($theme == 'dark'){?>
			<link rel="stylesheet" href="themes/dark.css">
		<?php } elseif ($theme == 'default'){?>
			<link rel="stylesheet" href="themes/default.css">
		<?php } else {?>
			<link rel="stylesheet" href="themes/default.css">
		<?php }?>
		<?php include 'scripts/js.php'?>		
	</head>

	<body>
	<div class="wrapper template clear">
		<div class="headersection template clear">
			<a href="index.php">
				<div class="logo">
<?php 
    $query  = "SELECT * FROM title_slogan WHERE id = 1";
    $result = $db->selectData($query);
    if ($result){
        $logo = mysqli_fetch_array($result);
    }
?>
					<img src="admin/<?php echo $logo['logo'];?>" alt="Logo"/>
					<h2><?php echo $logo['title'];?></h2>
					<p><?php echo $logo['slogan'];?></p>
				</div>
			</a>

			<div class="themebtn">
				<ul>
					<li><a href="?theme=blue" style="color: #2AAEFD;" title="Blue">&FilledSmallSquare;</a></li>
					<li><a href="?theme=green" style="color: #1DA261;" title="Green">&FilledSmallSquare;</a></li>
					<li><a href="?theme=dark" style="color: #282923;" title="Dark">&FilledSmallSquare;</a></li>
					<li><a href="?theme=default" style="color: #D5A200;" title="Default">&FilledSmallSquare;</a></li>
				</ul>
			</div>

			<div class="social">
		<?php
			$query = "SELECT * FROM social WHERE id = 1";
			$result = $db->selectData($query);
		    if ($result){
		        $social = mysqli_fetch_array($result);
		    }
		?>
				<a target="_blank" href="<?php echo $social['fb'];?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
				<a target="_blank" href="<?php echo $social['tw'];?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
				<a target="_blank" href="<?php echo $social['ln'];?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
				<a target="_blank" href="<?php echo $social['gp'];?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a>	
			</div>
			<div class="searchbtn clear">
				<form action="search.php" method="get">
					<input type="text" name="keyword" placeholder="Search Keyword..."/>
					<input type="submit" name="submit" value="Go" />
				</form>
			</div>
		</div>

		<div class="navsection template">
			<ul>
				<li><a 
				<?php if ($fm->title() == 'Home') {
					echo "id='active'";
				};?>
				href="index.php">Home</a></li>
				<?php
                    $query  = "SELECT * FROM page";
                    $pages  = $db->selectData($query);
                    if ($pages) {
                        while ($page = $pages->fetch_assoc()) {
                ?>
                <li><a 

                	<?php
                	if (isset($_GET['pageid']) && $_GET['pageid'] == $page['id']) {
                			echo "id='active'";
                		}	
                	?>
                	href="page.php?pageid=<?php echo $page['id'];?>"><?php echo $page['name'];?></a></li>
                <?php } }?>
				<li><a href="#">Product</a>
					<ul>
						<li><a href="#">Product One</a></li>
						<li><a href="#">Product Two</a></li>
						<li><a href="#">Product Three</a></li>
						<li><a href="#">Product Four</a></li>
						<li><a href="#">Product Five</a></li>
					</ul>
				
				</li>
				<li><a 
					<?php if ($fm->title() == 'Contact') {
					echo "id='active'";
				};?>
					href="contact.php">Contact</a></li>
			</ul>
		</div>