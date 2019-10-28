<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
    <?php
		if (isset($_GET['delid'])) {
			$delid = $_GET['delid'];
			$query = "DELETE FROM category WHERE id = $delid";
			$delte = $db->deleteData($query);
			if ($delte) {
				echo "<span class='success'>Category deleted successfully!!</span>";
			}else{
				echo "<span class='error'>Failed to delete this catagory!!</span>";
			}
		}
	?>    
                <div class="block">    
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$query 		= "SELECT * FROM category ORDER BY id DESC";
						$category 	= $db->selectData($query);
						if ($category) {
							$i= 0;
							while ($cat = $category->fetch_assoc()) {
								$i++;
							
					?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $cat['name'];?></td>
							<td><a href="editcat.php?catid=<?php echo $cat['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure you want to delete this category?')" href="?delid=<?php echo $cat['id'];?>">Delete</a></td>
						</tr>
				<?php 
						}
					}
				?>
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
<?php
    include 'inc/footer.php';
?>