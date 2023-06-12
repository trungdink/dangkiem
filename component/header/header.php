<?php
include '../../database/database.php';
session_start();
$userId = $_SESSION['userId'];
if (!isset($userId)) {
    header('Location: ../../component/login/login.php');
}
if (isset($_POST['log_out'])) {
    session_destroy();
    header('Location: ../../component/login/login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kiểm</title>
    <link rel="stylesheet" href="./css/home_page.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- font-awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css?fbclid=IwAR3z5H1piWVUZNQRsfaddkVOmOKojLEgynatk5wQJK4mgmaqia8GD1Y4ljU">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdn.tailwindcss.com/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <header class="bg-gray-800 text-white">
        <nav class="container mx-auto px-4 py-2 flex items-center justify-between">
            <?php
                if ( $connection) {
                    $sql = "SELECT * FROM user WHERE userId = $userId";
                    $data = Query($sql, $connection);
                    foreach( $data as $data) {
            ?>
            <h3 class="text-xl font-bold"><?php echo $data['username'];?></h3>
            <?php
                }
            }
            ?>
            <ul class="flex space-x-4">
                <li><a href="../home/home.php" class="hover:text-gray-400">Trang chủ</a></li>
                <li><a href="../../component/stats/stats.php" class="hover:text-gray-400">Thống kê</a></li>
                <li><a href="../form/form.php" class="hover:text-gray-400">Đăng kiểm</a></li>
                <li>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <button type="submit" name="log_out" class="hover:text-gray-400">Đăng xuất</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>