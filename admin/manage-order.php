<?php include('partials/menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Order</h1>
            </br>
            <?php
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            </br>
            </br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order date</th>
                    <th>Status</th>
                    <th>Customer name</th>
                    <th>Customer contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>

                <?php
                    $sql = "SELECT * FROM tbl_order";

                    $res = mysqli_query($conn, $sql);

                    if($res==TRUE)
                    {
                        $count = mysqli_num_rows($res);

                        if($count>0){
                            while($rows=mysqli_fetch_assoc($res)){
                            $id = $rows['id']; 
                            $food = $rows['food'];
                            $price = $rows['price']; 
                            $qty = $rows['qty']; 
                            $total = $rows['total']; 
                            $order_date = $rows['order_date']; 
                            $status = $rows['status']; 
                            $customer_name = $rows['customer_name']; 
                            $customer_contact = $rows['customer_contact']; 
                            $customer_email = $rows['customer_email']; 
                            $customer_address = $rows['customer_address']; 
                            ?>
                              <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $food; ?> </td>
                                <td><?php echo $price; ?> </td>
                                <td><?php echo $qty; ?></td>
                                <td>$<?php echo $total; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td><?php echo $status; ?></td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id; ?>" class="btn-danger">Delete Order</a>
                                </td>
                            </tr>
                            <?php
                            }
                        }
                        else
                        {

                        }
                    }
                ?>
            </table> 
        </div>
    </div>
<?php include('partials/footer.php'); ?>
