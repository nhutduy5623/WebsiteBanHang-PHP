<?php
    include '../../config.php';
    if($_POST['action']=="XLDH")
    {
        $MaDH = $_POST['MaDH'];
        $TK = $_POST['TK'];
        $dataNVXL = mysqli_query($conn,"SELECT *FROM taikhoang where TenTK='$TK'");
        $rowNVXL = mysqli_fetch_array($dataNVXL);
        $MaNVXL=0;
        if($rowNVXL['MaLoai']==3)
        $MaNVXL=$rowNVXL['MaTK'];
        mysqli_query($conn, "UPDATE `donhang` SET `TinhTrang`=1, `NgayGH`=CURRENT_DATE, `MaNVXL`=$MaNVXL WHERE MaDH=$MaDH");
    } else if($_POST['action']=="XCTDH") {
        $MaDH = $_POST['MaDH'];
        $dataTTDH = mysqli_query($conn, "Select sp.MaSP as MaSP, sp.TenSP as TenSP, ctsp.SeriSP, ctdh.MaPBH as MaPBH, sp.GiaSP as GiaSP
                                        from donhang dh, chitietdh ctdh, chitietsp ctsp, sanpham sp
                                        where dh.MaDH=ctdh.MaDH and ctdh.SeriSP=ctsp.SeriSP and ctsp.MaSP=sp.MaSP  and dh.MaDH=$MaDH");
        ?>
        <?php
        while($RowDH = mysqli_fetch_array($dataTTDH)) {
            ?>
                <tr class="CT_SP">
                    <td><?php echo $RowDH['MaSP'] ?></td>
                    <td><?php echo $RowDH['TenSP'] ?></td>
                    <td><?php echo $RowDH['GiaSP'] ?></td>
                    <td><?php echo $RowDH['SeriSP'] ?></td>
                    <td><?php echo $RowDH['MaPBH'] ?></td>
                    
                </tr>
            <?php
        }
    }
?>
