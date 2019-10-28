<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                <div class="block">
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fb     = $fm->validation($_POST['fb']);
        $tw     = $fm->validation($_POST['tw']);
        $ln     = $fm->validation($_POST['ln']);
        $gp     = $fm->validation($_POST['gp']);

        $fb     = mysqli_real_escape_string($db->link, $_POST['fb']);
        $tw     = mysqli_real_escape_string($db->link, $_POST['tw']);
        $ln     = mysqli_real_escape_string($db->link, $_POST['ln']);
        $gp     = mysqli_real_escape_string($db->link, $_POST['gp']);

        if ($fb == "" || $tw == "" || $ln == "" || $gp == "") {
            echo "<span class='error'>Field must not be empty!!</span>";
        }

        $query      = "UPDATE social SET 
                                fb = '$fb',
                                tw = '$tw',
                                ln = '$ln',
                                gp = '$gp'
                                WHERE id = 1";
        $updated   = $db->updateData($query);
        if ($updated) {
            echo "<span class='success'>Updated Successfully...</span>";
        }else{
            echo "<span class='error'>Failed to Update!!</span>";
        }
    }
?>              
                 <form action="" method="post">
                    <table class="form">
                <?php
                    $query  = "SELECT * FROM social WHERE id = 1";
                    $result = $db->selectData($query);
                    if ($result){
                        $social = mysqli_fetch_array($result);
                    }
                ?>					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="fb" value="<?php echo $social['fb'];?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="tw" value="<?php echo $social['tw'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="ln" value="<?php echo $social['ln'];?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="gp" value="<?php echo $social['gp'];?>" class="medium" />
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
<?php include 'inc/footer.php';?>
