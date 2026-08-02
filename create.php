<?php

include("connection.php");

try {

    if (isset($_POST["prodBtn"])) {

        $prodName = $_POST["prodName"];
        $prodPrice = $_POST["prodPrice"];
        $prodDesc = $_POST["prodDesc"];

        $insertQuery = "INSERT INTO prodect
        (prodcet_price, prodcet_name, prodcet_quntity)
        VALUES
        (:prodPrice, :prodName, :prodDesc)";

        $insertprepare = $connection->prepare($insertQuery);

        $insertprepare->bindParam(":prodPrice", $prodPrice, PDO::PARAM_INT);
        $insertprepare->bindParam(":prodName", $prodName, PDO::PARAM_STR);
        $insertprepare->bindParam(":prodDesc", $prodDesc, PDO::PARAM_STR);

        if ($insertprepare->execute()) {
            echo "Product inserted successfully";
        } else {
            echo "Product insertion failed";
        }
    }

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Product</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<h2 class="text-center mb-4">Add Product</h2>

<form method="POST">

<div class="mb-3">
<label>Product Name</label>
<input type="text" name="prodName" class="form-control" required>
</div>

<div class="mb-3">
<label>Product Price</label>
<input type="number" name="prodPrice" class="form-control" required>
</div>

<div class="mb-3">
<label>Product Description</label>
<input type="text" name="prodDesc" class="form-control" required>
</div>

<button type="submit" name="prodBtn" class="btn btn-primary">
Add Product
</button>

</form>

</div>

</body>
</html>
