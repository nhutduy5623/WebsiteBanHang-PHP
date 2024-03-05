<?php
    include '../../config.php';
    $Fdate="2020-01-01";
    $Ldate=date('Y-m-d');
    if(isset($_POST['Fdate']))
    {
        $Fdate=$_POST['Fdate'];
        $Ldate=$_POST['Ldate'];
    }
?>
<div id="TK_ThoiGian" style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;">
        <div id="LocTK">Đặt Hàng
            Từ Ngày:
            <input type="date" class="TK_date" id="TK_Fdate" value="2020-01-01" />
            Đến Ngày:
            <input type="date" class="TK_date" id="TK_Ldate" value="<?php echo date('Y-m-d'); ?>" />   
        </div>
</div>
<div id="TK_Content">
    <?php 
        $dataDH = mysqli_query($conn, "SELECT * FROM donhang WHERE NgayGH>='$Fdate' and NgayGH<='$Ldate'");
        $rowDH = mysqli_fetch_array($dataDH);
        $dataDM = mysqli_query($conn, "SELECT * FROM loaisp");

        //Thống Kê Tất Cả
        $dataTC_DH = mysqli_query($conn, "SELECT COUNT(ctdh.SeriSP) as SL FROM donhang DH, chitietdh ctdh, chitietsp ctsp, sanpham sp
        WHERE dh.MaDH=ctdh.MaDH and ctdh.SeriSp=ctsp.SeriSP and DH.TinhTrang=1 and sp.MaSP=ctsp.MaSP and NgayGH>='$Fdate' and NgayGH<='$Ldate'");
        $rowTC_DH = mysqli_fetch_array($dataTC_DH);
        //Thống Kê Theo Loại
        $dataTTTK_DH = mysqli_query($conn, "SELECT tl.MaLoai, tl.TenLoai, COUNT(tl.MaLoai) as SL FROM donhang DH, chitietdh ctdh, chitietsp ctsp, loaisp tl, sanpham sp
        WHERE dh.MaDH=ctdh.MaDH and ctdh.SeriSp=ctsp.SeriSP and DH.TinhTrang=1 and sp.MaSP=ctsp.MaSP and sp.MaLoai=tl.MaLoai and NgayGH>='$Fdate' and NgayGH<='$Ldate'
        GROUP BY tl.MaLoai, tl.TenLoai");
        ?>
        <div class="TKDM_TL" id="TKDM_TC">
                <div class="TK_TenDM">Tất Cả</div>
                <div class="TK_SLban"><?php echo $rowTC_DH['SL']?></div>
        </div>
        <?php
        while($rowTK_DH = mysqli_fetch_array($dataTTTK_DH))
        {
            ?>
            <div class="TKDM_TL" id="TKDM_<?php echo $rowTK_DH['MaLoai']?>">
                    <div class="TK_TenDM"><?php echo $rowTK_DH['TenLoai']?></div>
                    <div class="TK_SLban"><?php echo $rowTK_DH['SL']?></div>
            </div>
            <?php
        }
    ?>
</div>

<script>
    $('.TK_date').change(function(){
        Fdate = $('#TK_Fdate').val();
        Ldate = $('#TK_Ldate').val();
        var file =  "./ThongKe/ThongKe.php";
        $.post(file, {Fdate:Fdate, Ldate:Ldate}, function(data) {
            $("#QL_content").html(data);
            $('#TK_Fdate').val(Fdate);
            $('#TK_Ldate').val(Ldate);
        })
    })
</script>

<style>
    #TK_Content {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .TKDM_TL {
        display: flex;
        margin: 2%;
        height: 200px;
        width: 350px;
        background-color: bisque;
        flex-direction: column;
        justify-content: space-around;
        text-align: center;
        font-size: 30px;
        border-radius: 5px;
    }
    .TKDM_TL div {
        margin: auto;
    }
</style>