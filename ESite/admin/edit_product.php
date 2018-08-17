<?php require 'includes/config.php'; ?>
<?php


if (isset($_GET['edit_product'])) {
    $product = $_GET['edit_product'];
    $get_product = " SELECT * from products where product_id = '$product' ";
    $run_product = mysqli_query($conn,$get_product);
    $row = mysqli_fetch_array($run_product);

    $update_id = $row['product_id'];

    $name = $row['product_title'];
    $category_id = $row['category_id'];
    $brand_id = $row['brand_id'];
    $img1 = $row['product_img1'];
    $img2 = $row['product_img2'];
    $img3 = $row['product_img3'];
    $product_price = $row['product_price'];
    $product_keywords = $row['product_keywords'];
    $product_desc = $row['product_desc'];
}
$get_brand = " SELECT * from brands where brand_id = '$brand_id' ";
$run_brand = mysqli_query($conn,$get_brand);
$row_brand = mysqli_fetch_array($run_brand);
$name2 = $row_brand['brand_title'];

 $get_name = " SELECT * from categories where category_id = '$category_id' ";
$run_name = mysqli_query($conn,$get_name);
$row_name = mysqli_fetch_array($run_name);
 $name1 = $row_name['category_title'];

?>

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
        <table width="790" height="800" align="center" border="1" bgcolor="blue" cellspacing="0" cellpadding="10" style="margin-top:0px;">
            <tr> <td colspan="2" >  <center> <h1> Update Product </h1> </center> </td> </tr>
            <tr> <td align="center" ><b> Product Title </b></td> 
            <td align="center"> <input type="text" name="p_name" size="50" style="height: 25px; border-radius: 10px;" value="<?php echo $name; ?>" ></td> </tr>
            <tr> <td align="center" > <b> Product Category </b> </td> <td align="center"> 
                <select align="center" name="p_category" style="height: 25px; border-radius: 10px;" required >
                    <option value=""><?php echo $name1; ?>  </option>
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
                <select  name="p_brand" style="height: 25px; border-radius: 10px;" >
                    <option value=""> <?php echo $name2; ?> </option>
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
            <tr> <td align="center" cellspacing="0" > <b> Product Image 1 </b> </td> 
            <td align="center"> <input type="file" name="p_img1" style="height: 25px; border-radius: 10px;"   >
            <img src="product_images/<?php echo $img1; ?>" height="80" width="80"> </td> </tr>
            <tr> <td align="center" cellspacing="0" > <b> Product Image 2 </b> </td> 
            <td align="center"> <input type="file" name="p_img2" style="height: 25px; border-radius: 10px;">
            <img src="product_images/<?php  echo $img2; ?>" height="80" width="80"> </td> </tr>
            <tr> <td align="center" cellspacing="0" > <b> Product Image 3 </b> </td> 
            <td align="center"> <input type="file" name="p_img3" style="height: 25px; border-radius: 10px;"  >
        <img src="product_images/<?php  echo $img3; ?>" height="80" width="80"> </td> </tr>
            <tr> <td align="center" cellspacing="0" > <b> Price </b> </td> 
            <td align="center"> <input type="number" name="p_price" style="height: 25px; border-radius: 10px;" value="<?php echo $product_price; ?>"  > </td> </tr>
            <tr> <td align="center" cellspacing="0" > <b> Keywords </b> </td>
             <td align="center"> <input type="text" name="p_keywords" size="50" value="<?php echo $product_keywords; ?>" style="height: 25px; border-radius: 10px;"  > </td> </tr>
            <tr><td align="center" cellspacing="0"><b> Description </b></td>
            <td align="center"><textarea name="p_desc" cols="50" rows="10"><?php echo $product_desc; ?></textarea> </td></tr>
            <tr align="center" > 
                <td colspan="2" > <input type="submit" name="insert" value="Update Product" >  </td>
             </tr>
        </table>

    </form>
    
</body>
</html>



<?php

if (isset($_POST['insert'])) {
    $p_name = $_POST['p_name'];
    $p_category = $_POST['p_category'];
    $p_brand = $_POST['p_brand'];
    $p_price = $_POST['p_price'];
    $p_keywords = $_POST['p_keywords'];
    $p_desc = $_POST['p_desc'];
    $p_img1 = $_FILES['p_img1']['name'];
    $p_temp_img1 = $_FILES['p_img1']['tmp_name'];
    $p_img2 = $_FILES['p_img2']['name'];
    $p_temp_img2 = $_FILES['p_img2']['tmp_name'];
     $p_img3 = $_FILES['p_img3']['name'];
    $p_temp_img3 = $_FILES['p_img3']['tmp_name'];
    

    $update_details = "UPDATE products set category_id='$p_category',brand_id='$p_brand',product_title='$p_name',date = NOW(),product_img1='$p_img1',
    product_img2='$p_img2',product_img3='$p_img3',product_price='$p_price',product_keywords='$p_keywords',
    product_desc='$p_desc' where product_id  = '$update_id' ";
    $run_update = mysqli_query($conn,$update_details);
    if ($run_update) {
        move_uploaded_file($p_temp_img1,"product_images/$p_img1");
        move_uploaded_file($p_temp_img2,"product_images/$p_img2");
        move_uploaded_file($p_temp_img3,"product_images/$p_img3");
        echo " <script> alert('Product Updated Successfully!') </script> ";
        echo " <script> window.open('index.php?view_products','_self') </script> ";
    }
}


?>