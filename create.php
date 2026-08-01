<?php

include("connection.php");

try {

    if(isset($_POST["prodBtn"])) {

        $prodName = $_POST["prodname"];
        $prodPrice = $_POST["prodprice"];
        $prodDesc = $_POST["proddesc"];

        $insertQuery = "INSERT INTO `prodect`( `prodcet_price`, `prodcet_name`, `prodcet_quntity`) VALUES (:prod_name, :prodprice, :proddesc)";


        $insertprepare = $connection->prepare($insertQuery);
         $insertprepare = $connection->bindParam(":prodName", $prodname, PDO::PARAM_STR);
          $insertprepare = $connection->bindParam(":prodPrice", $prodPrice, PDO::PARAM_INT);
         $insertprepare = $connection->bindParam(":prodDesc", $prodDesc, PDO::PARAM_STR);


        if($insertprepare->execute()) {
            echo "products inserted successfully";
        }else {
            echo "products insertion faild!";
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
    <title>add products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
  
    <h1 class="text-center">Add Products</h1>

<div class="container">
    
<form method="post">

<div class="mb-3">
  <label for="formGroupExampleInput" class="form-label">Product Name</label>
  <input type="text" class="form-control" id="formGroupExampleInput" name="prodName">
</div>
<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Product Price</label>
  <input type="text" class="form-control" id="formGroupExampleInput2" name="prodPrice" >
</div>
<div class="mb-3">
  <label for="formGroupExampleInput2" class="form-label">Product Description</label>
  <input type="text" class="form-control" id="formGroupExampleInput2" name="prodDesc" >
</div>
<div class="col-12">
    <button type="submit" class="btn btn-primary" name="prodBtn">add products</button>
  </div>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>