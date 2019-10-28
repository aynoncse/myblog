<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $del_query   = "DELETE FROM slider WHERE id = '$id'";
    $deleted    = $db->deleteData($del_query);

    if ($deleted) { ?>
        <script>alert('Data Deleted Successfully..');</script>
<?php    }
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Slider List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th width="25%">Slider Title</th>                       
                            <th width="20%">Image</th>
                            <th width="20%">Link</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    $query  = "SELECT * FROM slider ORDER BY id ASC";
                    $result  = $db->selectData($query);
                    if ($result) {
                        $i=0;
                        while ($slider = $result->fetch_assoc()) {
                            $i++;
                ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $fm->textShorten($slider['title'],30); ?></td>
                            <td><img src="<?php echo $slider['image']?>" height=80 width=250/></td>
                            <td><?php echo $fm->textShorten($slider['link'],30); ?></td>
                            <td>  
            <?php if (Session::get('userRole')== '0'){ ?>
                                <a href="editslider.php?sliderid=<?php echo $slider['id']; ?>">Edit</a> || 
                                <a onclick="return confirm('Are you sure to delete?')" href="?delid=<?php echo $slider['id']; ?>">Delete</a>
            <?php }?>
                            </td>
                        </tr>
                <?php } }?>
                    </tbody>
                </table>
    
               </div>
            </div>
        </div>
    <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
            setSidebarHeight();
        });
    </script>
<?php include 'inc/footer.php';?>
