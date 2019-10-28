<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (isset($_GET['sliderid'])) {
        $sliderid = $_GET['sliderid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Slider</h2>
       <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $link = mysqli_real_escape_string($db->link, $_POST['link']);
                $title = mysqli_real_escape_string($db->link, $_POST['title']);

                $permited   = array('jpg','jpeg', 'png', 'gif');
                $file_name  = $_FILES['image']['name'];

                $file_size  = $_FILES['image']['size'];
                $file_temp  = $_FILES['image']['tmp_name'];

                $div        = explode('.', $file_name);
                $file_ext   = strtolower(end($div));
                $uniqe_image= substr(md5(time()), 0,10).'.'.$file_ext;

                $uploaded_image     = "uploads/slider/".$uniqe_image;

                if ($title == "" || $link == "") {
                    echo "<span class='error'>Field must not be empty!!</span>";
                }
                elseif (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$link)) {
                    echo "<span class='error'>Please enter a valid link!!</span>";
                }
                elseif(!empty($file_name)) {
                    if($file_size>8388608){
                    echo "<span class='error'>Image Size Should Be Less Than 3MB</span>";
                }elseif(in_array($file_ext, $permited)===false){
                    echo "<span class='error'>You can upload ony: ".implode(', ', $permited)."</span>";
                }else{
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query      = "UPDATE slider SET 
                    link    = '$link',
                    title   = '$title',
                    image   = '$uploaded_image'
                    WHERE id = '$sliderid'";
                    $updated   = $db->updateData($query);
                    if ($updated) {
                        echo "<span class='success'>Slider Updated Successfully...</span>";
                    }else{
                        echo "<span class='error'>Failed to Update!!</span>";
                    }
                }
            }else{
                $query      = "UPDATE slider SET 
                    link    = '$link',
                    title   = '$title'
                    WHERE id = '$sliderid'";
                    $updated   = $db->updateData($query);
                    if ($updated) {
                        echo "<span class='success'>Slider Updated Successfully...</span>";
                    }else{
                        echo "<span class='error'>Failed to Update!!</span>";
                    }
            }
        }
        ?>
        <?php
                    $query  = "SELECT * FROM slider WHERE id ='$sliderid'";
                    $result  = $db->selectData($query);
                    if ($result) {
                        $i=0;
                       $slider = mysqli_fetch_array($result);
                    }
        ?>
                <div class="block">               
                 <form action="" method="Post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Link</label>
                            </td>
                            <td>
                                <input type="text" name="link" value="<?php echo $slider['link'];?>" class="medium" />
                            </td>
                        </tr>
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $slider['title'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                
                                <label></label>
                            </td>
                            <td>
                                <img src="<?php echo $slider['image'];?>" width="300" height="100" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image"/>
                            </td>
                        </tr>

						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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