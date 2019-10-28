<?php include 'inc/header.php';?>
<?php 
	if (!isset($_GET['id']) || $_GET['id'] == NULL) {
		header("Location: 404.php");
	} else{
		$id = $_GET['id'];
	}
?>
<div class="contentsection template clear">
	<div class="maincontent clear">
<?php
	$query 	= "SELECT * FROM post WHERE cat='$id'";
	$result 	= $db->selectData($query);
	if ($result) {
		while ($post = $result->fetch_assoc()) {
		
?>
		<div class ="samepost clear">
			<h2><a href="post.php?id=<?php echo $post['id'];?>"><?php echo $post['title'];?></a></h2>
			<h4><?php echo $fm->formatDate($post['date']);?> | By <a href="#"><?php echo $post['author'];?></a></h4>
			<a href="#"><img src="admin/<?php echo $post['image'];?>" alt="post image"/></a>
			<p><?php echo $fm->textShorten($post['body']);?></p>
			<div class="readmore"><a href="post.php?id=<?php echo $post['id'];?>">Read More...</a></div>
		</div>
<?php } } else{
	echo "<script>window.location = '404.php';</script>";
}?>
	</div>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>
		
