<?php include_once "./db.php";

    $sql = $pdo -> prepare("UPDATE `tickets` SET `fname`='{$p['efname']}',`lname`='{$p['elname']}',`phone`='{$p['ephone']}',`pw`='{$p['epw']}' WHERE `id` = {$p['eid']}");
    $sql -> execute();