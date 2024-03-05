<?php
    include ('../config.php');
    if(isset($_POST['TK']))
    {
        $TK=$_POST['TK'];
        $sql = "SELECT * FROM taikhoang where TenTK='$TK'";
        if(mysqli_num_rows(mysqli_query($conn, $sql))>0)
            echo "Tài khoảng đã có người sử dụng";
        else
        echo 0;
    }
    else if(isset($_POST['Email']))
    {
        $EM=$_POST['Email'];
        $sql = "SELECT * FROM khachhang where Email='$EM'";
        if(mysqli_num_rows(mysqli_query($conn, $sql))>0)
        echo "Email đã có người sử dụng";
        else
        echo 0;
    }
    else if(isset($_POST['SDT']))
    {
        $SDT=$_POST['SDT'];
        $sql = "SELECT * FROM khachhang where SDT='$SDT'";
        if(mysqli_num_rows(mysqli_query($conn, $sql))>0)
        echo "Số điện thoại đã có người sử dụng";
        else
        echo 0;
    }
    else
    echo "Có lỗi khi truyền tham số check"
?>