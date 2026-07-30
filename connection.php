<?php

try {
    $connection = new PDO("mysql:host=localhost;dbname=dbdata", "root", "");
    echo "Database connected successfully!";

} catch (\Throwable $th) {
    throw $th;
}



?>