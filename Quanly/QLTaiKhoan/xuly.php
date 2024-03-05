<?php
    include '../../config.php';
    $tool = $_GET['tool'];
    if($tool=='t')
    {
        $MaTK = $_GET['MaTK'];
        $TK = $_GET['TK'];
        $MK = $_GET['MK'];
        $UN = $_GET['UN'];
        $EM = $_GET['EM'];
        $SDT = $_GET['SDT'];
        $DC = $_GET['DiaChi'];
        $TL = $_GET['TL'];
        $TT = $_GET['TT'];
        $sqlISTK = "INSERT INTO `taikhoang`(`MaTK`, `TenTK`, `MatKhau`, `MaLoai`, `TinhTrang`)
                                        VALUES ($MaTK,'$TK','$MK',$TL,$TT)";
        mysqli_query($conn, $sqlISTK);
            //Thêm thông tin KH
            if($TL==2)
            {
                $sqlISKH = "INSERT INTO `khachhang`(`MaKH`, `TenUser`, `DiaChi`, `SDT`, `Email`) 
                                        VALUES ($MaTK,'$UN','$DC','$SDT','$EM')";
                mysqli_query($conn, $sqlISKH);
            } else if($TL==3) {
                $sqlISNV = "INSERT INTO `nhanvien`(`MaNV`, `TenUser`, `DiaChi`, `SDT`, `Email`) 
                                        VALUES ($MaTK,'$UN','$DC','$SDT','$EM')";
                mysqli_query($conn, $sqlISNV);
            }

            //Thêm Nhân Viên

    }
    else if($tool=='s')
    {
        $MaTK = $_GET['MaTK'];
        $TK = $_GET['TK'];
        $MK = $_GET['MK'];
        $UN = $_GET['UN'];
        $EM = $_GET['EM'];
        $SDT = $_GET['SDT'];
        $DC = $_GET['DiaChi'];
        $TL = $_GET['TL'];
        $TT = $_GET['TT'];
        $sqlUPTK = "UPDATE `taikhoang` SET `TenTK`='$TK',`MatKhau`='$MK',`MaLoai`=$TL,`TinhTrang`=$TT WHERE MaTK=$MaTK";
        mysqli_query($conn,$sqlUPTK);
            $sqlISKH = "UPDATE `khachhang` SET `TenUser`='$UN',`DiaChi`='$DC',`SDT`='$SDT',`Email`='$EM' WHERE MaKH=$MaTK";
            if($TL==2||$TL==3)
            {
                if($TL==2)
                {
                    $sqlISKH = "UPDATE `khachhang` SET `TenUser`='$UN',`DiaChi`='$DC',`SDT`='$SDT',`Email`='$EM' WHERE MaKH=$MaTK";
                    mysqli_query($conn, $sqlISKH);
                }
                else
                {
                    $sqlISKH = "UPDATE `khachhang` SET `TenUser`='$UN',`DiaChi`='$DC',`SDT`='$SDT',`Email`='$EM' WHERE MaNV=$MaNV";;
                    mysqli_query($conn, $sqlISKH);
                }

            }

        
    }
    else if($tool=='GetTT')
    {
        $MaTK = $_GET['MaTK'];
        $dataTTTK = mysqli_query($conn, "SELECT * FROM taikhoang, khachhang where MaKH=MaTK and MaTK=$MaTK");
        if(mysqli_num_rows($dataTTTK)<1)
        $dataTTTK = mysqli_query($conn, "SELECT * FROM taikhoang, nhanvien where MaNV=MaTK and MaTK=".$_GET('MaTK')."");
        $rowTTTK = mysqli_fetch_array($dataTTTK);
        echo $rowTTTK['TenTK']."+".$rowTTTK['MatKhau']."+".$rowTTTK['TenUser']."+".$rowTTTK['Email']."+".$rowTTTK['SDT']."+".$rowTTTK['DiaChi']."+".$rowTTTK['MaLoai']."+".$rowTTTK['TinhTrang'];
    }   
    else
    {
        $MaTK = $_GET['MaTK'];
        $sqlDElTTTK ="DELETE FROM `khachhang` WHERE MaKH=$MaTK";
            mysqli_query($conn,$sqlDElTTTK);
        $sqlDElTTTK ="DELETE FROM `nhanvien` WHERE MaNV=$MaTK";
            mysqli_query($conn,$sqlDElTTTK);
        $sqlDElTK ="DELETE FROM `taikhoang` WHERE MaTK=$MaTK";
            mysqli_query($conn,$sqlDElTK);    
    } 
?>