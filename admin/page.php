<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

<?php
    if (isset($_GET['delid'])) {
        $pageid     = $_GET['delid'];

        $del_query  = "DELETE FROM page WHERE id = '$pageid'";
        $deleted    = $db->deleteData($del_query);

        if ($deleted) { ?>
            <script>alert('Page Deleted Successfully..');</script>
            <script>window.location = 'index.php';</script>
<?php } else { ?>
            <script>alert('Page Not Deleted Successfully..');</script>
            <script>window.location = 'index.php';</script>
<?php } } ?>

<?php
    if (!isset($_GET['pageid']) && $_GET['pageid'] == NULL) {
        echo "<script>window.location = 'postlist.php';</script>";
    }else{
        $pageid = $_GET['pageid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Page</h2>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);

            if ($name == "" || $body == "") {
                echo "<span class='error'>Field must not be empty!!</span>";
            }else{
                $query      = "UPDATE page SET 
                                        name   = '$name',
                                        body  = '$body'
                                        WHERE id = $pageid";
                $updated   = $db->updateData($query);
                if ($updated) {
                    echo "<span class='success'>Post Updated Successfully...</span>";
                }else{
                    echo "<span class='error'>Failed to Update This Post!!</span>";
                }
            }
        }
    ?>
                <div class="block">
            <?php
                $query = "SELECT * FROM page WHERE id = '$pageid'";
                $page   = $db->selectData($query);
                if($page){
                $page = mysqli_fetch_array($page);
                }

        ?>       
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $page['name'];?>" class="medium" />
                            </td>
                        </tr>
                   
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $page['body'];?>
                                </textarea>
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="delpagebtn"><a onclick="return confirm('Are you sure to delete?')" href="?delid=<?php echo $pageid;?>">Delete</a></span>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    <!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php
    include 'inc/footer.php';
?>