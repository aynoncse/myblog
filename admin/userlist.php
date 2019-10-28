<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
    <?php
		if (isset($_GET['deluser'])) {
			$deluser = $_GET['deluser'];
			$query = "DELETE FROM user WHERE id = $deluser";
			$delte = $db->deleteData($query);
			if ($delte) {
				echo "<span class='success'>User deleted successfully!!</span>";
			}else{
				echo "<span class='error'>Failed to delete this User!!</span>";
			}
		}
	?>    
                <div class="block">    
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Username</th>
							<th>Email</th>
							<th>Details</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$query 		= "SELECT * FROM user ORDER BY id ASC";
						$userData 	= $db->selectData($query);
						if ($userData) {
							$i= 0;
							while ($user = $userData->fetch_assoc()) {
								if ($user['role'] == 0) {
									$role = 'Admin';
								}
								elseif ($user['role'] == 1) {
									$role = 'Author';
								}else{
									$role = 'Editor';
								}
								$i++;
							
					?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $user['name'];?></td>
							<td><?php echo $user['username'];?></td>
							<td><?php echo $user['email'];?></td>
							<td><?php echo $fm->textShorten($user['details'],20);?></td>
							<td><?php echo $role;?></td>
							<td><a href="viewuser.php?userid=<?php echo $user['id'];?>">View</a> 
				<?php if (Session::get('userRole')== '0') {?>
								|| <a onclick="return confirm('Are you sure you want to delete this user?')" href="?deluser=<?php echo $user['id'];?>">Delete</a>
				<?php }?>
							</td>
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