<?php include('partials/menu.php') ?>
<div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            </br>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                    </tr>

                    <tr>
                        <td>UserName:</td>
                        <td><input type="text" name="username" placeholder="Enter UserName"></td>
                    </tr>

                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="Enter Password"></td>
                    </tr>

                    <tr>
                        <td><input type="submit" name="submit" class="btn-secondary"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include('partials/footer.php') ?>
<?php
    if(isset($_POST['submit']))
    {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'"; // Loại bỏ dấu phẩy ở cuối câu

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if($res==true)
        {
            $_SESSION['add'] = "Admin Added Successfully";
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else 
        {
            $_SESSION['add'] = "Failed to Add Admin";
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }
?>
