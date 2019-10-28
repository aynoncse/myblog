<?php 
	include 'inc/header.php';
?>
<div class="contentsection template clear">
	<div class="maincontent clear">
		<div class="post clear">
			<?php
				if (!isset($_GET['id']) || $_GET['id'] == NULL) {
					header("Location: 404.php");
				} else{
					$id = $_GET['id'];
				}
				$query = "SELECT * FROM post WHERE id = $id";
				$result 	= $db->selectData($query);

				if ($result) {
					while ($post = $result->fetch_assoc()) {
			?>
				<h2>
				<a href="post.php?id=<?php echo $post['id'];?>">
					<?php echo $post['title'];?>
				</a>
			</h2>
			<h4>
				<?php echo $fm->formatDate($post['date']);?> | By <a href="#"><?php echo $post['author'];?></a>
			</h4>
			<img src="admin/<?php echo $post['image'];?>" alt="post image" />
			<?php echo $post['body'];?>
			</div>
		<div class="relatedpost clear">
			<h2>Related Post</h2>
		<?php 
			$catid = $post['cat'];
			$relatedquery = "SELECT * FROM post WHERE cat = $catid";
			$relatedresult 	= $db->selectData($relatedquery);

			if ($relatedresult) {
				while ($relatedpost = $relatedresult->fetch_assoc()) {
		?>
			<a href="post.php?id=<?php echo $relatedpost['id'];?>""><img src="admin/<?php echo $relatedpost['image'];?>"/></a>
		
		<?php }}else{ echo "No Related Post";}?>
		<?php }}else{
			header("Location: 404.php");
		}
		?>	
		</div>	
		<div class="readmore"><a href="index.php">Back</a></div>
	</div>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>
		
