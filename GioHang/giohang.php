<link rel="stylesheet" href="./GioHang/giohang.css">
<div id="GioHang">
    <div id="GH_Header">
        <i class="fa-solid fa-angles-left" id="GH_btn_TroVe" onclick="closeGH()"></i>
        <div id="GH_Title">Giỏ Hàng</div>
    </div>
    <div id="GH_Content">
        <div id="GH_DSSP">
            <table style="height: 100%; width: 100%;"  id="Tbl_GH">
                <thead>
                    <tr>
                        <th>Hình Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                        <th>Thay Đổi</th>
                    </tr>
                </thead>
                <tbody id="tbl_body_GH">
                </tbody>
            </table>
        </div>
        <div id="GH_TTND">

            <!-- Điền thông tin giao hàng  -->
            <?php
                if(isset($_SESSION['TK'])&&$_SESSION['TK']!="")
                {
                    $dataTK  = mysqli_query($conn, "SELECT * from taikhoang where TenTK='".$_SESSION['TK']."'");
                    $rowTK = mysqli_fetch_array($dataTK);            
                    $dataTTKH = mysqli_query($conn, "SELECT * from khachhang where MaKH = ".$rowTK['MaTK']."");
                    $rowTTKH = mysqli_fetch_array($dataTTKH);
            ?>
            <p>Thông tin giao hàng</p>
            <div id="TTGH_SDT">
                <p>Số Điện Thoại</p>
                <input id="SDTGH" type="number" value="<?php echo $rowTTKH['SDT']?>">
            </div>
            </br>
            <div id="TTGH_DC">
                <p>Địa Chỉ</p>
                <input id="DCGH" type="text" value="<?php echo $rowTTKH['DiaChi']?>">
            </div>
                <?php } else {
                    ?>
                    <p>Thông tin giao hàng</p>
                    <div id="TTGH_SDT">
                        <p>Số Điện Thoại</p>
                        <input id="SDTGH" type="number" value="">
                    </div>
                    </br>
                    <div id="TTGH_DC">
                        <p>Địa Chỉ</p>
                        <input id="DCGH" type="text" value="">
                    </div>
                    <?php
                }?>
        </div>
    </div>
    <div id="GH_Footer">
        <div id="NhacErro"></div>
        <div id="GH_TongTien">Tổng Tiền: </div>
        <div id="GH_ThanhTien"></div>
        <input type="button" id="btn_TT" value="Thanh Toán">
    </div>
</div>

<script>
    function closeGH() {
        document.getElementById('GioHang').style.display = "none";
        document.getElementById('iconGH').style.display="flex";
        document.getElementById('iconDH').style.display="none";
    }   

    function changeSLSP(MaSP) {
        TK = localStorage.getItem('TK');
        idnewSL = '#SL_'+MaSP;
        newSL = $(idnewSL).val();
        console.log('MaSP')
        $.ajax({
            url: './GioHang/xuly.php',
            method: 'POST',
            data: {action:'changeSL', TK:TK, MaSP:MaSP, newSL:newSL},
            success:function(data){
            }
        })
        $.ajax({
            url: './GioHang/xuly.php',
            method: 'POST',
            data: {action:'TinhTongTien', TK:TK},
            success:function(data){
                document.getElementById('GH_ThanhTien').innerHTML = data;
            }   
    })
    }
   
    $('#btn_TT').on('click',function() {
        TK = localStorage.getItem('TK');
        TT = $('#GH_ThanhTien').html();
        console.log(TT);
        SDTGH = "";
        DCGH = "";
        SDTGH = $('#SDTGH').val();
        DCGH = $('#DCGH').val();
        if(SDTGH=="" || DCGH=="")
        {
            alert("Vui lòng nhập đầy đủ thông tin giao hàng")
        } else if (confirm('Xác nhận đặt hàng?')) {
            $.ajax({
                url: './DonHang/themdonhang.php',
                method: "POST",
                data: {action:"Themdonhang",TK:TK,TT:TT,SDTGH:SDTGH,DCGH:DCGH},
                success:function(data){
                    $('#NhacErro').html(data);
                }
            })
        } else {
        }
    })
</script>