<?php
    include '../../config.php';
    if(!isset($_POST['TTDH'])||$_POST['TTDH']=="")
    $TTDH="";
    else
    $TTDH=$_POST['TTDH'];
    if(isset($_POST['Fdate']))
    {
        $Fdate=$_POST['Fdate'];
        $Ldate=$_POST['Ldate'];
    }
    else
    {
        $Fdate='2020-01-01';
        $Ldate=date('Y-m-d');
    }
?>
<div class="CTDH_Layer">
    <div class="CTDH">
    <div class="CTDH_Top">
        <div class="CTDH_MaDH"></div>
        <i class="fa-solid fa-xmark close_CTDH" style="margin: auto 0;"></i>
    </div>
    <div class="CTDH_Content">
        <table > 
            <thead>
                <tr>
                    <th>Mã Sản Phẩm</th>   
                    <th>Tên Sản Phẩm</th>
                    <th>Gía Sản Phẩm</th>
                    <th>Seri Sản Phẩm</th>
                    <th>MãPBH</th>
                </tr>
            </thead>
            <tbody class="body_CTDH">

            </tbody>
        </table>
    </div>
    </div>
</div>
<div class="div_tb_show">
    <div id="LocDH" style="width: 100%; display: flex; flex-direction: row; justify-content: space-between;">
        <div id="LocDH_XL">
            <label for="sl_LocDH">Lọc Đơn Hàng:</label>
            <select name="LocDH" id="sl_LocDH">
                <option value="" selected>Tất Cả</option>
                <option value="0">Chưa Xử Lý</option>
                <option value="1">Đã Xử Lý</option>
            </select>
        </div>
        <div id="LocNgay">Đặt Hàng
            Từ Ngày:
            <input type="date" id="Fdate" value="2020-01-01" />
            Đến Ngày:
            <input type="date" id="Ldate" value="<?php echo date('Y-m-d'); ?>" />   
        </div>
    </div>
    <div class="tb_show" style="height: 100%; width: 100%;">
    <table class="tb_show" id="tb_showtk" border = "1">
        <thead>
            <tr>
                <th>MãĐH</th>
                <th>Mã Khách Hàng</th>
                <th>Đơn Giá</th>
                <th>Thời Gian</th>
                <th>Thông Tin Giao Hàng</th>
                <th>Xem Chi Tiết</th>
                <th>Quản Lý</th>
                <th>MãNVXL</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    if($TTDH=="")
                    $dataDH = mysqli_query($conn, "SELECT * FROM donhang where NgayDH>='$Fdate' and NgayDH<='$Ldate' ORDER BY MaDH DESC");
                    else
                    $dataDH = mysqli_query($conn, "SELECT * FROM donhang WHERE NgayDH>='$Fdate' and NgayDH<='$Ldate' and TinhTrang=$TTDH ORDER BY MaDH DESC");
                    while($rowDH = mysqli_fetch_array($dataDH))
                    {
                        $MaDH = $rowDH['MaDH'];
                        $MaKH = $rowDH['MaKH'];
                        $TT = $rowDH['TongTien'];
                        $SDT = $rowDH['SDTNhanHang'];
                        $DC = $rowDH['DCNhanHang'];
                        
                        $TinhTrang = $rowDH['TinhTrang'];
                        $NgayDH = $rowDH['NgayDH'];
                        $NgayGH = $rowDH['NgayGH'];
                        $MaNVXL = $rowDH['MaNVXL'];
                        echo "<tr id='trDH_$MaDH'> <td class='DH_MDH' style='font-weight: 700;'>$MaDH</td>";  
                        $dataTTSP = mysqli_query($conn, "Select sp.TenSP, sp.GiaSP, COUNT(SP.MaSP) as SL 
                                                        from donhang dh, chitietdh ctdh, chitietsp ctsp, sanpham sp
                                                        where dh.MaDH=ctdh.MaDH and ctdh.SeriSP=ctsp.SeriSP and ctsp.MaSP=sp.MaSP and dh.MaDH=$MaDH
                                                        GROUP by sp.MaSP");                            
                        echo "<td>";
                        //Echo danh sách sản phẩm
                        echo "$MaKH";
                        echo "</td>";
                        echo "<td class='DH_TT' style='font-weight: 500;'>$TT</td>";
                        echo "<td><p>Ngày đặt hàng: $NgayDH</p>";
                        if($NgayGH=="0000-00-00")
                            echo "<p id='DGH_$MaDH'>Ngày Giao hàng: Chưa Giao Hàng</p></td>";
                        else
                            echo "<p>Ngày Giao hàng: $NgayGH</p></td>";                
                        echo "<td><p>SĐT: $SDT</p>
                        <p>Địa Chỉ: $DC</p>
                        </td>"; 
                        echo "<td><div class='XCT_DH' id='XCT_$MaDH'>Xem Chi Tiết</div></td>";
                        if($TinhTrang==1)
                            echo "<td><input style='height: 30px;width: 100%' type='button' id='btnXL_$MaDH' value='Đã Xử Lý' disabled></td>";
                        else   
                            echo "<td><input class='btn_XLDH' style='height: 30px; width: 100%' type='button' id='btnXL_$MaDH' value='Xử Lý'></td>";
                        echo "<td id='NVXL_$MaDH'>$MaNVXL</td></tr>";
        
                    }
            ?>
        </tbody>
    </table>
    </div>
</div>
<script>
    $("div").parents('.div_tb_show').height("100%")
</script>
<style>

                
    .tb_show {
        overflow-y: scroll !important;
    }
    .div_tb_show {
        overflow-y: hidden;
    }

    input[type=button] {
        background-color: teal;
        color: white;
    }
    input[type=button][value="Đã Xử Lý"] {
        background-color: white !important;
        color: black;
    }
    #LocDH input{
        margin: 0 5px;
    }

    /* CSS chi tiết đơn hàng */
    .XCT_DH:hover {
        cursor: pointer;
        color: blue;
    }
    .XCT_DH {
        color: slateblue;
    }
    .CTDH_Layer {
        height: 100%;
        width: 100%;
        background-color: rgba(108, 108, 108, 0.277);
        display: flex;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        justify-content: center;
        display: none;
    }
    .CTDH {
        background: white;
        width: 30%;
        height: 70%;
        border: 1px solid black;
        border-radius: 1%;
        margin: auto;
    }
    .CTDH_Content {
        height: 95%;
        width: 100%;
        overflow-y: scroll;
    }
    .CTDH_Content table {
        height: 100%;
        width: 100%;
    }
    .CTDH .CTDH_Top{
        height: 5%;
        background-color: teal;
        display: flex;
        flex-direction: row;
        padding: 0 2px;
        font-size: large;
        justify-content: space-between;
        color: white;
    }
    .close_CTDH:hover {
        cursor: pointer;
    }
    .CTDH table tr td {
        border: 0px;
        border-bottom: 1px solid black;
    }
    .CT_SP {
        width: 100%;
    }
