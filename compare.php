<html>
<head>
<script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>
<script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.fint.js"></script>
<link rel="stylesheet" type="text/css" href="layout.css">
<title>Statistics</title>
</head>
<body background="light_blue.jpg">
<div id="block">
	<div id="header">
		<div class="text">
		<h1><b><font face="broadway" color=0099FF size=20>HEALTHCARE</b></font></h1>
		</div>
	</div>
</div>
<hr/>

<?php
include("fusioncharts.php");

$db1 = mysqli_connect('localhost','root','1234'); 
if (!$db1) { 
	die('Could not connect to MySQL: ' . mysqli_error()); 
} 

$er1 = mysqli_select_db($db1,"hospital");
if (!$er1) {
  echo "Error - Could not connect to comments1 database";
  exit;
}
$s = $_GET['s'];
$a = $_GET['a'];
$d = $_GET['d'];
$p=$_GET['p'];

$sql5="select Total.national_provider_id , Total.total_patients, Total_dead.total_Dead_patients, Total_dead.total_Dead_patients/Total.total_patients*100 as Mortality
from 
(SELECT p.national_provider_id, count(*) as total_dead_patients
FROM hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id
and d.DISCHARGE_STATUS ='2' and p.ADMITTING_DIAGNOSIS_CODE =$d and p.age=$a and p.sex=$s
group by p.national_provider_id) as Total_dead,
(SELECT p.national_provider_id, count(*) as total_patients
FROM hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id and p.ADMITTING_DIAGNOSIS_CODE =$d and p.age=$a and p.sex=$s
group by p.national_provider_id) as Total
group by Total.national_provider_id;";
		
echo '<font size="4" color="0099FF">';
$result5 = $db1->query($sql5);
     	if ($result5) {
        	$arrData = array(
        	    "chart" => array(
                  "caption" => "THE AVERAGE MORTALITY BASED ON NATONAL PROVIDER",
				  "subcaption" => "Value D/T (D-Deceased Patients, T-Total Patients)",
                  "paletteColors" => "#077a2",
                  "bgColor" => "#ffffff",
                  "borderAlpha"=> "20",
                  "canvasBorderAlpha"=> "0",
                  "usePlotGradientColor"=> "0",
                  "plotBorderAlpha"=> "10",
                  "showXAxisLine"=> "1",
                  "xAxisLineColor" => "#999999",
                  "showValues" => "1",
                  "divlineColor" => "#999999",
                  "divLineIsDashed" => "1",
                  "showAlternateHGridColor" => "0",
				  "xAxisName" => "National Providers",
				  "yAxisName" => "Mortality(%)",
				  "decimals" =>"2"
              	)
           	);

        	$arrData["data"] = array();

        	while($row = mysqli_fetch_array($result5)) {
           	array_push($arrData["data"], array(
              	"label" => $row["national_provider_id"],
              	"value" => $row["Mortality"],
				"displayValue" => $row["total_Dead_patients"]."/".$row["total_patients"]
              	)
           	);
        	}
        	$jsonEncodedData = json_encode($arrData);
        	$Mortality = new FusionCharts("column2D", "Mortality" , 950, 350, "chart-1", "json", $jsonEncodedData);
        	$Mortality->render();
		}

$sql6="select p.NATIONAL_PROVIDER_ID,count(p.patient_id) as total_patients, avg(d.LENGTH_OF_STAY) as Average_Length_of_stay
from hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id
and p.ADMITTING_DIAGNOSIS_CODE =$d and p.age=$a and p.sex=$s
group by p.NATIONAL_PROVIDER_ID;";
$result6 = $db1->query($sql6);
     	if ($result6) {
        	$arrData = array(
        	    "chart" => array(
                  "caption" => "THE AVERAGE LENGTH OF STAY",
				  "subcaption" => "Value T (Total Patients)",
                  "paletteColors" => "#077a2",
                  "bgColor" => "#ffffff",
                  "borderAlpha"=> "20",
                  "canvasBorderAlpha"=> "0",
                  "usePlotGradientColor"=> "0",
                  "plotBorderAlpha"=> "10",
                  "showXAxisLine"=> "1",
                  "xAxisLineColor" => "#999999",
                  "showValues" => "1",
                  "divlineColor" => "#99999",
                  "divLineIsDashed" => "1",
                  "showAlternateHGridColor" => "0",
				  "xAxisName" => "National Providers",
				  "yAxisName" => "Length of Stay (Days)",
				  "decimals" =>"2"
              	)
           	);

        	$arrData["data"] = array();

        	while($row = mysqli_fetch_array($result6)) {
           	array_push($arrData["data"], array(
              	"label" => $row["NATIONAL_PROVIDER_ID"],
              	"value" => $row["Average_Length_of_stay"],
				"displayValue" => $row["total_patients"]
              	)
           	);
        	}
        	$jsonEncodedData = json_encode($arrData);
        	$LOS = new FusionCharts("column2D", "LOS" , 950, 350, "chart-2", "json", $jsonEncodedData);
        	$LOS->render();
		}

