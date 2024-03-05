<?php
    include '../config.php';
    $tool = $_POST['tool'];
    if($tool == 'getTTSP')
    {
        $MaSP = $_POST['MaSP'];
        $dataThisSP = mysqli_query($conn, "SELECT * FROM sanpham where MaSP=$MaSP");        
        $rowSP = mysqli_fetch_array($dataThisSP);
        $dataBHSP = mysqli_query($conn, "SELECT * FROM goibaohanh where MaGBH=".$rowSP['MaGBH']."");
        $rowGBH = mysqli_fetch_array($dataBHSP);
        echo $rowSP['TenSP']."+".$rowSP['HinhAnh']."+".$rowSP['GiaSP']."+".$rowGBH['PhuongThuc']."+".$rowGBH['MaGBH']."+".$rowSP['SoLuong'];
    }
?>