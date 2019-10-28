<style type="text/css">
    .left-side{
        float: left;
        width: 70%;
    }
    .right-side{
        float: left;
        width: 20%;
    }
</style>

<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock">
            <div class="left-side">            
                <form action="" method="Post" enctype="multipart/form-data">
<?php 
    $query  = "SELECT * FROM title_slogan WHERE id = 1";
    $result = $db->selectData($query);
    if ($result){
        $logo = mysqli_fetch_array($result);
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title      = $fm->validation($_POST['title']);
        $slogan     = $fm->validation($_POST['slogan']);

        $title      = mysqli_real_escape_string($db->link, $_POST['title']);
        $slogan     = mysqli_real_escape_string($db->link, $_POST['slogan']);

        $permited   = array('png');
        $file_name  = $_FILES['logo']['name'];

        $file_size  = $_FILES['logo']['size'];
        $file_temp  = $_FILES['logo']['tmp_name'];

        $div        = explode('.', $file_name);
        $file_ext   = strtolower(end($div));
        $same_image = 'logo'.'.'.$file_ext;

        $uploaded_image     = "uploads/".$same_image;

        if ($title == "" || $slogan == "") {
            echo "<span class='error'>Field must not be empty!!</span>";
        }else{

        if (!empty($file_name)) {
            if($file_size>8388608){
                echo "<span class='error'>Image Size Should Be Less Than 3MB</span>";
            }elseif(in_array($file_ext, $permited)===false){
                            echo "<span class='error'>You can upload only: ".implode(', ', $permited)."</span>";
            }else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query      = "UPDATE title_slogan SET 
                                    title = '$title',
                                    slogan  = '$slogan',
                                    logo = '$uploaded_image'
                                    WHERE id = 1";
            $updated   = $db->updateData($query);
            if ($updated) {
                echo "<span class='success'>Updated Successfully...</span>";
            }else{
                echo "<span class='error'>Failed to Update!!</span>";
            }
        }
    }else{
        $query      = "UPDATE title_slogan SET 
                        title = '$title',
                        slogan  = '$slogan'
                        WHERE id = 1";
            $updated   = $db->updateData($query);
            if ($updated) {
                echo "<span class='success'>Updated Successfully...</span>";
            }else{
                echo "<span class='error'>Failed to Update!!</span>";
            }
        }  
    }
}
?>


                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $logo['title'];?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $logo['slogan'];?>" name="slogan" class="medium" />
                            </td>
                        </tr>
						 
						<tr>
                            <td>
                                <label>Upload Logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo" />
                            </td>
                        </tr>

						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="right-side">
                <h4>Current Logo</h4>
                <img src="<?php echo $logo['logo'];?>" alt="logo" height=100 width=100/>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php';?>