$sql7="select p.NATIONAL_PROVIDER_ID, count(p.patient_id) as total_patients, avg(d.TOTAL_CHARGES) as average_charges
from hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id
and p.ADMITTING_DIAGNOSIS_CODE =$d and p.age=$a and p.sex=$s
group by p.NATIONAL_PROVIDER_ID;";
$result7 = $db1->query($sql7);
     	if ($result7) {
        	$arrData = array(
        	    "chart" => array(
                  "caption" => "THE AVERAGE TOTAL CHARGES BASED ON NATONAL PROVIDER",
				  "subcaption" => "Value T (Total Patients)",
                  "paletteColors" => "#077a2",
                  "bgColor" => "#ffffff",
                  "borderAlpha"=> "20",
                  "canvasBorderAlpha"=> "0",
                  "usePlotGradientColor"=> "0",
                  "plotBorderAlpha"=> "10",
                  "showXAxisLine"=> "1",
                  "xAxisLineColor" => "#999999",
                  "showValues" => "1",
                  "divlineColor" => "#999999",
                  "divLineIsDashed" => "1",
                  "showAlternateHGridColor" => "0",
				  "xAxisName" => "National Providers",
				  "yAxisName" => "Average Charges (USD)",
				  "numberPrefix" => "$",
				  "decimals" =>"2"
              	)
           	);

        	$arrData["data"] = array();

        	while($row = mysqli_fetch_array($result7)) {
           	array_push($arrData["data"], array(
              	"label" => $row["NATIONAL_PROVIDER_ID"],
              	"value" => $row["average_charges"],
				"displayValue" => $row["total_patients"]
              	)
           	);
        	}
        	$jsonEncodedData = json_encode($arrData);
        	$NationalP_AveCgr = new FusionCharts("column2D", "NationalP_AveCgr" , 950, 350, "chart-3", "json", $jsonEncodedData);
        	$NationalP_AveCgr->render();
		}

$sql8="select d.PROVIDER_CITY_NAME, count(p.patient_id) as total_patients, avg(d.TOTAL_CHARGES) as average_charges
from hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id
and p.ADMITTING_DIAGNOSIS_CODE =$d and p.age=$a and p.sex=$s
group by d.PROVIDER_CITY_NAME;";
$result8 = $db1->query($sql8);
     	if ($result8) {
        	$arrData = array(
        	    "chart" => array(
                  "caption" => "THE AVERAGE TOTAL CHARGES BASED ON PROVIDER CITY",
				  "subcaption" => "Value T (Total Patients)",
                  "paletteColors" => "#077a2",
                  "bgColor" => "#ffffff",
                  "borderAlpha"=> "20",
                  "canvasBorderAlpha"=> "0",
                  "usePlotGradientColor"=> "0",
                  "plotBorderAlpha"=> "10",
                  "showXAxisLine"=> "1",
                  "xAxisLineColor" => "#999999",
                  "showValues" => "1",
                  "divlineColor" => "#999999",
                  "divLineIsDashed" => "1",
                  "showAlternateHGridColor" => "0",
				  "xAxisName" => "City",
				  "yAxisName" => "Average Charges (USD)",
				  "numberPrefix" => "$",
				  "decimals" =>"2"
              	)
           	);

        	$arrData["data"] = array();

        	while($row = mysqli_fetch_array($result8)) {
           	array_push($arrData["data"], array(
              	"label" => $row["PROVIDER_CITY_NAME"],
              	"value" => $row["average_charges"],
				"displayValue" => $row["total_patients"]
              	)
           	);
        	}
        	$jsonEncodedData = json_encode($arrData);
        	$City_AveCgr = new FusionCharts("column2D", "City_AveCgr" , 950, 350, "chart-4", "json", $jsonEncodedData);
        	$City_AveCgr->render();
		}

mysqli_close($db1);

?>
<div style="width: 100%; overflow: hidden;">
<div style="width: 48%; float: left;" id="chart-1"></div>
<div style="width: 48%; float: right;" id="chart-2"></div>
</div>
<p> </p>
<div style="width: 100%; overflow: hidden;">
<div style="width: 48%; float: left;" id="chart-3"></div>
<div style="width: 48%; float: right;" id="chart-4"></div>
</div>
</body>
</html>
