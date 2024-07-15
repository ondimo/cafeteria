<?php
    @include 'config.php';

    if (isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_query = mysqli_query($conn, "DELETE FROM accounts where id=$delete_id") or die('query failed');
        if($delete_query){
        $message[]= 'Account deleted successfully';
        header('location:products.php');
        }else{
        $message[]='Error!Unable to delete the account';
        header('location:products.php');
        }
    };

    if(isset($_POST['update_product'])){
        $update_p_id = $_POST['update_p_id'];
        $update_p_name = $_POST['update_p_name'];
        $update_p_address = $_POST['update_p_address'];
        $update_p_image = $_FILES['update_p_image']['name'];
        $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
        $update_p_image_folder = 'uploaded_img/'.$update_p_image;
    
        $update_query = mysqli_query($conn, "UPDATE accounts SET name = '$update_p_name', address = '$update_p_address', image = '$update_p_image' WHERE id = $update_p_id");
    
        if($update_query){
        move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        $message[] = 'Account has been edited successfully';
        header('location:products.php');
        }else{
        $message[] = 'Error!Unable to edit the account';
        header('location:products.php');
        }
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Accounts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
      .header{
         background-color:#006400;
      }
      .btn{
         background-color:#006400;
      }
   </style>
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

    <div class="container">
        <section class="display-product-table">
            <table>
                <thead>
                    <th>Cafeteria image</th>
                    <th>Cafeteria name</th>
                    <th>Cafeteria address</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM accounts");
                    if(mysqli_num_rows($select_products)>0){
                        while($row = mysqli_fetch_assoc($select_products)){
                    ?>

                    <tr>
                    <td> <img src="uploaded_img/<?php echo $row['image']; ?>"height="50" alt=""> </td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['passwords']; ?></td>
                    <td>
                        <a href="products.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete the account?');"> <i class="fas fa-trash"></i> Delete </a> 
                        <a href="products.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i>Edit</a>
                    </td>

                    </tr>
                    
                    <?php
                        };
                    }else{
                        echo "<div class='empty'>No Accounts Have Been Added</div>";
                    }

                    ?>
                </tbody>
            </table>
        </section>

    <section class="edit-form-container">
        <?php
        if (isset($_GET['edit'])){
            $edit_id = $_GET['edit'];
            $edit_query = mysqli_query($conn, "SELECT * FROM accounts WHERE id = $edit_id");
            if(mysqli_num_rows($edit_query) > 0){
                while($fetch_edit = mysqli_fetch_assoc($edit_query)){
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
            <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
            <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
            <input type="text" class="box" required name="update_p_address" value="<?php echo $fetch_edit['address']; ?>">
            <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
            <input type="submit" value="Update the account" name="update_product" class="btn">
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