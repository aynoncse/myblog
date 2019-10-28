<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>

<?php
    if (isset($_GET['delid'])) {
        $delid = $_GET['delid'];

        $del_query 	= "DELETE FROM contact WHERE id = '$delid'";
        $deleted 	= $db->deleteData($del_query);

        if ($deleted) { ?>
        	<script>alert('Data Deleted Successfully..');</script>
	<?php }else{?>
			<script>alert('Data Not Deleted Successfully..');</script>
<?php } 
    }
?>

        <?php
        	if (isset($_GET['seenid'])) {
        		$sid = $_GET['seenid'];
        		$query      = "UPDATE contact SET status = '1' WHERE id =$sid";
                $statUpdate  = $db->updateData($query);
                if ($statUpdate) {
                    echo "<span class='success'>This message has moved to Seen Messages list...</span>";
                }else{
                    echo "<span class='success'>Something Went Wrong!!</span>";               
                }
        	}
        ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
			<?php
				$query 		= "SELECT * FROM contact WHERE status = '0' ORDER BY id DESC";
				$contact 	= $db->selectData($query);
				if ($contact) {
					$i= 0;
					while ($message = $contact->fetch_assoc()) {
						$i++;
					$name = $message['fname']." ".$message['lname'];
							
			?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $name;?></td>
							<td><?php echo $message['email'];?></td>
							<td><?php echo $fm->textShorten($message['body'],50);?></td>
							<td><?php echo $fm->formatDate($message['date']);?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $message['id'];?>">View</a> |
								<a href="replymsg.php?msgid=<?php echo $message['id'];?>">Reply</a> |
								<a href="?seenid=<?php echo $message['id'];?>">Seen</a>
							</td>
						</tr>
			<?php } }?>

			
					</tbody>
				</table>
               </div>
            </div>

                <div class="box round first grid">
                	<h2>Seen Messages</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
			<?php
				$query 		= "SELECT * FROM contact WHERE status = '1' ORDER BY id DESC";
				$contact 	= $db->selectData($query);
				if ($contact) {
					$i= 0;
					while ($message = $contact->fetch_assoc()) {
						$i++;
					$name = $message['fname']." ".$message['lname'];
							
			?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $name;?></td>
							<td><?php echo $message['email'];?></td>
							<td><?php echo $fm->textShorten($message['body'],50);?></td>
							<td><?php echo $fm->formatDate($message['date']);?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $message['id'];?>">View</a> |
								<a onclick="return confirm('Are you sure to delete?')" href="?delid=<?php echo $message['id'];?>">Delete</a>
							</td>
						</tr>
			<?php } }?>
					</tbody>
				</table>
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