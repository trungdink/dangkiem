<?php
    include './database/database.php';
    session_start();
    $userId = $_SESSION['userId'];
    $sql = "SELECT * FROM user JOIN dangkiem ON user.userId = dangkiem.userId WHERE user.userId = '$userId'";
    $data = Query($sql, $connection);
    echo json_encode($data);
?>
