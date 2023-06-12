<?php
include '../../component/header/header_admin.php';
$userId = $_SESSION['userId'];
$sql = "SELECT u.username, COUNT(dk.userId) AS registration_count
FROM user u
LEFT JOIN dangkiem dk ON u.userId = dk.userId
WHERE u.userId != '$userId'
GROUP BY u.userId;
";
$data = Query($sql, $connection);
$sql = "SELECT COUNT(*) AS total FROM dangkiem WHERE userId <> '$userId';";
$sum = Query($sql, $connection);
$data_sum = $sum[0];
$sum = $data_sum['total'];
?>
<link rel="stylesheet" href="./home_admin.css">
<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <ul class="chart">
        <?php
            foreach($data as $data) {
        ?>
        <li>
            <span style="height: <?php echo ($data['registration_count']/$sum)*100;?>%" title="<?php echo $data['username']." - ".(($data['registration_count']/$sum)*100).'%';?>"></span>
        </li>
        <?php
            }
        ?>
    </ul>
</form>
<?php
include '../../component/footer/footer.php';
?>