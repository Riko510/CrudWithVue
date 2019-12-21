<?php
header('Content-Type: application/json; charset=UTF-8');
require_once('./config.php');

if(isset($_POST['category']) && $_SERVER['REQUEST_METHOD']=='POST') {
    $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWD,DB_NAME);
    if (!$conn){
        echo 'It can\'t connect to Database';
    }else{
        $sql = '';
        if($_POST['category']==='add' && !empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['email'])&& !empty($_POST['phone'])) {
            $sql = "INSERT INTO 3A (id, name, email, phone) VALUES ({$_POST['id']}, '{$_POST['name']}', '{$_POST['email']}', '{$_POST['phone']}')";
            $data = mysqli_query($conn, $sql);
            if (!$data) {
                echo '無法上傳資料，ID 重複使用';
            }else {
                echo true;
            }
            mysqli_close($conn);

        }elseif($_POST['category']==='modify' && !empty($_POST['name']) && !empty($_POST['email'])&& !empty($_POST['phone'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $sql = "UPDATE 3A SET name = '{$name}', email='{$email}', phone='{$phone}' WHERE id = {$id} ";
            $data = mysqli_query($conn, $sql);
            if (!$data) {
                echo '無法更新資料';
            }else {
                echo true;
            }
            mysqli_close($conn);

        }elseif($_POST['category']==='delete' && !empty($_POST['id'])) {
            $sql = "DELETE FROM 3A WHERE id = {$_POST['id']}";
            $data = mysqli_query($conn, $sql);
            if (!$data) {
                echo 'It can\'t delete data from Database';
            }else {
                echo true;
            }
            mysqli_close($conn);
        }else{
            echo '欄位不可為空值';
        }
    }
}else{
    echo '系統故障，請重新整理';
}
?>