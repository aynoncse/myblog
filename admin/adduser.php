
<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    if (Session::get('userRole')== !'0') {
        echo "<script>window.location = 'userlist.php';</script>";
    }
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock">
            <?php 
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    
                    $username   = $fm->validation($_POST['username']);
                    $email   = $fm->validation($_POST['email']);
                    $password   = $fm->validation($_POST['password']);
                    $role       = $fm->validation($_POST['role']);

                    $username   = mysqli_real_escape_string($db->link, $username);
                    $email   = mysqli_real_escape_string($db->link, $email);
                    $password   = mysqli_real_escape_string($db->link, $password);
                    $role       = mysqli_real_escape_string($db->link, $role);
                   
                    $password   = md5($password);

                    $query      = "SELECT * FROM user WHERE username ='$username' LIMIT 1";
                    $usernameCheck     = $db->selectData($query);

                    $query2      = "SELECT * FROM user WHERE email ='$email' LIMIT 1";
                    $emailCheck     = $db->selectData($query2);

                    if ($usernameCheck != false) {
                        echo "<span class='error'>This username has already been taken.</span>";
                    }elseif ($emailCheck != false) {
                        echo "<span class='error'>This email has already been taken.</span>";
                    }else{
                        $query = "INSERT INTO user(username, email, password, role) VALUES('$username', '$email', '$password', '$role')";
                        $catInsert = $db->createData($query);
                        if ($catInsert) {
                            echo "<span class='success'>User Added Successfully!!</span>";
                        }else{
                             echo "<span class='error'>Failed to Add User!!</span>";
                        }
                    }
                }
            ?>
                 <form action="adduser.php" method="post" >
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter username" class="medium" required="required"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" name="email" placeholder="Enter Email" class="medium" required="required"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="password" name="password" placeholder="Enter Password" class="medium" required="required"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>User Role</label>
                            </td>
                            <td>
                                <select id="select" name="role" required="required">
                                    <option selected disabled value>Set User Role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Author</option>
                                    <option value="2">Editor</option>
                                </select>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Add" />
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
