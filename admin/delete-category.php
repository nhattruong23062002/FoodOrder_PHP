<?php
    include('../config/constants.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_category WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='delete'>Failed to Deleted Category. Try Again Laster</div>";
        header('location:'.SITEURL.'admin/manage-category.php'); 
    }

?>