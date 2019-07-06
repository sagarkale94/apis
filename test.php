<?php
$servername = "remotemysql.com";
$username = "chwNTPy6kf";
$password = "2w7YTfLFEG";
$db = "chwNTPy6kf";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$cmd = $_REQUEST['cmd'];

if($cmd == "mybalance"){
	mybalance($conn);
}


function mybalance($conn){

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$sql = "SELECT lm.balance FROM login_master AS lm WHERE lm.username = '$username' AND lm.password = '$password'  AND lm.is_active = 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$arr = array('status' => true, 'balance' => $row['balance']);
   	echo json_encode($arr);
} else {
	$arr = array('status' => false, 'message' => 'Invalid credentials..!!');
    echo json_encode($arr);
}

}

$conn->close();
?>