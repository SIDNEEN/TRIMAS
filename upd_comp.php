<?php
require('conn_mysql.php');
$page = $_REQUEST['page'];
$companyID = $_REQUEST['companyID'];
$companyName = $_REQUEST['companyName'];
$companyAddress = $_REQUEST['companyAddress'];
$companyTambol= $_POST["district"];
$companyAmpo= $_POST["amphoe"];
$companyChangwat= $_POST["province"];
$companyZipCode= $_POST["zipcode"];
$companyPhonet = $_REQUEST["companyPhonet"];
$note=$_REQUEST["note"];
$rating=$_REQUEST["rating"];
/* Performing SQL query */
$sql = "UPDATE company  set companyName = ?,companyAddress = ? ,companyTambol= ? ,companyAmpo= ? ,companyChangwat= ?,companyZipCode= ? ,companyPhonet= ?,note=? ,rating=? where companyID = ?;";



/* Prepare statement */
$stmt = $conn->prepare($sql);
if($stmt === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->errno . ' ' . $conn->error, E_USER_ERROR);
}

/* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
$stmt->bind_param("ssssssssii", $companyName,$companyAddress,$companyTambol,$companyAmpo,$companyChangwat,$companyZipCode,$companyPhonet,$note,$rating,$companyID);

/* Execute statement */
if($stmt->execute()){
    echo " record updated!";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
} else {
    echo " Error : ",$conn->error;
}

// Close the prepared statement.
$stmt->close();
$conn->close();

?>
