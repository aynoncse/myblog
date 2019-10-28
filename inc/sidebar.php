<div class="sidebar clear">
	<div class="samesidebar clear">
		<h2>Catagories</h2>
		<ul>
		<?php
			$catquery = "SELECT * FROM category";
				$catresult 	= $db->selectData($catquery);

				if ($catresult) {
					while ($cat = $catresult->fetch_assoc()) {
		?>
			<li><a href="posts.php?id=<?php echo $cat['id'];?>"><?php echo $cat['name']?></a></li>
		<?php }} else{?>
			<li>No Catagory Created</li>
		<?php }?>
		</ul>
	</div>
	<div class="samesidebar clear">
		<h2>Latest Articles</h2>
		<?php 
			$query 	= "SELECT * FROM post  ORDER BY id DESC LIMIT 4";
			$result = $db->selectData($query);

				if ($result) {
					while ($post = $result->fetch_assoc()) {
		?>
		<div class="popular clear">
			<a href="post.php?id=<?php echo $post['id'];?>"><h3><?php echo $post['title'];?></h3></a>
			<a href="post.php?id=<?php echo $post['id'];?>"><img src="admin/<?php echo $post['image'];?>" alt="post image" /></a>
			<?php echo $fm->textShorten($post['body'],120);?>
		</div>
<?php } } else{
	header("Location: 404.php");
	}
?>
	</div>
</div>