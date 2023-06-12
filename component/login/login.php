<?php
include '../../database/database.php';
$error = "";
session_save_path("C:/xampp/tmp");
session_start();

if (isset($_POST['submit'])) {

    $username = htmlspecialchars($_POST['username'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');
    if (empty($username) || empty($password)) {
        $error = "You must enter your username or password";
    } else {
        if ($connection) {
            $sql = "SELECT * FROM user WHERE username = '$username';";
            $user = Query($sql, $connection);
            foreach ( $user as $user) {
                if ( $user['username'] == $username && $user['password'] == $password) {
                    $_SESSION['userId'] = $user['userId'];
                    if ( $user['role'] == 0) {
                        header('Location: ../../component/home/home.php');
                    } else {
                        header('Location: ../../component/home/home_admin.php');
                    }
                }else {
                    $error = "Sai mật khẩu hoặc tên đăng nhập";
                }  
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login_page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-image: linear-gradient(109.6deg, rgba(48, 207, 208, 1) 11.2%, rgba(51, 8, 103, 1) 92.5%);
        }
    </style>
</head>

<body>
    <div class="flex flex-col items-center justify-center h-screen">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h1 class="text-3xl font-bold mb-8">Cục đăng kiểm Việt Nam</h1>
            <div class="bg-white p-8 rounded shadow-md w-80">
                <form>
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                        <input type="text" name="username" id="username" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500" placeholder="Enter your username">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-indigo-500" placeholder="Enter your password">
                    </div>
                    <div>
                        <p style="color: red;text-align: right;"><?php echo $error; ?></p>
                    </div>
                    <button type="submit" name="submit" class="w-full bg-indigo-500 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700">Log In</button>
                </form>
            </div>
        </form>
    </div>
</body>

</html>