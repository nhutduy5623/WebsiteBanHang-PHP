<?php
    include '../../config.php';
    $tool = $_POST['tool'];
    if($tool=='t')
    {
        $MaSP = $_POST['MaSP'];
        $SP = $_POST['txt_TenSP'];
        $HA = $_FILES['file_HA']['name'];
        $HA_t = $HA;
        $HA_temp = $_FILES['file_HA']['tmp_name'];
        if($HA!='')
        {
            $extension = explode(".",$HA);
            $file_extension = end($extension);
            $allowed_type = array("jpg", "jpge", "png", "gif");
            if(in_array($file_extension,$allowed_type))
                move_uploaded_file($HA_temp,'../../img/'.$HA);
        }
        $TL = $_POST['select_loaisp'];
        $BH = $_POST['select_GBH'];
        $Gia = $_POST['txt_GiaSP'];
        $SL = $_POST['txt_SL'];
        $TT = $_POST['select_tinhtrang'];   
        mysqli_query($conn, "INSERT INTO `sanpham`(`MaSP`, `TenSP`, `HinhAnh`, `MaLoai`, `TinhTrang`, `MaGBH`, `SoLuong`, `GiaSP`) 
                                        VALUES ($MaSP,'$SP','$HA',$TL,$TT,$BH,$SL,$Gia)");
    
    }
    else if($tool=='s')
    {
        $MaSP = $_POST['MaSP'];
        $SP = $_POST['txt_TenSP'];
        $HA = $_FILES['file_HA']['name'];
        $HA_t = $HA;
        $HA_temp = $_FILES['file_HA']['tmp_name'];
        if($HA!='')
        {
            $extension = explode(".",$HA);
            $file_extension = end($extension);
            $allowed_type = array("jpg", "jpge", "png", "gif");
            if(in_array($file_extension,$allowed_type))
                move_uploaded_file($HA_temp,'../../img/'.$HA);
        }
        $TL = $_POST['select_loaisp'];
        $BH = $_POST['select_GBH'];
        $Gia = $_POST['txt_GiaSP'];
        $SL = $_POST['txt_SL'];
        $TT = $_POST['select_tinhtrang'];    
        if($HA!='')    
        mysqli_query($conn, "UPDATE `sanpham` SET `TenSP`='$SP',`HinhAnh`='$HA',`MaLoai`=$TL,`TinhTrang`=$TT,`MaGBH`=$BH, `GiaSP`=$Gia, `SoLuong`=$SL WHERE `MaSP`=$MaSP");
        else
        mysqli_query($conn, "UPDATE `sanpham` SET `TenSP`='$SP',`MaLoai`=$TL,`TinhTrang`=$TT,`MaGBH`=$BH, `GiaSP`=$Gia, `SoLuong`=$SL WHERE `MaSP`=$MaSP");
    }
    else if($tool=='GetTT')
    {
        $MaSP=$_POST['MaSP'];
        $dataTTSP = mysqli_query($conn, "SELECT *FROM sanpham sp, goibaohanh bh, loaisp tl
        where sp.MaGBH=bh.MaGBH and sp.MaLoai=tl.MaLoai and sp.MaSP=$MaSP");
        $rowTTSP = mysqli_fetch_array($dataTTSP);
        echo $rowTTSP['TenSP']."+".$rowTTSP['HinhAnh']."+".$rowTTSP['MaLoai']."+".$rowTTSP['MaGBH']."+".$rowTTSP['GiaSP']."+".$rowTTSP['SoLuong']."+".$rowTTSP['TinhTrang'];
    }   
    else
    {
        $MaSP = $_POST['MaSP'];
        mysqli_query($conn, "UPDATE `sanpham` SET `TinhTrang`=0 WHERE `MaSP`=$MaSP");
        $sqlDElSP ="DELETE FROM `sanpham` WHERE MaSP=$MaSP";
            mysqli_query($conn,$sqlDElSP); 
    } 
?>