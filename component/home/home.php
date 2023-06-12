<?php
include '../../component/header/header.php';
$userId = $_SESSION['userId'];
$sql = "SELECT dangkiem.dangKiemId, oto.number_car, oto.brand, driver.driverName,
driver.phoneNumber, dangkiem.registerDate, dangkiem.expireDate, dangkiem.dangKiemId FROM dangkiem
JOIN oto ON dangkiem.carId = oto.carId
JOIN driver ON oto.driverId = driver.driverId
WHERE userId = '$userId'"; 
$data = Query($sql, $connection);

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $sql = "DELETE FROM dangkiem WHERE dangKiemId = $delete_id";
    Query($sql, $connection);
    header('Location: ./home.php');
}
?>

<div class="min-w-screen min-h-screen flex items-center justify-center font-sans overflow-hidden">
    <div class="w-full lg:w-5/6">
        <div class="mb-4 flex justify-between items-center">
            <div class="flex-1 pr-4">
                <div class="relative md:w-1/3">
                    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="text" name="search" class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Search...">
                        <div class="absolute top-0 left-0 inline-flex items-center p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                <circle cx="10" cy="10" r="7" />
                                <line x1="21" y1="21" x2="15" y2="15" />
                            </svg>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-max w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Number Car</th>
                        <th class="py-3 px-6 text-left">Brand</th>
                        <th class="py-3 px-6 text-left">Owner</th>
                        <th class="py-3 px-6 text-center">Phone Number</th>
                        <th class="py-3 px-6 text-center">Register Date</th>
                        <th class="py-3 px-6 text-center">Expire Date</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php
                    if (isset($_GET['search'])) {
                        $ket_qua = $_GET['search'];
                        $select = "number_car LIKE '%" . $ket_qua . "%'";
                        $sql = "SELECT dangkiem.dangKiemId, oto.number_car, oto.brand, driver.driverName,
                                        driver.phoneNumber, dangkiem.registerDate, dangkiem.expireDate, dangkiem.dangKiemId FROM dangkiem
                                    JOIN oto ON dangkiem.carId = oto.carId
                                    JOIN driver ON oto.driverId = driver.driverId
                                    WHERE userId = '$userId' AND $select";

                        $search = Query($sql, $connection);
                        foreach ($search as $item) {
                            include '../../component/detail/detail_dangkiem.php';
                        }
                    } else {
                        foreach ($data as $item) {
                            // print_r($item);
                            include '../../component/detail/detail_dangkiem.php';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script>

</script>
<?php
include '../../component/footer/footer.php';
?>