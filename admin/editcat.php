<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location = 'catlist.php';</script>";
        //header("Location: catlist.php");
    }else{
        $catid = intval($_GET['catid']);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
       <div class="block copyblock">
    <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $catname   = $fm->validation($_POST['name']);
            $catname   = mysqli_real_escape_string($db->link, $catname);
            if (empty($catname)) {
                echo "<span class='error'>Field must not be empty!!</span>";
            }else{
                $query      = "UPDATE category SET name = '$catname' WHERE id =$catid";
                $catUpdate  = $db->updateData($query);
                if ($catUpdate) {
                    echo "<span class='success'>Category Updated successfully!!</span>";
                }
            }
        }
    ?>
    <?php
        $query = "SELECT * FROM category WHERE id = $catid";
        $cat   = $db->selectData($query);
        if($cat){
            $cat = mysqli_fetch_array($cat);
        }
    ?>

            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="name" value="<?php echo $cat['name']?>" class="medium"/>
                        </td>
                    </tr>
    				<tr> 
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
    include 'inc/footer.php';
?>
