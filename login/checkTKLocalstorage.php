<?php
    include '../config.php';
    $TK="";
    $MK="";
    $LoaiTK="";
    $TK = $_POST['TK'];
    $MK = $_POST['MK'];
    $LoaiTK = $_POST['LoaiTK'];
    $dataTK = mysqli_query($conn, "SELECT * FROM taikhoang where TenTK='".$TK."' AND MatKhau='".$MK."' and MaLoai=$LoaiTK LIMIT 1");
    if(mysqli_num_rows($dataTK)!=0) {
        echo 1;
    } else
    echo 0;
?>