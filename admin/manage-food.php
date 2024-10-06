<?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['unauthorize']))
                {
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }
            ?>
            <br></br>
            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
            </br>
            </br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM tbl_food";

                    $res = mysqli_query($conn, $sql);

                    if($res==TRUE)
                    {
                        $count = mysqli_num_rows($res);

                        $sn=1;

                        if($count>0){
                            while($rows=mysqli_fetch_assoc($res)){
                            $id = $rows['id']; 
                            $title = $rows['title'];
                            $description = $rows['description'];
                            $image_name = $rows['image_name'];
                            $category_id = $rows['category_id'];
                            $featured = $rows['featured']; 
                            $active = $rows['active']; 
                            ?>
                              <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?> </td>
                                <td><?php echo $description; ?> </td>
                                <td>
                                    <?php 
                                    if($image_name!="")
                                    {
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/<?php echo $image_name ?>" style="width: 120px;">
                                        <?php
                                    }
                                    else{
                                        echo "<div class='delete'>Image not Added</div>";
                                    }
                                    ?> 
                                </td>
                                <td><?php echo $category_id; ?></td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                </td>
                            </tr>
                            <?php
                            }
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan="6">
                                    <div class="error">No Food Added.</div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>
<?php include('partials/footer.php'); ?>
