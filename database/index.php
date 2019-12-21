<?php
require_once('./config.php');

$rows = array();
$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWD,DB_NAME);

if (!$conn){
    die('It can\'t connect to server '.mysqli_connect_error());
}

$sql = "SELECT * FROM 3A";
$data = mysqli_query($conn, $sql);

if (!$data){
    die('It can\'t get data from server');
}

while($result  = mysqli_fetch_array($data,MYSQLI_ASSOC)) {
    $rows[] = $result;
}

echo json_encode($rows);

mysqli_close($conn);
?>