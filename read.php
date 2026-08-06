<?php 
include("connection.php");

try {
    $viewQuery = "SELECT * FROM `prodect`";
    $viewQueryPrepare = $connection->prepare($viewQuery);
    $viewQueryPrepare->execute();
    $productsData = $viewQueryPrepare->fetchAll(PDO::FETCH_ASSOC);
} catch (\Throwable $th) {
    throw $th;
}

if (isset($_GET["delId"])) {
    try {
        $delId = $_GET["delId"];
        $deleteQuery = "DELETE FROM `prodect` WHERE `prodcect_id` = :delId";
        $deleteQueryPrepare = $connection->prepare($deleteQuery);
        $deleteQueryPrepare->bindParam(":delId", $delId, PDO::PARAM_INT);
        if ($deleteQueryPrepare->execute()) {
            echo "<script>location.href='read.php'</script>";
            exit; 
        } else {
            echo "Product is not deleted";
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css" integrity="sha512-ApSLB1Pd3/bZN8fWB/RG9YhN/7bd9Hkf3AGaE2mPfebjrxagjuBtx2GcgdqIlJkUzwylBo61r9Xa9NmgBI0swA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>product</title>
  </head>
  <body>
    <h1 class="text-center">ALL PRODUCTS!</h1>
    <div class="container">

      <?php if ($productsData): ?>
        <p class="text-success">Products loaded successfully</p>
      <?php else: ?>
        <p class="text-danger">No products found</p>
      <?php endif; ?>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">Products Id</th>
            <th scope="col">Products Name</th>
            <th scope="col">Products Price</th>
            <th scope="col">Products Description</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($productsData as $value) { ?>
          <tr>
            <th><?= htmlspecialchars($value["prodcect_id"]) ?></th>
            <td><?= htmlspecialchars($value["prodcet_name"]) ?></td>
            <td><?= htmlspecialchars($value["prodcet_price"]) ?></td>
            <td><?= htmlspecialchars($value["prodcet_quntity"]) ?></td>
            <td>
              <a href="read.php?delId=<?= urlencode($value["prodcect_id"]) ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
              <a href="updateproducts.php?upId=<?= urlencode($value["prodcect_id"]) ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>