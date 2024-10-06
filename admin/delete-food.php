<?php
    include('../config/constants.php');

    // Kiểm tra xem có nhận được id và image_name hay không
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        echo $image_name;

        // Kiểm tra nếu image_name không rỗng thì xóa file ảnh
        if($image_name != "")
        {
            $path = "../images/".$image_name;

            $remove = unlink($path);

            // Nếu không thể xóa ảnh, đặt thông báo lỗi và dừng lại
            if($remove==false)
            {
                $_SESSION['upload'] = "<div class='delete'>Failed to Remove Image File</div>";
                header('location:'.SITEURL.'admin/manage-food.php'); 
                die();
            }
        }

        // Thực hiện xóa dữ liệu trong bảng tbl_food
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        // Kiểm tra nếu xóa thành công
        if($res==true)
        {
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='delete'>Failed to Delete Food. Try Again Later</div>";
            header('location:'.SITEURL.'admin/manage-food.php'); 
        }
    }
    else
    {
        // Nếu không có id và image_name, thông báo Unauthorized Access
        $_SESSION['unauthorize'] = "<div class='delete'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php'); 
    }
?>
