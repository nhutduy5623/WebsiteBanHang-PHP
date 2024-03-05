<?php
    include '../config.php';
    session_start();
    if($_POST['action']=="Themdonhang")
    {
        $TK = $_POST['TK'];
        $TT = $_POST['TT'];
        $SDTGH = $_POST['SDTGH'];
        $DCGH = $_POST['DCGH'];
        $t=0;
        $Flag_SL=0;
        foreach($_SESSION['giohang'] as $rowGH)
        {
            if(($rowGH['TK']==$TK))
            {
                $dataSP = mysqli_query($conn, "SELECT * FROM sanpham where MaSP = ".$rowGH['MaSP']."");
                $rowSP = mysqli_fetch_array($dataSP);
               
                if($rowSP['SoLuong']<$rowGH['soLuong'])
                {
                    $Flag_SL=1;
                    echo "<script>alert('Số lượng của sản phẩm ".$rowSP['TenSP']." Không phù hợp')</script>";
                }
                
            }
        }
        if($Flag_SL==0)
        {
            echo '1';
            if(isset($_SESSION['giohang']) && is_array($_SESSION['giohang'])){
                foreach($_SESSION['giohang'] as $rowGH)
                {
                    if($rowGH['TK']==$TK)
                    {
                        
                        if($t==0)
                        {
                                //Lấy tất cả thông tin tạo đơn hàng
                            //Lấy mã KH
                            $dataTK = mysqli_query($conn, "SELECT MaTK FROM taikhoang where TenTK='$TK'");
                            $rowTK = mysqli_fetch_array($dataTK);
                            $dataKH = mysqli_query($conn, "SELECT MaKH FROM khachhang where MaKH=".$rowTK['MaTK']."");
                            $rowKH = mysqli_fetch_array($dataKH);
                            //Tạo mã đơn hàng
                            $dataDH=mysqli_query($conn, "SELECT * from donhang");
                            if(mysqli_num_rows($dataDH)==0)
                                $MaDH=1;
                            else {
                                $dataMaxDH=mysqli_query($conn, "SELECT max(MaDH) MaxMADH from donhang");
                                $rowMaxDH=mysqli_fetch_array($dataMaxDH);
                                $MaDH = $rowMaxDH['MaxMADH']+1;
                            }
                            
                        //Tạo Đơn Hàng
                            $creDH = mysqli_query($conn, "INSERT INTO `donhang`(`MaDH`, `NgayDH`, `NgayGH`, `MaKH`, `MaNVXL`, `TongTien`, `TinhTrang`, `SDTNhanHang`, `DCNhanHang`) 
                                                            VALUES ($MaDH,CURRENT_DATE,'00-00-0000',".$rowKH['MaKH'].",0,$TT,0,$SDTGH,'$DCGH')");
                            $t=1;    
                        }
                        
                        //Tạo chi tiết SP
                        //Tạo phiếu bảo hành
                            for($i=0; $i<$rowGH['soLuong']; $i++)
                            {
                                 //Tạo mã seriSP
                                $dataCTSP=mysqli_query($conn, "SELECT * from chitietsp");
                                if(mysqli_num_rows($dataCTSP)==0)
                                    $Seri=1;
                                else {
                                    $dataMaxSeriSP=mysqli_query($conn, "SELECT max(SeriSP) MaxSeriSP from chitietsp");
                                    $rowMaxSeriSP=mysqli_fetch_array($dataMaxSeriSP);
                                    $Seri = $rowMaxSeriSP['MaxSeriSP']+1;
                                }
                                $creCTSP = mysqli_query($conn, "INSERT INTO `chitietsp`(`SeriSP`, `MaSP`) 
                                                                VALUES ($Seri,".$rowGH['MaSP'].")");
                                 
                                 //Tạo mã MaPBH
                                $dataPBH=mysqli_query($conn, "SELECT * from phieubaohanh");
                                if(mysqli_num_rows($dataPBH)==0)
                                    $MaPBH=1;
                                else {
                                    $dataMaxMaPBH=mysqli_query($conn, "SELECT max(MaPBH) MaxMaPBH from phieubaohanh");
                                    $rowMaxMaPBH=mysqli_fetch_array($dataMaxMaPBH);
                                    $MaPBH = $rowMaxMaPBH['MaxMaPBH']+1;
                                }
                                // Lấy mã GBH
                                $dataSP = mysqli_query($conn, "SELECT MaGBH FROM sanpham where MaSP=".$rowGH['MaSP']."");
                                $rowSP = mysqli_fetch_array($dataSP);
                                $crePBH = mysqli_query($conn, "INSERT INTO `phieubaohanh`(`MaPBH`, `MaGBH`, `MaDH`, `SeriSP`) 
                                                                            VALUES ($MaPBH,".$rowSP['MaGBH'].",$MaDH,$Seri)");
                            
                                //Tạo Chi tiết ĐH
                                $creCTDH = mysqli_query($conn, "INSERT INTO `chitietdh`(`MaDH`, `SeriSp`, `MaPBH`)
                                                                        VALUES ($MaDH,$Seri,$MaPBH)");
                        }
                    }
                }
            }
            //Giảm SLSP
            foreach($_SESSION['giohang'] as $rowGH)
            {
                if(($rowGH['TK']==$TK))
                {
                    $dataSP = mysqli_query($conn, "SELECT * FROM sanpham where MaSP = ".$rowGH['MaSP']."");
                    $rowSP = mysqli_fetch_array($dataSP);
                    $SLCL = $rowSP['SoLuong']-$rowGH['soLuong'];
                    mysqli_query($conn, "UPDATE `sanpham` SET `SoLuong`=$SLCL WHERE MaSP=".$rowGH['MaSP']."");
                }
            }
            // Xoá
            foreach($_SESSION['giohang'] as $rowGH)
            {
                if(!($rowGH['TK']==$TK))
                {
                    $GH[] = array('TK'=>$rowGH['TK'], 'MaSP'=>$rowGH['MaSP'], 'soLuong'=>$rowGH['soLuong']);
                }
            }            
            $_SESSION['giohang']=$GH;
            $sqlUPKH = mysqli_query($conn, "UPDATE `khachhang` SET `DiaChi`='$DCGH' WHERE MaKH=".$rowKH['MaKH']."");
            
            echo '<script>window.location.reload()</script>';
        }
        

    
    }
    
?>
