//GET
// function test() {
//     // alert("aaaaaa");
// }

// function getData() {
//     //GET DATA
//     var dataString = "getData=" + "1";
//     // SS TH TC RC
//     var RC = 100;
//     var SS = 0;
//     var TC = 0;
//     var TH = 0;
//     $.ajax({
//         type: "POST",
//         url: "GetDataForChar.php",
//         data: dataString,
//         cache: false,
//         dataType: "json",
//         success: function (result) {
//             alert(result.Length);
//             if (result[0]['loai'] == "RC")
//                 RC = result[SL];
//             if (result[0]['loai'] == "SS")
//                 SS = result[SL];
//             if (result[0]['loai'] == "TC")
//                 TC = result[SL];
//             if (result[0]['loai'] == "TH")
//                 TH = result[SL];
//             alert(result[0]['SL']);
//             var Data = [TC, TH, SS, RC];
//             alert(Data);
//         }
//     });
// }
// getData();
// loadChart();
// function loadChart() {

//     var ctx1 = document.getElementById('myChart').getContext('2d');
//     var ctx2 = document.getElementById('revenue').getContext('2d');
//     //
//     ////BOX1
//     //
//     // var dataC = new Array();
//     // dataC = getData();
//     // alert(dataC);
//     var myChart = new Chart(ctx1, {
//         type: 'doughnut',
//         data: {
//             labels: ['Trái cây', 'Thịt', 'Sữa', 'Rau củ'],
//             datasets: [{
//                 label: 'Đặt hàng',
//                 data: [],
//                 backgroundColor: [
//                     'rgba(255, 99, 132, 1)',
//                     'rgba(54, 162, 235, 1)',
//                     'rgba(255, 206, 86, 1)',
//                     'rgba(75, 192, 192, 1)',
//                 ],
//             }]
//         },
//         options: {
//             reponsive: true,
//             maintainAspectRatio: false
//         }
//     });
//     myChart.data.datasets[0]
//     //
//     //////BOX2
//     //
//     var revenue = new Chart(ctx2, {
//         type: 'bar',
//         data: {
//             labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
//             datasets: [{
//                 label: 'Doanh thu theo tháng (triệu)',
//                 data: [250.23, 347.23, 165.23, 200.23, 210.23, 290.23, 250.23, 347.23, 165.23, 200.23, 210.23, 290.23],
//                 backgroundColor: [
//                     'rgba(255, 99, 132, 1)',
//                     'rgba(54, 162, 235, 1)',
//                     'rgba(255, 206, 86, 1)',
//                     'rgba(75, 192, 192, 1)',
//                     'rgba(153, 102, 255, 1)',
//                     'rgba(255, 159, 64, 1)',
//                     'rgba(255, 99, 132, 1)',
//                     'rgba(54, 162, 235, 1)',
//                     'rgba(255, 206, 86, 1)',
//                     'rgba(75, 192, 192, 1)',
//                     'rgba(153, 102, 255, 1)',
//                     'rgba(255, 159, 64, 1)'
//                 ],
//             }]
//         },
//         options: {
//             reponsive: true,
//             maintainAspectRatio: false
//         }
//     });
// }



// window.addEventListener('resize',loadChart);

// let grap = document.getElementsByClassName('.grapBox')

// grap.addEventListener('resize',loadChart)