<?php
	include 'inc/header.php';
?>
<div class="contentsection template clear">
	<div class="maincontent clear">
	<?php
		if (!isset($_GET['keyword']) || $_GET['keyword'] == NULL){
					header("Location: 404.php");
				} else {
					$keyword = $_GET['keyword'];
				}
		$query 	= "SELECT * FROM post WHERE title LIKE '%$keyword%' OR body LIKE '%$keyword%' OR author LIKE '%$keyword' OR tags LIKE '%$keyword%' ";
		$result 	= $db->selectData($query);
		if ($result) {
			while ($post = $result->fetch_assoc()) {
			
	?>
	<div class ="samepost clear">
		<h2>
			<a href="post.php?id=<?php echo $post['id'];?>">
				<?php echo $post['title'];?>
			</a>
		</h2>
		<h4>
			<?php echo $fm->formatDate($post['date']);?> | By <a href="#"><?php echo $post['author'];?></a>
		</h4>
		<a href="#"><img src="admin/<?php echo $post['image'];?>" alt="post image" /></a>
		<?php echo $fm->textShorten($post['body']);?>
		<div class="readmore clear">
			<a href="post.php?id=<?php echo $post['id'];?>">Read More...</a>
		</div>
	</div>
<?php } ?> <!-- End of While Loop -->
<?php } else{?>
	<p>Your Search Query Not Found!!</p>
<?php }?>		
</div>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>
		
