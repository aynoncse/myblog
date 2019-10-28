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
           $to      = $fm->validation($_POST['toemail']);
           $from    = $fm->validation($_POST['fromemail']);
           $subject = $fm->validation($_POST['subject']);
           $message = $fm->validation($_POST['body']);
           $headers = "From: $from\n";
           $headers.= "MIME-Version: 1.0" . "\r\n";
           $headers.= "Content-type:text/html;charset=UTF-8" . "\r\n";
           $sendmail= mail($to, $subject, $message, $from);

           if ($sendmail) {
               echo "<span class='success'>Message Sent Successfully!!</span>";
           }else {
               echo "<span class='Error'>Message Not Sent. Somthing Went Wrong!!</span>";
           }
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
                }
                ?>
                <tr>
                    <td>
                        <label>To</label>
                    </td>
                    <td>
                        <input type="text" readonly name="toemail" value="<?php echo $msg['email'];?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>From</label>
                    </td>
                    <td>
                        <input type="text" name="fromemail" value="" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Subject</label>
                    </td>
                    <td>
                        <input type="text" name="subject" value="" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Message</label>
                    </td>
                    <td>
                        <textarea rows="10" cols="50" name="body"></textarea>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Send" />
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