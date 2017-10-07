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


$sql1="select avg(d.TOTAL_CHARGES) as average_charges
from hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id
and p.ADMITTING_DIAGNOSIS_CODE =$d and p.age=$a and p.sex=$s;";
$query1 = mysqli_query($db1, $sql1);

$sql2="select avg(d.LENGTH_OF_STAY) as Average_Length_of_stay
from hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id
and p.ADMITTING_DIAGNOSIS_CODE =$d and p.age=$a and p.sex=$s;";
$query2 = mysqli_query($db1, $sql2);

$sql3="Select total_Dead_patients/total_patients*100  as Average_Mortality from (SELECT count(*) as total_dead_patients
FROM hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id
and d.DISCHARGE_STATUS ='2' and p.ADMITTING_DIAGNOSIS_CODE =$d and p.age=$a and p.sex=$s) as total_Dead_patients, (SELECT count(*) as total_patients
FROM hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id and p.ADMITTING_DIAGNOSIS_CODE =$d and p.age=$a and p.sex=$s) as total_patients;";
$query3 = mysqli_query($db1, $sql3);
$result3 = $db1->query($sql3);

$sql4="select count(patient_id) as Patients_per_procedure from
hospital.procedure_codes
where procedure_code =$p
group by procedure_code;";
$query4 = mysqli_query($db1, $sql4);

$sql5="Select Surgery/total_patients*100  as chances_of_surgery from (SELECT count(*) as Surgery
FROM hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id
and d.SURGERY_INDICATOR ='1' and p.ADMITTING_DIAGNOSIS_CODE =$d and p.age=$a and p.sex=$s) as Surgery, (SELECT count(*) as total_patients
FROM hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id and p.ADMITTING_DIAGNOSIS_CODE =$d and p.age=$a and p.sex=$s) as total_patients;";
$query5 = mysqli_query($db1, $sql5);
$result5 = $db1->query($sql5);

$sql6="Select Long_Stay/total_patients*100 as chances_of_long_stay, 100-(Long_Stay/total_patients*100) as chances_of_short_stay from (SELECT count(*) as Long_Stay
FROM hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id
and d.stay_indicator ='L' and p.ADMITTING_DIAGNOSIS_CODE =$d and p.age=$a and p.sex=$s) as Long_Stay, (SELECT count(*) as total_patients
FROM hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id and p.ADMITTING_DIAGNOSIS_CODE =$d and p.age=$a and p.sex=$s) as total_patients;";
$query6 = mysqli_query($db1, $sql6);
$result6 = $db1->query($sql6);

echo'<table style= "padding: 14px 22px;
    border: 0;" align="CENTER" border="1 px solid black" border-spacing="2px" border-collapse="collapse" class="gridtable">
       
	
<th>Statistics</th>
<th>Findings</th>
        ';
while($res1=mysqli_fetch_array($query1))
{
          echo '<tr>
<td>Average Total Charges</td>
<td>$'.$res1['average_charges'].'</td>
            </tr>';
}

while($res1=mysqli_fetch_array($query2))
{
          echo '<tr>
<td>Average Length of Stay</td>
<td>'.$res1['Average_Length_of_stay'].' days</td>
            </tr>';
}


while($res1=mysqli_fetch_array($query4))
{
          echo '<tr>
<td>Patients per Procedure</td>
<td>'.$res1['Patients_per_procedure'].'</td>
            </tr>';
}

		echo'</table>';
		
echo'<form action="compare.php">
    <input type="hidden" name="s" value="'. $_GET['s'] .'"/>
    <input type="hidden" name="a" value="'. $_GET['a'] .'"/>
<input type="hidden" name="d" value="'. $_GET['d'] .'"/>
<input type="hidden" name="p" value="'. $_GET['p'] .'"/>
    <center><button type="submit" id="btn">Compare Health Providers</button></center>
</form>';

		
		while($row = mysqli_fetch_array($result3)) {
		$Mortality = new FusionCharts("angulargauge", "Mortality" , 600, 300, "chart-1", "json",
            '{
    "chart": {
        "caption": "Chances of Mortality (%)",
        "lowerLimit": "0",
        "upperLimit": "100",
        "lowerLimitDisplay": "0",
        "upperLimitDisplay": "100",
        "showValue": "1",
        "valueBelowPivot": "1",
        "theme": "fint"
    },
    "colorRange": {
        "color": [
            {
                "minValue": "0",
                "maxValue": "50",
                "code": "#6baa01"
            },
            {
                "minValue": "50",
                "maxValue": "75",
                "code": "#f8bd19"
            },
            {
                "minValue": "75",
                "maxValue": "100",
                "code": "#e44a00"
            }
        ]
    },
    "dials": {
        "dial": [
            {
                "value": '.$row["Average_Mortality"].'
            }
        ]
    }
}'
    );
	}
     	$Mortality->render();
		

		
		while($row = mysqli_fetch_array($result5)) {
		$Surgery = new FusionCharts("angulargauge", "Surgery" , 600, 300, "chart-2", "json",
            '{
    "chart": {
        "caption": "Chances of Surgery (%)",
        "lowerLimit": "0",
        "upperLimit": "100",
        "lowerLimitDisplay": "0",
        "upperLimitDisplay": "100",
        "showValue": "1",
        "valueBelowPivot": "1",
        "theme": "fint"
    },
    "colorRange": {
        "color": [
            {
                "minValue": "0",
                "maxValue": "50",
                "code": "#6baa01"
            },
            {
                "minValue": "50",
                "maxValue": "75",
                "code": "#f8bd19"
            },
            {
                "minValue": "75",
                "maxValue": "100",
                "code": "#e44a00"
            }
        ]
    },
    "dials": {
        "dial": [
            {
                "value": '.$row["chances_of_surgery"].'
            }
        ]
    }
}'
    );
	}
     	$Surgery->render();
		
		
		while($row = mysqli_fetch_array($result6)) {
		$LongStay = new FusionCharts("angulargauge", "LongStay" , 600, 300, "chart-3", "json",
            '{
    "chart": {
        "caption": "Chances of Long Stay (%)",
        "lowerLimit": "0",
        "upperLimit": "100",
        "lowerLimitDisplay": "0",
        "upperLimitDisplay": "100",
        "showValue": "1",
        "valueBelowPivot": "1",
        "theme": "fint"
    },
    "colorRange": {
        "color": [
            {
                "minValue": "0",
                "maxValue": "50",
                "code": "#6baa01"
            },
            {
                "minValue": "50",
                "maxValue": "75",
                "code": "#f8bd19"
            },
            {
                "minValue": "75",
                "maxValue": "100",
                "code": "#e44a00"
            }
        ]
    },
    "dials": {
        "dial": [
            {
                "value": '.$row["chances_of_long_stay"].'
            }
        ]
    }
}'
    );
	}
     	$LongStay->render();
		
mysqli_close($db1);

?>
<div style="width: 100%; overflow: hidden;">
<div style="width: 33%; float: left;" id="chart-1"></div>
<div style="width: 33%; float: left;" id="chart-2"></div>
<div style="width: 33%; float: left;" id="chart-3"></div>
</div>

</body>
</html>