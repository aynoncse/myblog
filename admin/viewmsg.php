<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

<?php
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
        echo "<script>window.location = 'inbox.php';</script>";
    }else{
        $msgid = $_GET['msgid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message</h2>
       <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<script>window.location = 'inbox.php';</script>";
            }
        ?>
                <div class="block">               
                 <form action="" method="Post">
                    <table class="form">
    <?php
        $query = "SELECT * FROM contact WHERE id = $msgid";
        $msg   = $db->selectData($query);
        if($msg){
            $msg = mysqli_fetch_array($msg);
            $name = $msg['fname']." ".$msg['lname'];
        }
    ?>
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly name="name" value="<?php echo $name?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly name="email" value="<?php echo $msg['email'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" readonly name="date" value="<?php echo $fm->formatDate($msg['date']);?>" class="medium" />
                            </td>
                        </tr>
                     
                        
                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea cols="66" readonly><?php echo $msg['body'];?></textarea>
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
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