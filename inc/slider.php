<div class="slidersection template clear">
	<div id="slider">
	<?php
		$query 	= "SELECT * FROM slider ORDER BY id ASC";
		$result = $db->selectData($query);
		if ($result) {
		 	while ($slider = $result->fetch_assoc()) {
		 	
	?>
		<a href="<?php echo $slider['link'];?>"><img src="admin/<?php echo $slider['image'];?>" alt="nature 1" title="<?php echo $slider['title'];?>"/></a>
<?php }}?>
	</div>
</div>