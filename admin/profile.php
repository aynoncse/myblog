<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    
    $userID = Session::get('userID');
    $userRole = Session::get('userRole');
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
       <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = mysqli_real_escape_string($db->link, $_POST['name']);
                $username = mysqli_real_escape_string($db->link, $_POST['username']);
                $email = mysqli_real_escape_string($db->link, $_POST['email']);
                $details = mysqli_real_escape_string($db->link, $_POST['details']);

                $query      = "SELECT * FROM user WHERE username ='$username' LIMIT 1";
                $usernameCheck     = $db->selectData($query);

                $query2      = "SELECT * FROM user WHERE email ='$email' LIMIT 1";
                $emailCheck     = $db->selectData($query2);

                if ($usernameCheck != false && $emailCheck != false) {
                    $query          = "UPDATE user SET 
                        name        = '$name',
                        details     = '$details'
                        WHERE id    = $userID";
                    $updated   = $db->updateData($query);
                    if ($updated) {
                        echo "<span class='success'>Updated Successfully...</span>";
                        echo "<span class='error'>But couldn't update username and email. Because this username and this email have already been taken.</span>";
                    }
                }

                elseif ($usernameCheck != false) {
                    $query          = "UPDATE user SET 
                        name        = '$name',
                        email       = '$email',
                        details     = '$details'
                        WHERE id    = $userID";
                    $updated   = $db->updateData($query);
                    if ($updated) {
                        echo "<span class='success'>Updated Successfully...</span>";
                        echo "<span class='error'>But couldn't update username. Because this username has already been taken.</span>";
                    }
                }elseif ($emailCheck != false) {
                    $query          = "UPDATE user SET
                        username    = '$username',
                        name        = '$name',
                        details     = '$details'
                        WHERE id    = $userID";
                    $updated   = $db->updateData($query);
                    if ($updated) {
                        echo "<span class='success'>Updated Successfully...</span>";
                        echo "<span class='error'>But couldn't update email. Because this email has already been taken.</span>";
                    }
                }else{
                    $query          = "UPDATE user SET
                        username    = '$username',
                        name        = '$name',
                        email       = '$email',
                        details     = '$details'
                        WHERE id    = $userID";
                    $updated   = $db->updateData($query);
                    if ($updated) {
                        echo "<span class='success'>Updated Successfully...</span>";
                    }else{
                        echo "<span class='error'>Failed to Update!!</span>";
                    }
                }
            }
        ?>
        <?php
                $query = "SELECT * FROM user WHERE id = '$userID' AND role = '$userRole'";
                $getuser   = $db->selectData($query);
                if($getuser){
                $user = mysqli_fetch_array($getuser);
                }


        ?>     
                <div class="block">
                 <form action="" method="Post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $user['name'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $user['username'];?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" name="email" value="<?php echo $user['email'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="details">
                                    <?php echo $user['details'];?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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