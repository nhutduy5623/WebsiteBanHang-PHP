<?php
    include '../../config.php';
    $tool = $_GET['tool'];
    if($tool=='t')
    {
        $MaLoai = $_GET['MaLoai'];
        $TenLoai = $_GET['TenLoai'];
        $sqlISDM = "INSERT INTO `loaisp`(`MaLoai`, `TenLoai`)
                                        VALUES ($MaLoai,'$TenLoai')";
        mysqli_query($conn,$sqlISDM);
    }
    else if($tool=='s')
    {
        $MaLoai = $_GET['MaLoai'];
        $TenLoai = $_GET['TenLoai'];
        $sqlUPTK = "UPDATE `loaisp` SET `TenLoai`='$TenLoai'WHERE MaLoai=$MaLoai";
        mysqli_query($conn,$sqlUPDM);
            $sqlDElTTDM ="DELETE FROM `sanpham` WHERE MaLoai=$MaLoai";
            mysqli_query($conn,$sqlDElTTDM);
            $sqlISDM = "UPDATE `sanpham` SET `TenLoai`='$TenLoai' WHERE MaLoai=$MaLoai";
            if($TL==2||$TL==3)
            {
                if($TL==2)
                {
                    $sqlISKH = "INSERT INTO `sanpham`(`MaSP`, `TenSP`, `HinhAnh`, `MaLoai`, `TinhTrang`,`MaGBH`,`SoLuong`,`GiaSP`) 
                                        VALUES ($MaSP,'$TenSP','$HA','$Maloai','$TT','$MaGBH','$SL','$GiaSP')";
                    mysqli_query($conn, $sqlISSP);
                }

            }

        
    }
    else if($tool=='GetTT')
    {
        $MaLoai = $_GET['MaLoai'];
        $dataTTDM = mysqli_query($conn, "SELECT * FROM loaisp where MaLoai=$MaLoai");
        $rowTTDM = mysqli_fetch_array($dataTTDM);
        echo $rowTTDM['TenLoai'];
    }   
    else
    {
        $MaLoai = $_GET['MaLoai'];
        $sqlDElTTDM ="UPDATE `sanpham` SET `MaLoai`=1 WHERE MaLoai=$MaLoai";
            mysqli_query($conn,$sqlDElTTDM);
        $sqlDElDM ="DELETE FROM `loaisp` WHERE MaLoai=$MaLoai";
            mysqli_query($conn,$sqlDElDM);    
    } 
?>