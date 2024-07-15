<?php
@include 'config.php';

if(isset($_POST['update_update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE cart SET status = '$update_value' WHERE id = '$update_id'");
    if($update_quantity_query){
        header('location:cart.php');
    };
};
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM cart WHERE id = '$remove_id'");
    header('location:cart.php');
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <?php include 'header.php';?>
    <div class="container">
        <section class="shopping-cart">
            <h1 class="heading">Shopping Cart</h1>
            <table>
                <thead>
                    <th>Image</th>
                    <th>User id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <?php
                    $select_cart = mysqli_query($conn, "SELECT * FROM cart");
                    $grand_total= 0;
                    if(mysqli_num_rows($select_cart) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    ?>

                    <tr>
                        <td> <img src="uploaded_img/<?php echo $fetch_cart['image'];?>" height="100" alt=""> </td>
                        <td><?php echo $fetch_cart['name'];?></td>
                        <td><?php echo $fetch_cart['user_id'];?></td>
                        <td><?php echo number_format($fetch_cart['price']);?>/-</td>
                        <td><?php echo $fetch_cart['quantity'];?></td>
                        <td>Ksh<?php echo number_format($fetch_cart['total']);?>/-</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id'];?>">
                                <input type="radio" id="paid" name="update_quantity" value="paid">
                                <label for="paid">Paid</label><br>
                                <input type="radio" id="unpaid" name="update_quantity" value="unpaid">
                                <label for="unpaid">Unpaid</label><br>
                                <input type="submit" value="Update" name="update_update_btn">
                            </form>
                        </td>
                        <td> <a href="cart.php?remove=<?php echo $fetch_cart['id'];?>"onclick="return confirm('Are you sure you want to remove the item from the cart ?')" class="delete-btn"> <i class="fas fa-trash"></i>Remove </a> </td>
                    </tr>

                    <?php
                            };
                        };
                    ?>
                    
                </tbody>
            </table>

        </section>
    </div>

    <script src="javascript/script.js"></script>
</body>
</html>