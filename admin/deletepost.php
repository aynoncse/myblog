<?php
    include '../lib/Session.php';
    Session::checkSession();
?>
<?php
    include '../config/config.php';
    include '../lib/DB.php';
    include '../helpers/Format.php';

    $db = new DB();
?>

<?php
    if (!isset($_GET['delid']) && $_GET['delid'] == NULL) {
        echo "<script>window.location = 'postlist.php';</script>";
    }else{
        $postid = $_GET['delid'];

        $query = "SELECT * FROM post WHERE id = '$postid'";
        $data = $db->selectData($query);

        if ($data) {
        	$post = mysqli_fetch_array($data);
        	$del_image = $post['image'];
        	unlink($del_image);
        }

        $del_query 	= "DELETE FROM POST WHERE id = '$postid'";
        $deleted 	= $db->deleteData($del_query);

        if ($deleted) { ?>
        	<script>alert('Data Deleted Successfully..');</script>
        	<script>window.location = 'postlist.php';</script>
	<?php }else{?>
			<script>alert('Data Not Deleted Successfully..');</script>
        	<script>window.location = 'postlist.php';</script>
<?php } 
    }
?>

