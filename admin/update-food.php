<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Update Food</h1>
    <br><br>
    <?php  
    $id= $_GET['id'];

    $sql= "SELECT * FROM tbl_food WHERE id=$id";

    $res= mysqli_query($conn, $sql);

    if($res==true)
    {
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $row= mysqli_fetch_assoc($res);

            $title= $row['title'];
            $price= $row['price'];
            $description= $row['description'];
            $current_category= $row['category_id'];
            $current_image= $row['image_name'];
            $featured= $row['featured'];
            $active= $row['active'];
        }
        else
        {
            $_SESSION['no-category-found'] = "<div class='delete'>Food not Found</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" placeholder="Title" value= "<?php echo $title ?>"></td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" cols="30" rows="10" placeholder="Description of the Food"><?php echo $description ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td><input type="number" name="price" placeholder="Price" value= "<?php echo $price ?>"></td>
            </tr>


            <tr>
                <td>Current Image:</td>
                <td>
                    <?php
                        if($current_image != "")
                        {
                            ?> 
                            <img src="<?php echo SITEURL;?>/images/<?php echo $current_image ?>" alt="" width="150px">
                            <?php
                        }
                        else
                        {
                            echo "<div class='delete'>Image not Added</div>";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image" id="">
                </td>
            </tr>

            <tr>
                <td>Category:</td>
                <td>
                    <select name="category">
                        <?php
                        // Truy vấn lấy các category từ cơ sở dữ liệu
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                        $res = mysqli_query($conn, $sql);

                        // Kiểm tra nếu có categories
                        if($res==true)
                        {
                            $count = mysqli_num_rows($res);
                            if($count>0)
                            {
                                // Category có sẵn
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $category_id; ?>"><?php echo $title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                // Không có category sẵn
                                ?>
                                <option value="0">No Category Found</option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr> 
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured"  value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured"  value="No">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active"  value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active"  value="No">No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                </td>
            </tr>
        </table>
    </form>
    </div>
</div>

<?php 
    if(isset($_POST['submit']))
    {
        $id= $_POST['id'];
        $title= $_POST['title'];
        $price= $_POST['price'];
        $description= $_POST['description'];
        $current_image=$_POST['current_image'];
        $category=$_POST['category'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];

        if(isset($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];
            if($image_name !="")
            {
                $ext = end(explode('.',$image_name));
    
                $image_name = "Food_".rand(000,999).'.'.$ext;
    
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/".$image_name;
    
                $upload = move_uploaded_file($source_path, $destination_path);
    
                if($upload==false)
                {
                    $_SESSION['upload'] = "<div class= 'error'>Failed to Upload Image.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                    die();
                }

                if($current_image!="")
                {
                    $remove_path = "../images/".$current_image;
                    $remove = unlink($remove_path);
    
                    if($remove==false)
                    {
                        $_SESSION['failed-remove'] = "<div class= 'error'>Failed to Remove current Image.</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        die();
                    }
                }

                
            }
            else{
                $image_name = $current_image;
            }
        }
        else{
            $image_name = $current_image;
        }


        $sql = "UPDATE tbl_food SET
        title = '$title',
        description = '$description',
        price = '$price',
        image_name = '$image_name',
        category_id = '$category',
        featured = '$featured',
        active = '$active'
        WHERE id = '$id'
        ";

       echo $sql;

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['update'] = "<div class='success'>Food update successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='delete'>Food update Failed</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
?>

<?php include('partials/footer.php') ?>
