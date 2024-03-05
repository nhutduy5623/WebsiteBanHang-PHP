<?php
    include '../config.php'; 
    $TK=$_POST['TK'];
    if($_POST['action']=="showDH"){
        $dataTK = mysqli_query($conn, "SELECT * FROM taikhoang where TenTK='$TK'");
        $rowTK = mysqli_fetch_array($dataTK);
        if (mysqli_num_rows($dataTK)==0 || $rowTK['MaLoai']!=2)
            echo "Có Lỗi Không Tồn Tại Đơn Hàng Theo Yêu Cầu";        
        else {
            $dataDH = mysqli_query($conn, "SELECT * FROM donhang where MaKH = ".$rowTK['MaTK']."");
            while($rowDH = mysqli_fetch_array($dataDH))
            {
                $MaDH = $rowDH['MaDH'];
                $TT = $rowDH['TongTien'];
                $SDT = $rowDH['SDTNhanHang'];
                $DC = $rowDH['DCNhanHang'];
                $TinhTrang = $rowDH['TinhTrang'];
                $NgayDH = $rowDH['NgayDH'];
                $NgayGH = $rowDH['NgayGH'];
                echo "<tr id='DH_$MaDH' class='tr_DH'> <td class='DH_MDH' style='font-weight: 700;'>$MaDH</td>";  
                $dataTTSP = mysqli_query($conn, "Select sp.TenSP, sp.GiaSP, COUNT(SP.MaSP) as SL 
                                                from donhang dh, chitietdh ctdh, chitietsp ctsp, sanpham sp
                                                where dh.MaDH=ctdh.MaDH and ctdh.SeriSP=ctsp.SeriSP and ctsp.MaSP=sp.MaSP and dh.MaDH=$MaDH
                                                GROUP by sp.MaSP");
                echo "<td>";
                while($rowTTSP = mysqli_fetch_array($dataTTSP))
                {
                    $TenSP = $rowTTSP['TenSP'];
                    $GiaSP = $rowTTSP['GiaSP'];
                    $SL = $rowTTSP['SL'];
                    echo "<p>Tên sản phẩm: $TenSP</p>
                        <p>Giá: $GiaSP | SL: $SL</p>
                        <p>--</p>";
                }
                echo "</td>";
                echo "<td class='DH_TT' style='font-weight: 500;'>$TT</td>";
                echo "<td><p>Ngày đặt hàng: $NgayDH</p>";
                if($NgayGH=="0000-00-00")
                    echo "<p>Ngày Giao hàng: Chưa Giao Hàng</p></td>";
                else
                    echo "<p>Ngày Giao hàng: $NgayGH</p></td>";                
                echo "<td><p>SĐT: $SDT</p>
                <p>Địa Chỉ: $DC</p>
                </td>"; 
                if($TinhTrang==1)
                echo "<td class='DH_TinhTrang' style='color:blue; font-weight: 500; font-size:120%'>Đã Giao Hàng</td></tr>";
                else 
                echo "<td>Chưa Giao Hàng</td></tr>"; 
            }
        }
    }
?>