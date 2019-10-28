<?php 
	include 'inc/header.php';
?>

<?php
    if (!isset($_GET['pageid']) && $_GET['pageid'] == NULL) {
        echo "<script>window.location = '404.php';</script>";
    }else{
        $pageid = $_GET['pageid'];
    }
?>

<?php
    $query = "SELECT * FROM page WHERE id = '$pageid'";
    $page   = $db->selectData($query);
    if($page){
    $page = mysqli_fetch_array($page);
?> 
<div class="contentsection template clear">
	<div class="maincontent clear">
		<div class="about samepost">

      
			<h2><?php echo $page['name']?></h2>
			<p><?php echo $page['body']?></p>
		</div>
	</div>
<?php } else {
	header("Location: 404.php");
}?>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>