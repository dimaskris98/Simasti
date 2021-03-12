<?php
$conn = new mysqli("localhost", "root", "", "bootstrap");
			if ($conn->connect_errno) {
				echo "Failed to connect to MySQL: " . $conn->connect_error;
			}

$tahun = $_POST['tahun'];
$januari = $conn->query("SELECT tgl FROM data_servis WHERE (YEAR(tgl)='$tahun')AND (MONTH(tgl)='01') AND STATUS = 'ok'");
$row_januari = $januari->num_rows;
$februari = $conn->query("SELECT tgl FROM data_servis WHERE (YEAR(tgl)='$tahun')AND (MONTH(tgl)='02') AND STATUS = 'ok'");
$row_februari = $februari->num_rows;
$maret = $conn->query("SELECT tgl FROM data_servis WHERE (YEAR(tgl)='$tahun')AND (MONTH(tgl)='03') AND STATUS = 'ok'");
$row_maret = $maret->num_rows;
$april = $conn->query("SELECT tgl FROM data_servis WHERE (YEAR(tgl)='$tahun')AND (MONTH(tgl)='04') AND STATUS = 'ok'");
$row_april = $april->num_rows;
$mei = $conn->query("SELECT tgl FROM data_servis WHERE (YEAR(tgl)='$tahun')AND (MONTH(tgl)='05') AND STATUS = 'ok'");
$row_mei= $mei->num_rows;
$juni = $conn->query("SELECT tgl FROM data_servis WHERE (YEAR(tgl)='$tahun')AND (MONTH(tgl)='06') AND STATUS = 'ok'");
$row_juni= $juni->num_rows;
$juli = $conn->query("SELECT tgl FROM data_servis WHERE (YEAR(tgl)='$tahun')AND (MONTH(tgl)='07') AND STATUS = 'ok'");
$row_juli= $juli->num_rows;
$agustus = $conn->query("SELECT tgl FROM data_servis WHERE (YEAR(tgl)='$tahun')AND (MONTH(tgl)='08') AND STATUS = 'ok'");
$row_agustus= $agustus->num_rows;
$september = $conn->query("SELECT tgl FROM data_servis WHERE (YEAR(tgl)='$tahun')AND (MONTH(tgl)='09') AND STATUS = 'ok'");
$row_september= $september->num_rows;
$oktober = $conn->query("SELECT tgl FROM data_servis WHERE (YEAR(tgl)='$tahun')AND (MONTH(tgl)='10') AND STATUS = 'ok'");
$row_oktober= $oktober->num_rows;
$nopember = $conn->query("SELECT tgl FROM data_servis WHERE (YEAR(tgl)='$tahun')AND (MONTH(tgl)='11') AND STATUS = 'ok'");
$row_nopember= $nopember->num_rows;
$desember = $conn->query("SELECT tgl FROM data_servis WHERE (YEAR(tgl)='$tahun')AND (MONTH(tgl)='12') AND STATUS = 'ok'");
$row_desember = $desember ->num_rows;

?>
<html>
    <head>
	<link rel="stylesheet" href="../asset/bootstrap.min.css">
	<link rel="stylesheet" href="../asset/global.css">
        <title></title>
        <script src="Chart.bundle.js"></script>
 
        <style type="text/css">
            .container {
                width: 60%;
                margin: 15px auto;
            }
        </style>
    </head>
    <body>
	
<div class="container">
           
<canvas id="myChart" width="100" height="100"></canvas>
<a href="../index.php" class="btn btn-success btn-xs">Back</a>	
        </div>
		
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
                    datasets: [{
                            label: [<?php echo $tahun ?>],
							
                            data: [<?php echo $row_januari ?>,<?php echo $row_februari ?>,<?php echo $row_maret ?>,<?php echo $row_april ?>,<?php echo $row_mei ?>,<?php echo $row_juni ?>,<?php echo $row_juli ?>,<?php echo $row_agustus ?>,<?php echo $row_september ?>,<?php echo $row_oktober ?>,<?php echo $row_nopember ?>,<?php echo $row_desember ?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>	 
    </body>
</html>