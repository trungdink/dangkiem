<?php
include '../../component/header/header.php';
$error = "";
$success = "";
$userId = $_SESSION['userId'];
if (isset($_POST['submit'])) {
  $bienso = $_POST['bienso'];
  $registerDate = $_POST['ngaydangkiem'];
  $expireDate = $_POST['ngayhethan'];
  $sql = "SELECT * FROM oto WHERE number_car = '$bienso';";
  $result = Query($sql, $connection);

  if (empty($result)) {
    $error = "Biển số xe không tồn tại";
  } else {
    $data = $result[0];
    $carId = $data['carId'];
    $sql = "INSERT INTO `dangkiem` (`userId`, `carId`, `registerDate`, `expireDate`) VALUES
    ('$userId', '$carId', '$registerDate', '$expireDate')";
    Query($sql, $connection);
    $error = "";
    $success = "Đăng kiểm thành công";
  }
}
?>
<div class="p-8">
  <h2 class="text-2xl font-bold mb-4">Form Đăng kiểm ô tô</h2>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="flex mb-4">
      <div class="w-1/2 mr-2">
        <label for="bienso" class="block text-gray-700 font-bold mb-2">Biển số xe:</label>
        <input type="text" id="bienso" name="bienso" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
      </div>
      <div class="w-1/2 ml-2">
        <label for="chusohuu" class="block text-gray-700 font-bold mb-2">Chủ sở hữu:</label>
        <input type="text" id="chusohuu" name="chusohuu" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
      </div>
    </div>
    <div class="mb-4">
      <label for="sodienthoai" class="block text-gray-700 font-bold mb-2">Số điện thoại:</label>
      <input type="tel" id="sodienthoai" name="sodienthoai" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div class="mb-4">
      <label for="diachi" class="block text-gray-700 font-bold mb-2">Địa chỉ nhà:</label>
      <input type="text" id="diachi" name="diachi" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div class="mb-4">
      <label for="ngaydangkiem" class="block text-gray-700 font-bold mb-2">Ngày đăng kiểm:</label>
      <input type="date" id="ngaydangkiem" name="ngaydangkiem" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div class="mb-4">
      <label for="ngayhethan" class="block text-gray-700 font-bold mb-2">Ngày hết hạn:</label>
      <input type="date" id="ngayhethan" name="ngayhethan" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div class="mb-4">
      <p style="color: rgb(254, 20, 93);"><?php echo $error; ?></p>
      <p style="color: green;"><?php echo $success; ?></p>
    </div>
    <div class="flex">
      <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 mr-2">Đăng kiểm</button>
    </div>
  </form>
</div>
<?php
include '../../component/footer/footer.php';
?>