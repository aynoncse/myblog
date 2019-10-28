<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="15%">Post Title</th>
							<th width="15%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Date</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
				<?php
					$query 	= "SELECT post.*, category.name AS catname FROM post INNER JOIN category ON post.cat = category.id ORDER BY id DESC";
					$posts 	= $db->selectData($query);
					if ($posts) {
						$i=0;
						while ($post = $posts->fetch_assoc()) {
							$i++;
				?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $post['title']; ?></td>
							<td><?php echo $fm->textShorten($post['body'],30); ?></td>
							<td><?php echo $post['catname']; ?></td>
							<td><img src="<?php echo $post['image']?>" height=50 width=50/></td>
							<td><?php echo $post['author']; ?></td>
							<td><?php echo $post['tags']; ?></td>
							<td><?php echo $fm->formatDate($post['date']); ?></td>
							<td><a href="viewpost.php?viewid=<?php echo $post['id']; ?>">View</a>  
			<?php if (Session::get('userRole')== '0' || Session::get('userID') == $post['userid']) { ?>

								|| <a href="editpost.php?editid=<?php echo $post['id']; ?>">Edit</a> || 
								<a onclick="return confirm('Are you sure to delete?')" href="deletepost.php?delid=<?php echo $post['id']; ?>">Delete</a>
			<?php }?>
							</td>
						</tr>
				<?php } }?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
<?php include 'inc/footer.php';?>
