<?php

include("connection.php");



try {

$prodId = $_GET['upId'];



$viewQuery = "SELECT * FROM `products` WHERE `prod_id`= :prodId";
$viewQueryPrepare = $connection->Prepare($viewQuery);
$viewQueryPrepare->bindParam(':prodId',$prodId);
$viewQueryPrepare->execute();
$productsData = $viewQueryPrepare->fetch(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($productsData);
echo "</pre>";


} catch (\Throwable $th) {
    throw $th;
}






try {
    if (isset($_POST["prodBtn"])){

        $prodName = $_POST["prodName"];
        $prodPrice = $_POST["prodPrice"];
        $prodDesc = $_POST["prodDesc"];


        $insertQuery = "UPDATE `products` SET `prod_name`=:prodName,`prod_price`=:prodPrice,`prod_desc`=:prodDesc WHERE `prod_id`= :prodId";



        $insertPrepare= $connection->prepare($insertQuery);
        $insertPrepare->bindParam(":prodId", $prodId, PDO::PARAM_INT);
        $insertPrepare->bindParam(":prodName", $prodName, PDO::PARAM_STR);
        $insertPrepare->bindParam(":prodPrice", $prodPrice, PDO::PARAM_INT);
        $insertPrepare->bindParam(":prodDesc", $prodDesc, PDO::PARAM_STR);
      

        if($insertPrepare->execute()){
            echo "Product Updated Successfully!";
            echo "<script>location.href='view.php'</script>";
        }
        else {
            echo "Product Updation Failed!";
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
    <title>Update PRODUCTS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text-center" >PDO Update PRODUCTS</h1>
    <div class="container">
        <form class="row g-3" method="post">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Product Name</label>
    <input type="text" value="<?= $productsData['prod_name'] ?>" name="prodName" class="form-control" id="inputEmail4">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Product Price</label>
    <input type="text" value="<?= $productsData['prod_price'] ?>" name="prodPrice" class="form-control" id="inputPassword4">
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Product Description</label>
    <input type="text" value="<?= $productsData['prod_desc'] ?>" name="prodDesc" class="form-control" id="inputAddress">
  </div>


  <div class="col-12">
    <button type="submit" name="prodBtn" class="btn btn-primary">Update Product</button>
  </div>
</form>
<a href="view.php">go to view page</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>