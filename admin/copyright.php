  <?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <div class="block copyblock"> 

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $note     = $fm->validation($_POST['note']);
        $devtext     = $fm->validation($_POST['devtext']);

        $note     = mysqli_real_escape_string($db->link, $_POST['note']);
        $devtext     = mysqli_real_escape_string($db->link, $_POST['devtext']);

        if ($note == "" || $devtext == "") {
            echo "<span class='error'>Field must not be empty!!</span>";
        }

        $query      = "UPDATE footer SET 
                                note = '$note',
                                devtext = '$devtext'
                                WHERE id = 1";
        $updated   = $db->updateData($query);
        if ($updated) {
            echo "<span class='success'>Updated Successfully...</span>";
        }else{
            echo "<span class='error'>Failed to Update!!</span>";
        }
    }
?> 

            <?php
                $query = "SELECT * FROM footer WHERE id = 1";
                $result = $db->selectData($query);
                if ($result){
                    $foot = mysqli_fetch_array($result);
                }
            ?>


                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                 <label>Copyright Text</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $foot['note'];?>" name="note" class="large" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                 <label>Developer Note</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $foot['devtext'];?>" name="devtext" class="large" />
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
<?php
    include 'inc/footer.php';
?>