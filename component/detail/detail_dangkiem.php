<?php
// SELECT * FROM dangkiem JOIN oto ON dangkiem.carId = oto.carId JOIN driver ON oto.driverId = driver.driverId WHERE userId = 1 AND number_car LIKE '%%';

        echo
        '<tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">' . $item['dangKiemId'] . '</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">' . $item['number_car'] . '</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span class="font-medium">' . $item['brand'] . '</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                    <div class="flex items-center">
                        <span class="font-medium">' . $item['driverName'] . '</span>
                    </div>
                </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex items-center justify-center">
                            <span class="font-medium">' . $item['phoneNumber'] . '</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <span class="bg-purple-200 text-purple-600 py-2 px-4 font-medium">' . $item['registerDate'] . '</span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <span class="bg-purple-200 text-purple-600 py-2 px-4 font-medium">' . $item['expireDate'] . '</span>
                    </td>
                    <td class="py-3 px-6 text-center"> 
                        <div class="flex item-center justify-center">
                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                            <a href="../../component/update/update.php?edit=' . $item['dangKiemId'] . '">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            </div>
                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                            <a href="./home.php?delete=' . $item['dangKiemId'] . '">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                            </div>
                        </div>
                    </td>
                </tr>';
?>