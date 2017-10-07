<html>
<head>
<link rel="stylesheet" type="text/css" href="layout.css">
<title>Records</title>
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


$db = mysqli_connect('localhost','root','1234'); 
if (!$db) { 
	die('Could not connect to MySQL: ' . mysqli_error()); 
} 

$er = mysqli_select_db($db,"hospital");
if (!$er) {
  echo "Error - Could not connect to comments1 database";
  exit;
}



$s=$_POST['sex'];
$a=$_POST['age'];
$d=$_POST['ADMITTING_DIAGNOSIS_CODE'];
$p=$_POST['procedure_code'];

if($a==""&$s==""&$d==""&$p=="")
{
echo'Please Go back and enter the patient details';
}
else
{
$sql="select p.PATIENT_ID, p.NATIONAL_PROVIDER_ID, d.DISCHARGE_STATUS, d.STAY_INDICATOR, d.LENGTH_OF_STAY, d.SURGERY_INDICATOR, d.TOTAL_CHARGES, d.PROVIDER_CITY_NAME
from hospital.patients as p, hospital.diagnosis as d
where  p.patient_id= d.patient_id
and p.ADMITTING_DIAGNOSIS_CODE =$d
and p.AGE =$a
and p.SEX =$s;";
$query = mysqli_query($db, $sql);



if(mysqli_num_rows($query)!=0)
{ 
echo '<font size="5" color="0099FF">'; 
echo "Patients with Diagnosis code:$d , Age:$a and Sex:$s";
echo'<form action="connectivity.php">
    <input type="hidden" name="s" value="'. $_POST['sex'] .'" />
    <input type="hidden" name="a" value="'. $_POST['age'] .'"/>
<input type="hidden" name="d" value="'. $_POST['ADMITTING_DIAGNOSIS_CODE'] .'"/>
<input type="hidden" name="p" value="'. $_POST['procedure_code'] .'"/>
  <center><button type="submit" id="btn">Statistics</button></center>
</form>';
echo'<table style= "width:80%; padding: 14px 22px;
    border: 0;" align="center" border="1 px solid black" border-spacing="2px" border-collapse="collapse" class="gridtable">
       
	<th>Patient ID</th>
<th>National Provider ID</th>
<th>Discharge Status</th>
<th>Duration of Stay</th>
<th>Length Of Stay</th>
<th>Surgery</th>
<th>Total Charges </th>
<th>Provider City Name</th>

        ';
while($res=mysqli_fetch_array($query))
{
	if ($res['DISCHARGE_STATUS'] == 2)
  $res['DISCHARGE_STATUS'] = "Deceased";
	if ($res['DISCHARGE_STATUS'] == 1)
  $res['DISCHARGE_STATUS'] = "Alive";
	if ($res['STAY_INDICATOR'] == 'L')
  $res['STAY_INDICATOR'] = "Long Stay";
	if ($res['STAY_INDICATOR'] == 'S')
  $res['STAY_INDICATOR'] = "Short Stay";
	


          echo '<tr>


<td>'.$res['PATIENT_ID'].'</td>
<td>'.$res['NATIONAL_PROVIDER_ID'].'</td>
<td>'.$res['DISCHARGE_STATUS'].'</td>
<td>'.$res['STAY_INDICATOR'].'</td>
<td>'.$res['LENGTH_OF_STAY'].' days</td>
<td>'.$res['SURGERY_INDICATOR'].'</td>
<td>'.$res['TOTAL_CHARGES'].'</td>
<td>'.$res['PROVIDER_CITY_NAME'].'</td>

            </tr>';
}
    echo'</table>';


}
else
{
echo "No Result";
}
}



mysqli_close($db);
?>


</body>
</html>
 