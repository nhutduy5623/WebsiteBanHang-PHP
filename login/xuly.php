<?php
    session_start();
    include ('../config.php');
    if($_POST['action']=="DN")
    {
        $TK=$_POST['TK'];
        $MK=$_POST['MK'];
        $sql = mysqli_query($conn, "SELECT * FROM taikhoang where TenTK='".$TK."' AND MatKhau='".$MK."' LIMIT 1");
        $data_TK = mysqli_fetch_array($sql);
        $count = mysqli_num_rows($sql);
        if($count>0)
        {
            $_SESSION['TK']=$TK;
            echo $data_TK['MaLoai'];            
        }
        else 
        {
            echo 0;
        }

    }
    else if($_POST['action']=="DK")
    {
        //Tạo mã tk
        $sqlDEMTK = mysqli_query($conn, "SELECT * FROM taikhoang");
        $sqlTK = mysqli_query($conn, "SELECT max(MaTK) as MaxMATK FROM taikhoang");
        $data_TK = mysqli_fetch_array($sqlTK);
        if(mysqli_num_rows($sqlDEMTK)==0)
        $MATK=1;
        else
        $MATK = $data_TK['MaxMATK']+1;


        $TK=$_POST['TK'];
        $MK=$_POST['MK'];
        $Email =$_POST['Email'];
        $SDT = $_POST['SDT'];
        // $sqlTK = mysqli_query($conn, "SELECT * FROM taikhoang where TenTK='".$TK."'LIMIT 1");
        // $count = mysqli_num_rows($sqlTK);
        // if($count==0)
        // {
            //tạo TK
            $sqlISTK = "INSERT INTO `taikhoang`(`MaTK`, `TenTK`, `MatKhau`, `MaLoai`, `TinhTrang`)
                                        VALUES ($MATK,'$TK','$MK',2,1)";
            mysqli_query($conn, $sqlISTK);
            //Thêm thông tin KH
            $sqlISKH = "INSERT INTO `khachhang`(`MaKH`, `TenUser`, `DiaChi`, `SDT`, `Email`) 
                                        VALUES ($MATK,'$TK','','$SDT','$Email')";
            mysqli_query($conn, $sqlISKH);
        // }
        // else
        //     echo 0;         
    }
?>