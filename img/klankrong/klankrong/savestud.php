<html>
<head>
<title>Insert</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
</head>
<body>>
<?php
	$objConnect = mysql_connect("localhost","root","") or die("Error Connect to Database");
	$objDB = mysql_select_db("klankrong");
	mysql_query("SET NAMES UTF8");

	$strSQL = "INSERT INTO student (studcode,studname,studnumber,email,compname,bossname,position,
    description,address,tambol,ampo,changwat,zipcode,compnumber,
    faxnumber,website,department,workdetail,pesoncont,telephone) 
		VALUES ('".$_POST["studcode"]."','".$_POST["studname"]."','".$_POST["studnumber"]."',
        '".$_POST["email"]."','".$_POST["compname"]."','".$_POST["bossname"]."',
        '".$_POST["position"]."','".$_POST["description"]."','".$_POST["address"]."',
        '".$_POST["tambol"]."','".$_POST["ampo"]."','".$_POST["changwat"]."',
        '".$_POST["zipcode"]."','".$_POST["compnumber"]."','".$_POST["faxnumber"]."',
        '".$_POST["website"]."','".$_POST["department"]."','".$_POST["workdetail"]."',
        '".$_POST["pesoncont"]."','".$_POST["telephone"]."')";

   $objQuery = mysql_query($strSQL);
	if($objQuery) {
		echo "Record add successfully";
	}

	mysql_close($objConnect);
?>
</body>
</html>

