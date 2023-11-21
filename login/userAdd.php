<?php
include '../tools/connection.php';

if (isset($_POST['save'])) {
    $userNama = $_POST['userNama'];
    $userPassword = $_POST['userPassword'];

    $query = $conn->query("INSERT INTO tb_user(user_nama,user_password)VALUES('$userNama','$userPassword')");
    if ($query == True) {
        echo "<script>
                alert('Data Berhasil Disimpan');
                window.location='login.php'
                </script>";
    } else {
        die('MySQL error : ' . mysqli_errno($conn));
    }
}
