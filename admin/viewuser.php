<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['userid']) || $_GET['userid']==NULL){
        echo "<script>window.location = 'userlist.php';</script>";
    }else{
        $userid = $_GET['userid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>User Details</h2>
       <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<script>window.location = 'userlist.php';</script>";
        }
        ?>
        <?php
                $query = "SELECT * FROM user WHERE id = '$userid'";
                $getuser   = $db->selectData($query);
                if($getuser){
                $user = mysqli_fetch_array($getuser);
                }


        ?>     
                <div class="block">
                 <form action="" method="Post">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $user['name'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $user['username'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email"  value="<?php echo $user['email'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea readonly="readonly" class="tinymce" name="details">
                                    <?php echo $user['details'];?>
                                </textarea>
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