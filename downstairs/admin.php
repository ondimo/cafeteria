<?php
@include 'config.php';
if(isset($_POST['add_item'])){
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$p_image;

   $insert_query = mysqli_query($conn, "INSERT INTO products_downstairs (name, price, image) VALUES ('$p_name', '$p_price','$p_image')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'Item added successfully';
   }else{
      $message[] = 'Error!Could not add product';
   }
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Downstairs Cafeteria Admin Panel</title>

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

   <div class="container">
      <section>
         <form action="" method="post" class="add-product-form"enctype="multipart/form-data">
            <h3>Add a new item</h3>
            <input type="text" name="p_name" placeholder="Enter the item name" class="box" required>
            <input type="number" name="p_price" min="0" placeholder="Enter the item price" class="box" required>
            <input type="file" name="p_image" placeholder="Enter the item image" accept="image/png, image/jpg, image/jpeg" class="box" required>
            <input type="submit" value="Add item" name="add_item" class="btn">

         </form>
      </section>
   </div>

   <script src="javascript/script.js"></script>
</body>
</html>