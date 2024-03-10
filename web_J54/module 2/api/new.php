<?php include_once "./db.php";

    $sql = "INSERT INTO `tickets`(`id`, `fname`, `lname`, `phone`, `pw`)
        VALUES (NULL,'{$p["fname"]}','{$p["lname"]}','{$p["phone"]}','{$p["pw"]}')";
    $pdo -> exec($sql);
    header("location: ../home.html");