<?php
    @include 'config.php';

    if (isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_query = mysqli_query($conn, "DELETE FROM products_upesi where id=$delete_id") or die('query failed');
        if($delete_query){
        $message[]= 'Item deleted successfully';
        header('location:products.php');
        }else{
        $message[]='Error!Unable to delete the item';
        header('location:products.php');
        }
    };

    if(isset($_POST['update_product'])){
        $update_p_id = $_POST['update_p_id'];
        $update_p_name = $_POST['update_p_name'];
        $update_p_price = $_POST['update_p_price'];
        $update_p_image = $_FILES['update_p_image']['name'];
        $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
        $update_p_image_folder = 'uploaded_img/'.$update_p_image;
    
        $update_query = mysqli_query($conn, "UPDATE products_upesi SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = $update_p_id");
    
        if($update_query){
        move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        $message[] = 'Item has been updated successfully';
        header('location:products.php');
        }else{
        $message[] = 'Error!Unable to Update the item';
        header('location:products.php');
        }
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    if(isset($message)){
        foreach($message as $message){
            echo '<div class="message"><span>' .$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        };
    };
    ?>
    <?php include 'header.php'; ?>

    <div class="containeer">
        <section class="display-product-table">
            <table>
                <thead>
                    <th>Item image</th>
                    <th>Item name</th>
                    <th>Item price</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM products_upesi");
                    if(mysqli_num_rows($select_products)>0){
                        while($row = mysqli_fetch_assoc($select_products)){
                    ?>

                    <tr>
                    <td> <img src="uploaded_img/<?php echo $row['image']; ?>"height="100" alt=""> </td>
                    <td><?php echo $row['name']; ?></td>
                    <td>Ksh <?php echo $row['price']; ?>/-</td>
                    <td>
                        <a href="products.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete?');"> <i class="fas fa-trash"></i> Delete </a> 
                        <a href="products.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i>Edit</a>
                    </td>

                    </tr>
                    
                    <?php
                        };
                    }else{
                        echo "<div class='empty'>No Item Added</div>";
                    }

                    ?>
                </tbody>
            </table>
        </section>

    <section class="edit-form-container">
        <?php
        if (isset($_GET['edit'])){
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM products_upesi WHERE id = $edit_id");
            if(mysqli_num_rows($edit_query) > 0){
                while($fetch_edit = mysqli_fetch_assoc($edit_query)){
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
            <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
            <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
            <input type="number" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
            <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
            <input type="submit" value="Update the item" name="update_product" class="btn">
            <input type="reset" value= "Cancel edit" id="close-edit" class="option-btn">
        </form>
        <?php
                };
            };
            echo "<script>document.querySelector('.edit-form-container').style.display = 'flex'</script>";
        }
        ?>
        </section>
    </div>

    <script src="javascript/script.js"></script>
</body>
</html>