<?php

include('connection.php');

try {

    $viewQuery = "SELECT * FROM `products`";

    $viewPrepare = $connect->prepare($viewQuery);

    $viewPrepare->execute();

    $prodData = $viewPrepare->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($prodData);
    // echo "</pre>";
} catch (\Throwable $th) {
    throw $th;
}

if(isset($_GET['delId'])){

    $deleteQuery = "DELETE FROM `products` WHERE prod_id = :id";

    $deletePrepare = $connect->prepare($deleteQuery);
    $deletePrepare->bindParam(':id',$_GET['delId'],PDO::PARAM_INT);

    if($deletePrepare->execute()){
        echo "<br>Item Deleted Successfully<br>";
        header("Location:view.php");
    }
    else{
        echo "<br>Product with provided id is not available!<br>";

    }

}


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <div class="container">
    <h1 class="text-center">All Products</h1>
        <div class="row">

    <?php foreach($prodData as $prod){ ?>

            <div class="col">
                <div class="card" style="width: 18rem;">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $prod['prod_name'] ?></h5>
                        <p class="card-text">Price: <?php echo $prod["prod_price"] ?></p>
                        <p class="card-text"><?php echo $prod["prod_desc"] ?>.</p>
                        <a href="view.php?delId=<?php echo $prod["prod_id"] ?>" class="btn btn-danger">Delete</a>
                        <a href="update.php?upId=<?php echo $prod["prod_id"] ?>" class="btn btn-warning">Update</a>
                    </div>
                </div>
            </div>


    <?php } ?>


        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>