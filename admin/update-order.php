<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Update order</h1>
    <br><br>
    <?php  
    $id= $_GET['id'];

    $sql= "SELECT * FROM tbl_order WHERE id=$id";

    $res= mysqli_query($conn, $sql);

    if($res==true)
    {
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $row= mysqli_fetch_assoc($res);

            $food= $row['food'];
            $price= $row['price'];
            $qty= $row['qty'];
            $status= $row['status'];
            $customer_name= $row['customer_name'];
            $customer_contact= $row['customer_contact'];
            $customer_email= $row['customer_email'];
            $customer_address= $row['customer_address'];
        }
        else
        {
            header('location:'.SITEURL.'admin/manage-order.php');
        }
    }
    
    ?>
    <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Food Name:</td>
                        <td><?php echo $food; ?></td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td>$<?php echo $price; ?></td>
                    </tr>

                    <tr>
                        <td>Qty:</td>
                        <td><input type="number" name="qty" placeholder="Enter Qty" value= "<?php echo $qty ?>"></td>
                    </tr>

                    <tr>
                        <td>status:</td>
                        <td>
                            <select name='status'>
                                <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                                <option <?php if($status=="On Delivery"){echo "selected";} ?>  value="On Delivery">On Delivery</option>
                                <option <?php if($status=="Delivered"){echo "selected";} ?>  value="Delivered">Delivered</option>
                                <option <?php if($status=="Cancelled"){echo "selected";} ?>  value="Cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name:</td>
                        <td><input type="text" name="customer_name" placeholder="Enter Customer Name" value= "<?php echo $customer_name ?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Contact:</td>
                        <td><input type="text" name="customer_contact" placeholder="Enter Customer Contact" value= "<?php echo $customer_contact ?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Email:</td>
                        <td><input type="text" name="customer_email" placeholder="Enter Customer Email" value= "<?php echo $customer_email ?>"></td>
                    </tr>

                    <tr>
                        <td>Customer Address:</td>
                        <td>
                            <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <td><input type="submit" name="submit" value="Update Order" class="btn-secondary"></td>
                    </tr>
                </table>
            </form>
    </div>
</div>

<?php 
    if(isset($_POST['submit']))
    {
        $id= $_POST['id'];
        $qty= $_POST['qty'];
        $status=$_POST['status'];
        $customer_name=$_POST['customer_name'];
        $customer_contact=$_POST['customer_contact'];
        $customer_email=$_POST['customer_email'];
        $customer_address=$_POST['customer_address'];

        $sql = "UPDATE tbl_order SET
        qty = $qty,
        total = $qty * $price,
        status = '$status',
        customer_name = '$customer_name',
        customer_contact = '$customer_contact',
        customer_email = '$customer_email',
        customer_address = '$customer_address'
        WHERE id = '$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['update'] = 'Order update successfully';
            header('location:'.SITEURL.'admin/manage-order.php');
        }
        else
        {
            $_SESSION['update'] = 'Order update Failed';
            header('location:'.SITEURL.'admin/manage-order.php');
        }
    }
?>

<?php include('partials/footer.php') ?>
