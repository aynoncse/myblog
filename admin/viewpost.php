<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['viewid']) && $_GET['viewid'] == NULL) {
        echo "<script>window.location = 'postlist.php';</script>";
    }else{
        $postid = $_GET['viewid'];
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Post</h2>
       <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<script>window.location = 'postlist.php';</script>";
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
                                <input type="text" readonly="readonly" value="<?php echo $post['title'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                        <?php 
                            $query = "SELECT * FROM category";
                            $category = $db->selectData($query);
                            if ($category) {
                                $cat = mysqli_fetch_array($category);                                
                        ?>
                                    <option
                                <?php
                                    if ($post['cat'] == $cat['id']) {?>
                                        selected="selected" 
                                 <?php  } ?> value="<?php echo $cat['id'];?>"><?php echo $cat['name'];?></option>
                        <?php }?>
                                </select>
                            </td>
                        </tr>
                   
                        <tr>
                            <td>
                                <label>Post Image</label>
                            </td>

                            <td>
                                <img src="<?php echo $post['image'];?>" height='100' width='200'/></br>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea readonly class="tinymce">
                                    <?php echo $post['body'];?>
                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input readonly="readonly" type="text" value="<?php echo $post['tags'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $post['author'];?>" class="medium" />
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