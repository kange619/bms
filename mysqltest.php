<?php

/*
    echo "Mysql connection test<br />";
    $db = mysqli_connect("localhost", "root", "0000", "test");


    if($db) {
        echo "connect success<br />";
    } else {
        echo "connect failed<br />";
    }
    $result = mysqli_query($db, 'SELECT VERSION() as VERSION');
    $data = mysqli_fetch_assoc($result);
    echo $data['VERSION'];

    $sql = "INSERT INTO test_table (col1, col2) VALUES ('1', 'test data')";
     
    if ($db->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "
    " . $conn->error;
    }
*/

$servername = "localhost"; // 데이터베이스 호스트
$username = "root"; // 데이터베이스 ID (수정요망)
$password = "0000"; // 데이터베이스 PW (수정요망)
$dbname = "test"; //데이터베이스명 (수정요망)
 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn){
    echo "connect success<br />";
} else{
    die("Connection failed: " . $conn->connect_error);
}
 
$sql = "INSERT INTO test_table (col1, col2) VALUES ('1', 'test data')";
 
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "
" . $conn->error;
}
 
$conn->close();

?>

