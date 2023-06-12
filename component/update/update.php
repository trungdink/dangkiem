<?php
include '../../component/header/header.php';
$error = '';
if (!isset($_GET['edit'])) {
    header('Location: ./home.php');
}
$edit_id = $_GET['edit'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cancel'])) {
        header('Location: ../../component/home/home.php');
    } else if (isset($_POST['submit'])) {
        $registerDate = $_POST['registerDate'];
        $expireDate = $_POST['expireDate'];

        $sql = "UPDATE `dangkiem` SET `registerDate` = '$registerDate', `expireDate` = '$expireDate' 
        WHERE `dangKiemId` = '$edit_id';";
        Query($sql, $connection);
        header('Location: ../../component/home/home.php');
    }
}

?>

<div class="w-full max-w-md mx-auto">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="<?php echo $_SERVER['PHP_SELF'] . '?edit=' . $edit_id; ?>" method="post">
        <?php
        $sql = "SELECT dangkiem.dangKiemId, oto.number_car, oto.brand, driver.driverName,
        driver.phoneNumber, dangkiem.registerDate, dangkiem.expireDate, dangkiem.dangKiemId FROM dangkiem
        JOIN oto ON dangkiem.carId = oto.carId
        JOIN driver ON oto.driverId = driver.driverId
        WHERE dangkiem.dangKiemId = '$edit_id'";
        $data = Query($sql, $connection);
        foreach ($data as $row) {
            ?>
            <!-- Biển số xe -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Biển số xe:</label>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 leading-tight" type="text" value="<?php echo $row['number_car']; ?>" disabled>
            </div>
            <!-- Nhãn hiệu -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nhãn hiệu:</label>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 leading-tight" type="text" value="<?php echo $row['brand']; ?>" disabled>
            </div>
            <!-- Chủ sở hữu -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Chủ sở hữu:</label>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 leading-tight" type="text" value="<?php echo $row['driverName']; ?>" disabled>
            </div>
            <!-- Số điện thoại -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Số điện thoại:</label>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 leading-tight" type="text" value="<?php echo $row['phoneNumber']; ?>" disabled>
            </div>
            <!-- Ngày đăng kiểm -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Ngày đăng kiểm:</label>
                <input class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 leading-tight" name="registerDate" type="date" value="<?php echo $row['registerDate']; ?>">
            </div>
            <!-- Ngày hết hạn -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Ngày hết hạn:</label>
                <input class="bg-white appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 leading-tight" name="expireDate" type="date" value="<?php echo $row['expireDate']; ?>">
            </div>
            <!-- Button -->
            <div class="flex items-center justify-between">
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" name="cancel" type="submit">Cancel</button>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" name="submit" type="submit">Submit</button>
            </div>
        <?php
        }
        ?>
    </form>
</div>

<?php
include '../../component/footer/footer.php';
?>
