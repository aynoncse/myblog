<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['editid']) && $_GET['editid'] == NULL) {
        echo "<script>window.location = 'postlist.php';</script>";
    }else{
        $postid = $_GET['editid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
       <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
                $title = mysqli_real_escape_string($db->link, $_POST['title']);
                $body = mysqli_real_escape_string($db->link, $_POST['body']);
                $author = mysqli_real_escape_string($db->link, $_POST['author']);
                $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
                $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

                $permited   = array('jpg','jpeg', 'png', 'gif');
                $file_name  = $_FILES['image']['name'];

                $file_size  = $_FILES['image']['size'];
                $file_temp  = $_FILES['image']['tmp_name'];

                $div        = explode('.', $file_name);
                $file_ext   = strtolower(end($div));
                $uniqe_image= substr(md5(time()), 0,10).'.'.$file_ext;

                $uploaded_image     = "uploads/".$uniqe_image;

                if ($cat == "" || $title == "" || $body == "" || $author == "" || $tags == "") {
                    echo "<span class='error'>Field must not be empty!!</span>";
                }else{

                if (!empty($file_name)) {
                    if($file_size>8388608){
                        echo "<span class='error'>Image Size Should Be Less Than 3MB</span>";
                    }elseif(in_array($file_ext, $permited)===false){
                                    echo "<span class='error'>You can upload only: ".implode(', ', $permited)."</span>";
                    }else{
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query      = "UPDATE post SET 
                                            cat   = '$cat',
                                            title = '$title',
                                            body  = '$body',
                                            image = '$uploaded_image',
                                            author= '$author',
                                            tags  = '$tags',
                                            userid = '$userid'
                                            WHERE id = $postid";
                    $updated   = $db->updateData($query);
                    if ($updated) {
                        echo "<span class='success'>Post Updated Successfully...</span>";
                    }else{
                        echo "<span class='error'>Failed to Update This Post!!</span>";
                    }
                }
            }else{
                $query      = "UPDATE post SET 
                                cat   = '$cat',
                                title = '$title',
                                body  = '$body',
                                author= '$author',
                                tags  = '$tags'
                                WHERE id = $postid";
                    $updated   = $db->updateData($query);
                    if ($updated) {
                        echo "<span class='success'>Post Updated Successfully...</span>";
                    }else{
                        echo "<span class='error'>Failed to Update This Post!!</span>";
                    }
                }  
            }
        }
        ?>
                <div class="block">
            <?php
                $query = "SELECT * FROM post WHERE id = '$postid'";
                $post   = $db->selectData($query);
                if($post){
                $post = mysqli_fetch_array($post);
                }

        ?>       
                 <form action="" method="Post" enctype="multipart/form-data">
                    <table class="form">
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $post['title'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                <option>Select Catagory</option>
                        <?php 
                            $query = "SELECT * FROM category";
                            $category = $db->selectData($query);
                            if ($category) {
                                while ($cat = $category->fetch_assoc()) {
                                
                        ?>
                                    <option
                                <?php
                                    if ($post['cat'] == $cat['id']) {?>
                                        selected="selected" 
                                 <?php  } ?> value="<?php echo $cat['id'];?>"><?php echo $cat['name'];?></option>
                        <?php } }?>
                                </select>
                            </td>
                        </tr>
                   
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>

                            <td>
                                <img src="<?php echo $post['image'];?>" height='80' width='200'/></br>
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $post['body'];?>
                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $post['tags'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $post['author'];?>" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo Session::get('userID');?>" class="medium" />
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