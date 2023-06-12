<?php
include '../../component/header/header_admin.php';
$userId = $_SESSION['userId'];
$error = "";
$success = "";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repass = $_POST['repass'];
    $sql = "SELECT * FROM user WHERE username = '$username';";
    $result = Query($sql, $connection);

    if (!empty($result)) {
        $error = "Username đã tồn tại";
    } else if ( $password != $repass) {
        $error = "Mật khẩu không trùng khớp";
    } else {
        $sql = "INSERT INTO `user` (`username`, `password`) VALUES
      ('$username', '$password')";
        Query($sql, $connection);
        $error = "";
        $success = "Đăng ký thành công";
    }
}
?>

<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Form Đăng ký Trung tâm đăng kiểm</h1>
    <form class="max-w-md mx-auto" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label>
            <input name="username" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
            <input name="password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Password">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="confirmPassword">Nhập lại Password</label>
            <input name="repass" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="confirmPassword" type="password" placeholder="Nhập lại Password">
        </div>
        <div class="mb-4">
            <p style="color: rgb(254, 20, 93);"><?php echo $error; ?></p>
            <p style="color: white;"><?php echo $success; ?></p>
        </div>
        <div class="flex items-center justify-center">
            <button name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Submit</button>
        </div>
    </form>
</div>

<?php
include '../../component/footer/footer.php';
?>
