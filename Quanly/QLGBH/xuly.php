<?php
    include '../../config.php';
    $tool = $_GET['tool'];
    if($tool=='t')
    {
        $MaGBH = $_GET['MaGBH'];
        $PhuongThuc = $_GET['PhuongThuc'];
        $sqlISGBH = "INSERT INTO `goibaohanh`(`MaGBH`, `PhuongThuc`)
                                        VALUES ($MaGBH,'$PhuongThuc')";
        mysqli_query($conn,$sqlISGBH);
    }
    else if($tool=='s')
    {
        $MaGBH = $_GET['MaGBH'];
        $PhuongThuc = $_GET['PhuongThuc'];
        $sqlUPGBH = "UPDATE `goibaohanh` SET `PhuongThuc`='$PhuongThuc'WHERE MaGBH=$MaGBH";
        mysqli_query($conn,$sqlUPGBH);

        
    }
    else if($tool=='GetTT')
    {
        $MaGBH = $_GET['MaGBH'];
        $dataTTGBH = mysqli_query($conn, "SELECT * FROM goibaohanh where MaGBH=$MaGBH");
        $rowTTGBH = mysqli_fetch_array($dataTTGBH);
        echo $rowTTGBH['PhuongThuc'];
    }   
    else
    {
        $MaGBH = $_GET['MaGBH'];
        $sqlDElTTGBH ="UPDATE `sanpham` SET `MaGBH`=1 WHERE MaGBH=$MaGBH";
            mysqli_query($conn,$sqlDElTTGBH);
        $sqlDElGBH ="DELETE FROM `goibaohanh` WHERE MaGBH=$MaGBH";
            mysqli_query($conn,$sqlDElGBH);    
    } 
?>