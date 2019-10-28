<?php
	include 'inc/header.php';
	include 'inc/slider.php';
	
?>		
	<div class="contentsection template clear">
		<div class="maincontent clear">
<!--Pagination Start-->
<?php 
	$per_page = 3;
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}else{
		$page = 1;
	}
	$start_form = ($page-1) * $per_page;
?>
<!--Pagination Start-->
<?php
	$query 	= "SELECT * FROM post LIMIT $start_form, $per_page";
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
<?php }?>
<!-- End of While Loop -->
<!-- End of While Loop -->
<!--Pagination Start-->
	<?php 
	$query = "SELECT * FROM post";
	$result 		= $db->selectData($query);
	$total_rows 	= mysqli_num_rows($result);
	$total_pages 	= ceil($total_rows / $per_page);
	?>
	<?php
		if ($total_pages>1) {
			echo "<span class='pagination'><a href='index.php?page=1'>".'First Page'."</a>";
		  	for($i=1; $i <= $total_pages; $i++){
			echo "<a href='index.php?page=$i'>".$i."</a>";
		}
		echo "<a href='index.php?page=$total_pages'>".'Last Page'."</a></span>";
	}	
	?>
	
	<!--Pagination End-->

<?php } else{
	header("Location: 404.php");
}
?>		
</div>
<?php include 'inc/sidebar.php';?>
<?php include 'inc/footer.php';?>