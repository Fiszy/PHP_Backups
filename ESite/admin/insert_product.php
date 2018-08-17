<!-- Configuation Database Connect File -->
<?php require 'includes/config.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Product</title>
    <link rel="stylesheet" href="styles/styles.css">
    
</head>
<body bgcolor="grey" >
    <form action="" method="POST" enctype="multipart/form-data"  >
        <table width="770" height="720" align="center" border="1" bgcolor="blue" cellspacing="0" cellpadding="10" style="margin-left:10px;">
            <tr> <td colspan="2" >  <center> <h1> Insert New Product </h1> </center> </td> </tr>
            <tr> <td align="center" ><b> Product Title </b></td> <td align="center"> <input type="text" name="product_title" size="50" style="height: 25px; border-radius: 10px;" required placeholder="HP Brand New Laptop"></td> </tr>
            <tr> <td align="center" > <b> Product Category </b> </td> <td align="center"> 
                <select align="center" name="product_category" style="height: 25px; border-radius: 10px;" required >
                    <option value=""> Select a Category </option>
                    <?php 
                        $categories = "Select * from categories";
                        $fire  = mysqli_query($conn,$categories);
                        while ($result = mysqli_fetch_array($fire)) {
                            $cat_id = $result['category_id'];
                            $cat_title = $result['category_title'];
                            echo "<option value=$cat_id> $cat_title </option>";
                            }
                    ?>
                </select>
            </td> </tr>
            <tr> <td align="center"> <b> Product Brand </b> </td> <td align="center"> 
                <select  name="product_brand" style="height: 25px; border-radius: 10px;" required>
                    <option value=""> Select a Brand </option>
                    <?php 
                        $brands = "Select * from brands";
                        $fire  = mysqli_query($conn,$brands);
                        while ($result = mysqli_fetch_array($fire)) {
                            $brand_id = $result['brand_id'];
                            $brand_title = $result['brand_title'];
                            echo "<option value=$brand_id> $brand_title </option>";
                        }
                    ?>
                </select>
            </td> </tr>
            <tr> <td align="center" cellspacing="0" > <b> Product Image 1 </b> </td> <td align="center"> <input type="file" name="product_img1" style="height: 25px; border-radius: 10px;" required > </td> </tr>
            <tr> <td align="center" cellspacing="0" > <b> Product Image 2 </b> </td> <td align="center"> <input type="file" name="product_img2" style="height: 25px; border-radius: 10px;" > </td> </tr>
            <tr> <td align="center" cellspacing="0" > <b> Product Image 3 </b> </td> <td align="center"> <input type="file" name="product_img3" style="height: 25px; border-radius: 10px;"  > </td> </tr>
            <tr> <td align="center" cellspacing="0" > <b> Price </b> </td> <td align="center"> <input type="number" name="product_price" placeholder="5000" style="height: 25px; border-radius: 10px;" required > </td> </tr>
            <tr> <td align="center" cellspacing="0" > <b> Keywords </b> </td> <td align="center"> <input type="text" name="product_keywords" size="50" placeholder="Laptop, HP, New" style="height: 25px; border-radius: 10px;" required > </td> </tr>
            <tr><td align="center" cellspacing="0"><b> Description </b></td><td align="center"><textarea name="product_desc" cols="50" rows="10"></textarea> </td></tr>
            <tr align="center" > <td colspan="2" > <input type="submit" name="insert" value="Insert Product" >  </td> </tr>
            

        </table>

    </form>
    
</body>
</html>

<?php
    if (isset($_POST['insert'])) {
        $product_title = $_POST['product_title'];
        $product_category = $_POST['product_category'];
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_keyword = $_POST['product_keywords'];
        $status = 'on';

        $product_img1 = $_FILES['product_img1']['name'];
        $product_img2 = $_FILES['product_img2']['name'];
        $product_img3 = $_FILES['product_img3']['name'];

        // img temp names
        $temp_img1 = $_FILES['product_img1']['tmp_name'];
        $temp_img2 = $_FILES['product_img2']['tmp_name'];
        $temp_img3 = $_FILES['product_img3']['tmp_name'];

        move_uploaded_file($temp_img1,"product_images/$product_img1");
        move_uploaded_file($temp_img2,"product_images/$product_img2");
        move_uploaded_file($temp_img3,"product_images/$product_img3");

        $insert_product = "INSERT into products(category_id,brand_id,date,product_title,product_img1,product_img2,product_img3,product_price,product_desc,status,product_keywords) 
                           VALUES  ('$product_category','$product_brand',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc','$status','$product_keyword')";
        $fire = mysqli_query($conn,$insert_product);
        if ($fire) {
            echo "<script> alert('Product Added Successfully') </script>";
        }
        else {
            echo "<script> alert('Please Try Again') </script>";
        }
    }


?>