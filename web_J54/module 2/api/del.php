<?php include_once "./db.php";

    $sql = $pdo -> prepare("DELETE FROM `tickets` WHERE `id` = {$p["id"]}");
    $sql -> execute();