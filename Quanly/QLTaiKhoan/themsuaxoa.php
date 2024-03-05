<?php
    $MaTK="";
    $TenTK="";
    $MatKhau="";
    $TenUser="";
    $LoaiTK=2;
    $TinhTrang=1;
    $Email="";
    $SDT="";
    $DiaChi="";
    $dataMaxTK=mysqli_query($conn, "SELECT max(MaTK) MaxMATK from taikhoang");
    $rowMaxTK=mysqli_fetch_array($dataMaxTK);
    $MaTK = $rowMaxTK['MaxMATK']+1;
?>
<form class="Form_ThemSua" action="xuly.php" method="GET">
    <div id="form_TSX">
    <div id="div_bao_MaTK">
        <span>Mã Tài Khoản (Auto)</span>
        <input id="txt_MaTK" type="text" value="<?php echo $MaTK?>" disabled>
    </div>
    <div id="div_bao_TenTK">
        <span>Tên Tài Khoản</span>
        <input id="txt_TenTK" type="text" value="<?php echo $TenTK?>" >
    </div>
    <div id="div_bao_MatKhau">
        <span>Mật Khẩu</span>
        <input id="txt_MK" type="text" value="<?php echo $MatKhau?>" >
    </div>
    <div id="div_bao_TenUser">
        <span>Tên User</span>
        <input id="txt_UN" type="text" value="<?php echo $TenUser?>" >
    </div>
    <div id="div_bao_Email">
        <span>Email</span>
        <input id="txt_EM" type="text" value="<?php echo $Email?>" >
    </div>
    <div id="div_bao_SDT">
        <span>Số Điện Thoại</span>
        <input id="txt_SDT" type="text" value="<?php echo $SDT?>" >
    </div>
    <div id="div_baoDiaChi">
        <span>Địa Chỉ</span>
        <textarea id="txt_DC" name="" id="" cols="20" rows="3"><?php echo $DiaChi?></textarea>
    </div>
    <div id="div_LoaiTK">
        <span>Loại Tài Khoản</span>
        <select name="select_loaitk" id="select_loaitk">
            <?php
                $dataTLTK = mysqli_query($conn, "SELECT * FROM loaitk");
                while($rowTLTK = mysqli_fetch_array($dataTLTK))
                {
                    if($LoaiTK!=$rowTLTK['MaLoai'])
                    {
                        ?>
                        <option value="<?php echo $rowTLTK['MaLoai']?>"><?php echo $rowTLTK['TenLoai']?></option>
                        <?php
                    }
                    else
                    {
                        ?>
                        <option selected value="<?php echo $rowTLTK['MaLoai']?>"><?php echo $rowTLTK['TenLoai']?></option>
                        <?php
                    }
                }
            ?>
        </select>
    </div>
    <div id="div_bao_TinhTrang">
        <span>Tình Trạng</span>
        <select name="select_tinhtrang" id="select_tinhtrang">
            <?php
                if($TinhTrang==1)
                {
                    ?>
                        <option value="1" selected>Hiện</option>
                        <option value="0">Ẩn</option>
                    <?php
                }
                else {
                    ?>
                        <option value="1">Hiện</option>
                        <option value="0" selected>Ẩn</option>
                    <?php
                }
            ?>
        </select>
    </div>
    </div>
    <div id="tool_TSX">
        <input type="button" id="btn_suaxoa" value="Thêm">
        <input type="button" id="btn_reset" value="Huỷ">
    </div>
</form>
<script>
    $('#btn_suaxoa').on('click',function(){
        new_MaTK = $('#txt_MaTK').val();
        new_TK = $('#txt_TenTK').val();
        new_MK = $('#txt_MK').val();
        new_UN = $('#txt_UN').val();
        new_EM = $('#txt_EM').val();
        new_SDT = $('#txt_SDT').val();
        new_DiaChi = $('#txt_DC').val();
        new_TL = $('#select_loaitk').val();
        new_TT = $('#select_tinhtrang').val();
        tool='t';
        if($('#btn_suaxoa').val()!="Thêm")
        tool='s';
        console.log(new_MaTK,new_TK,new_MK,new_UN,new_EM,new_SDT,new_DiaChi,new_TL,new_TT)
        if(new_TK==""||new_MK==""||new_UN==""||new_EM==""||new_SDT=="")
        alert('Hãy nhập đầy đủ thông tin');
        else
        if(checkTK(new_TK, new_MK, new_EM, new_SDT)!=1)
            alert(checkTK(new_TK, new_MK, new_EM, new_SDT));
        else
        $.ajax({
            url: "./QLTaiKhoan/xuly.php",
            method: "GET",
            data: {tool:tool,MaTK:new_MaTK,TK:new_TK,MK:new_MK,UN:new_UN,EM:new_EM,SDT:new_SDT,DiaChi:new_DiaChi,TL:new_TL,TT:new_TT},
            success:function(data) {
                var file =  "./QLTaiKhoan/QLTaiKhoan.php";
                    $.get(file, {}, function(data) {
                        $("#QL_content").html(data);
                    })
            }
        })

    })


    function checkTK(TK, MK, EM, SDT) {
        value = TK;
            var ktraDoDai = /^[a-zA-Z0-9]{5,30}$/;
            var ktraTK = /^[a-zA-Z0-9]*$/;
            if(!value.trim())
            return 'Không Được Bỏ Trống'
            if(!ktraTK.test(value)) 
            return 'Tài khoản đang chứa ký tự đặt biệt'
            if(!ktraDoDai.test(value))
            return 'Tên Tài Khoản Phải Trên 5 và nhỏ hơn 30 ký tự'
        value = MK;
            var ktraPASS = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
            if(!value.trim())
            return 'Mật khẩu Không Được Bỏ Trống'
            if(!ktraPASS.test(value))
            return 'Mật khẩu Tối thiểu tám ký tự, ít nhất một chữ cái và một số:'
        value = EM;     
            ktraEmail=/^[A-Za-z][\w$.]+@[\w]+\.\w+$/
            if(!value.trim())
            return 'Email Không Được Bỏ Trống'
            if(!ktraEmail.test(value))
            return 'Email không hợp lệ'
        value = SDT;
            ktraSDT=/^[0-9]{9,10}$/
            if(!value.trim())
            return 'SĐT Không Được Bỏ Trống'
            if(!ktraSDT.test(value))
            return 'SĐT phải có 9-10 ký tự và ở dạng số'
            return 1;
        }
        

        $('#btn_reset').on('click',function(){
            
            $('#txt_MaTK').val(<?php echo $rowMaxTK['MaxMATK']+1?>);
            $('#txt_TenTK').val('');
            $('#txt_MK').val('');
            $('#txt_UN').val('');
            $('#txt_EM').val('');
            $('#txt_SDT').val('');
            $('#txt_DC').val('');
            $('#btn_suaxoa').val("Thêm");
            $('#select_loaitk').removeAttr('disabled');
        })
</script>