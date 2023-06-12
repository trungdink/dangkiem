<?php
include '../../component/header/header.php';
?>

<!-- component -->
<div class="flex flex-col items-center justify-center min-w-screen min-h-screen">

  <script src="//unpkg.com/alpinejs" defer></script>

  <div class="flex gap-x-5 mb-4 items-center justify-center">
    <button onclick="handleClick('bar')" class="bg-purple-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded btn">Bar</button>
    <button onclick="handleClick('line')" class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded btn">Line</button>
  </div>
  <!-- Chart -->
  <div class="shadow-lg rounded-lg overflow-hidden bg-white w-1/2 chart">
    <div class="py-3 px-5 bg-gray-50">Thống kê lượt đăng kiểm</div>
    <canvas class="p-10" id="chartLine"></canvas>
  </div>
</div>

<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart line -->
<script>
  const renderChart = (chart, arr) => {
    const color = ['rgba(63, 81, 181, 0.5)', 'rgba(77, 182, 172, 0.5)', 'rgb(205, 24, 24)', 'rgba(156, 39, 176, 0.5)', 'rgba(233, 30, 99, 0.5)', 'rgba(66, 73, 244, 0.4)', 'rgba(66, 133, 244, 0.2)']
    const titles  = ['Lượt xe đăng kiểm theo tháng', 'Lượt xe đăng kiểm theo năm', 'Lượt xe sắp hết hạn']
      // rgba(63, 81, 181, 0.5)', 'rgba(77, 182, 172, 0.5)', 'rgba(66, 133, 244, 0.5)', 'rgba(156, 39, 176, 0.5)', 'rgba(233, 30, 99, 0.5)', 'rgba(66, 73, 244, 0.4)', 'rgba(66, 133, 244, 0.2)'
    const newDataSets = arr.map((item, index) => {
      return {
        label: titles[index],
        backgroundColor: color[index],
        borderColor: color[index],
        data: item,
      }
    })
    const labels = ["January/2015", "February/2016", "March/2017", "April/2018", "May/2019", "June/2020", "July/2021", "August/2022", "September/2023", "October/2024", "November/2025", "December/2026"];
    const data = {
    labels: labels,
    datasets: newDataSets
  };
  const configLineChart = {
    type: chart,
    data,
    options: {},
  };

    var chartLine = new Chart(
      document.getElementById("chartLine"),
      configLineChart
    );
  }
  let globalResult; // Biến toàn cục để lưu kết quả

  async function fetchData() {
    try {
      const response = await fetch('../../api_stats.php');
      const data = await response.json();

      let result = [];
      //Thống kê theo tháng
      let registerByMonth = [];
      //Thống kê theo năm
      let registerByYear = [];
      //Thống kê xe sắp hết hạn
      let expired = [];
      for (let i = 0; i < 12; i++) {
        registerByMonth[i] = 0;
        registerByYear[i] = 0;
        expired[i] = 0;
      }
      for (let i = 0; i < data.length; i++) {
        let a = new Date(data[i].registerDate)
        let b = new Date(data[i].expireDate)
        for (let j = 0; j < 12; j++) {
          if (a.getMonth() == j) {
            ++registerByMonth[j]
          }
          if (a.getFullYear() == j + 15 + 2000) {
            ++registerByYear[j];
          }
          if (b.getMonth() == j && Time().getFullYear() == b.getFullYear()) {
            if (Convert(b - Time()) <= 30 && Convert(b - Time()) >= 0) {
              ++expired[j];
            }
          }
        }
      }
      result.push(registerByMonth);
      result.push(registerByYear);
      result.push(expired);

      globalResult = result; // Gán kết quả cho biến toàn cục
    } catch (error) {
      console.error('Lỗi khi gọi API:', error);
      throw error;
    }
  }

  const getApi = (async (charts) => {
  try {
    await fetchData();
    console.log(globalResult);
    renderChart(charts, globalResult)
    // Các xử lý khác...
  } catch (error) {
    console.error('Lỗi khi lấy dữ liệu:', error);
  }
});
  getApi('bar')
  console.log(globalResult);
  const handleClick = (newChart) => {
    let grapharea = document.querySelector("#chartLine").remove()
    let canvas = document.createElement("canvas");
    canvas.className = "p-10"
    canvas.id = "chartLine"
    document.querySelector('.chart').appendChild(canvas)
    // renderChart(newChart)
    getApi(newChart)
  }

//Lấy ra thời gian hiện tại
function Time() {
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, "0");
  var mm = String(today.getMonth() + 1).padStart(2, "0");
  var yyyy = today.getFullYear();

    today = mm + "/" + dd + "/" + yyyy;
    let now = new Date(today);
    return now;
  }

  //Hàm Convert từ milisecond sang ngày
  function Convert(a) {
    a *= 0.001;
    a /= 3600;
    a /= 24;
    return a;
  }
</script>

<?php
include '../../component/footer/footer.php';
?>