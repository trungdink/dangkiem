<?php
define('SERVER', 'localhost');
define('DB_NAME', 'dangkiem_uet2');
define('DB_USER_NAME', 'root');
define('DB_PASSWORD', '');

$sql_create_db = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;

//pdo = PHP Data Object
$connection_string = "mysql:host=" . SERVER;
$connection = null;
try {
    $connection = new PDO(
        $connection_string,
        DB_USER_NAME,
        DB_PASSWORD
    );
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($connection->query($sql_create_db) == TRUE) {
        //echo "Create DB successfully<br>";

        $connection->query("USE " . DB_NAME);
    } else {
        echo "Create DB failed<br>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
function Query($sql, $connection)
{
    $statement = $connection->prepare($sql);
    $statement->execute();
    //Chế độ lấy dữ liệu ra
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $data = $statement->fetchAll();
    return $data;
}
?>