</style>
<script>
    $('#sl_LocDH').change(function(){
        TTDH = $('#sl_LocDH').val();
        Fdate = $('#Fdate').val();
        Ldate = $('#Ldate').val();
        console.log(TTDH);
        var file =  "./QLDonHang/QLDonHang.php";
        $.post(file, {TTDH:TTDH,Fdate:Fdate, Ldate:Ldate}, function(data) {
            $("#QL_content").html(data);
            $('#Fdate').val(Fdate);
            $('#Ldate').val(Ldate);
            $("#sl_LocDH").val(TTDH).selected();

        })
    })    
    $('#Fdate').change(function(){
        TTDH = $('#sl_LocDH').val();
        Fdate = $('#Fdate').val();
        Ldate = $('#Ldate').val();
        var file =  "./QLDonHang/QLDonHang.php";
        $.post(file, {TTDH:TTDH,Fdate:Fdate, Ldate:Ldate}, function(data) {
            $("#QL_content").html(data);
            $('#Fdate').val(Fdate);
            $('#Ldate').val(Ldate);
            $("#sl_LocDH").val(TTDH).selected();

        })
    })
    $('#Ldate').change(function(){
        TTDH = $('#sl_LocDH').val();
        Fdate = $('#Fdate').val();
        Ldate = $('#Ldate').val();
        var file =  "./QLDonHang/QLDonHang.php";
        $.post(file, {TTDH:TTDH,Fdate:Fdate, Ldate:Ldate}, function(data) {
            $("#QL_content").html(data);
            $('#Fdate').val(Fdate);
            $('#Ldate').val(Ldate);
            $("#sl_LocDH").val(TTDH).selected();

        })
    })


    $('.btn_XLDH').on('click', function(){
        idElement = this.getAttribute('id');
        MaDH=idElement.split('btnXL_')[1];
        TK=localStorage.getItem('TK');
        if (confirm('Bạn Chắc Chắn Là Đơn Hàng Đã Được Giao?')) {
            $.ajax({
            url:'./QLDonHang/xuly.php',
            method: 'POST',
            data: {action:"XLDH",MaDH:MaDH,TK:TK},
            success:function(data){
                $('#'+idElement).val("Đã Xử Lý");
                $('#'+idElement).prop('disabled', true);
                today = new Date();
                date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                $('#DGH_'+MaDH).html("Ngày Giao hàng: "+date);
                $('#NVXL_'+MaDH).html(TK);
            }   
            })
        }         
    })

    $('.XCT_DH').on('click', function(){
        idElement = this.getAttribute('id');
        MaDH=idElement.split('XCT_')[1];
        $.ajax({
            url: './QLDonHang/xuly.php',
            method: 'POST',
            data: {action:"XCTDH", MaDH:MaDH},
            success:function(data) {
                $('.body_CTDH').html(data);
                $('.CTDH_MaDH').html("Mã Đơn Hàng: "+MaDH);
                document.querySelector('.CTDH_Layer').style.display='flex';
            }
        })
    })    
    $('.close_CTDH').on('click', function(){
        document.querySelector('.CTDH_Layer').style.display='none';
    })    
</script>