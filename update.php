<?php

include("connection.php");




try {

  $viewQuery = "SELECT * FROM `products` WHERE prod_id = :id";

  $viewPrepare = $connect->prepare($viewQuery);
  $viewPrepare->bindParam(':id', $_GET['upId'], PDO::PARAM_INT);
  $viewPrepare->execute();

  $prodData = $viewPrepare->fetch(PDO::FETCH_ASSOC);

  // echo "<pre>";
  // print_r($prodData);
  // echo "</pre>";
} catch (\Throwable $th) {
  throw $th;
}



try {
  if (isset($_POST["prodBtn"])) {

    $prodName = $_POST["prodName"]; //Mouse, Duster, Bottle
    $prodPrice = $_POST["prodPrice"]; //2000, 3000, 4000
    $prodDesc = $_POST["prodDesc"]; //Good Product
    $prodImage = $_FILES['prodImage'];

    echo "<pre>";
    print_r($prodImage);
    echo "</pre>";

    if ($prodImage['size'] > 5000000) {
      echo "Image size is too large";
    } else {
      // echo "<pre>";
      // print_r(explode(".",$prodImage['name'])[1]);
      // echo "</pre>";


      $extension = explode(".", $prodImage['name'])[1];
      // $extension = $extension[1];

      // echo "<pre>";
      // print_r($extension);
      // echo "</pre>";

      // echo uniqid();


      $uniqueName = uniqid() . "." . $extension;
      echo "Unique Name: $uniqueName";

      move_uploaded_file($prodImage['tmp_name'], "images/$uniqueName");


      // echo $prodName;
      // echo "<br>";
      // echo $prodPrice;
      // echo "<br>";
      // echo $prodDesc;

      $updateQuery = "UPDATE `products` SET `prod_name`=:prodName,`prod_price`=:prodPrice,`prod_desc`=:prodDesc, `prod_image`=:prodImage WHERE `prod_id`= :id";

      // UPDATE `products` SET `prod_name`=:prodName,`prod_price`=:prodPrice,`prod_desc`=:prodDesc WHERE `prod_id`=:id


      if ($prodImage['name']) {
        $imageName = $uniqueName;
      }
      else{
        $imageName = $prodData['prod_image'];
      }




      $updatePrepare = $connect->prepare($updateQuery);

      $updatePrepare->bindParam(":prodName", $prodName, PDO::PARAM_STR);
      $updatePrepare->bindParam(":prodPrice", $prodPrice, PDO::PARAM_INT);
      $updatePrepare->bindParam(":prodDesc", $prodDesc, PDO::PARAM_STR);
      $updatePrepare->bindParam(':id', $_GET['upId'], PDO::PARAM_INT);
      $updatePrepare->bindParam(":prodImage", $imageName, PDO::PARAM_STR);

      if ($updatePrepare->execute()) {
        echo "<br> Product Update successfully!";
        header("Location:view.php");
      } else {
        echo "<br> Product updation failed";
      }
    }
  }
} catch (\Throwable $th) {
  throw $th;
}


?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADD PRODUCTS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
  <h1 class="text-center">Update PRODUCTS</h1>
  <div class="container">
    <form class="row g-3" method="post" enctype="multipart/form-data">
      <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Product Name</label>
        <input type="text" name="prodName" class="form-control" value="<?php echo $prodData['prod_name'] ?>" id="inputEmail4">
      </div>
      <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Product Price</label>
        <input type="text" name="prodPrice" class="form-control" value="<?php echo $prodData['prod_price'] ?>" id="inputPassword4">
      </div>
      <div class="col-12">
        <label for="inputAddress" class="form-label">Product Description</label>
        <input type="text" name="prodDesc" class="form-control" value="<?php echo $prodData['prod_desc'] ?>" id="inputAddress">
      </div>
      <div class="col-12">
        <label for="inputAddress" class="form-label">Product Image</label>
        <input type="file" name="prodImage" class="form-control" id="inputAddress">
      </div>
      <div class="col-12">
        <img src="images/<?php echo $prodData['prod_image'] ?>" alt="" width="100px">
      </div>


      <div class="col-12">
        <button type="submit" name="prodBtn" class="btn btn-primary">Update Product</button>
      </div>
    </form>
    <!-- <a href="view.php">go to view page</a> -->
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
