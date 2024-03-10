<?php include_once "./db.php";

    $sql = "SELECT * FROM `tickets` WHERE `id`= {$_GET["id"]}";
    $query = $pdo -> query($sql) -> fetch();
    echo json_encode($query);