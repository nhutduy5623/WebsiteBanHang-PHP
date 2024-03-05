<?php
    $MaSP="";
    $TenSP="";
    $HinhAnh="";
    $LoaiSP=1;
    $GBH=1;
    $SL=1;
    $GiaSP=0;
    $TinhTrang=1;
    $dataMaxSP=mysqli_query($conn, "SELECT max(MaSP) MaxMASP from sanpham");
    $rowMaxSP=mysqli_fetch_array($dataMaxSP);
    $MaSP = $rowMaxSP['MaxMASP']+1;
?>
<form class="Form_ThemSua" id="Form_ThemSuaSP" name="Form_ThemSuaSP" action="./QLSanPham/xuly.php" method="POST" style="height: 20%;">
    <div id="form_TSX">
    <div id="div_bao_MaSP">
        <span>Mã Sản Phẩm (Auto)</span>
        <input id="txt_MaSP" type="text" name="txt_MaSP" value="<?php echo $MaSP?>" disabled>
    </div>
    <div id="div_bao_TenSP">
        <span>Tên Sản Phẩm</span>
        <input id="txt_TenSP" type="text" name="txt_TenSP" value="<?php echo $TenSP?>" >
    </div>
    <div id="div_bao_HinhAnh" style="height: 100%;">
        <span>Hình Ảnh</span>
        <img id="img_HinhAnh"  src="../img/<?php echo $HinhAnh?>" alt="" width="50px">
        <input name="file_HA"  type="file" id="file_HA" value="<?php echo $HinhAnh?>">
    </div>
    <div id="div_LoaiSP">
        <span>Loại Sản Phẩm</span>
        <select name="select_loaisp" id="select_loaisp">
            <?php
                $dataTLSP = mysqli_query($conn, "SELECT * FROM loaisp");
                while($rowTLSP = mysqli_fetch_array($dataTLSP))
                {
                    if($LoaiSP!=$rowTLSP['MaLoai'])
                    {
                        ?>
                        <option value="<?php echo $rowTLSP['MaLoai']?>"><?php echo $rowTLSP['TenLoai']?></option>
                        <?php
                    }
                    else
                    {
                        ?>
                        <option selected value="<?php echo $rowTLSP['MaLoai']?>"><?php echo $rowTLSP['TenLoai']?></option>
                        <?php
                    }
                }
            ?>
        </select>
    </div>
    <div id="div_GBH">
        <span>Bảo Hành</span>
        <select name="select_GBH" id="select_GBH">
            <?php
                $dataBH = mysqli_query($conn, "SELECT * FROM goibaohanh");
                while($rowBH = mysqli_fetch_array($dataBH))
                {
                    if($GBH!=$rowBH['MaGBH'])
                    {
                        ?>
                        <option value="<?php echo $rowBH['MaGBH']?>"><?php echo $rowBH['PhuongThuc']?></option>
                        <?php
                    }
                    else
                    {
                        ?>
                        <option selected value="<?php echo $rowBH['MaGBH']?>"><?php echo $rowBH['PhuongThuc']?></option>
                        <?php
                    }
                }
            ?>
        </select>
    </div>
    <div id="div_bao_GiaSP">
        <span>Giá Sản Phẩm</span>
        <input id="txt_GiaSP" type="number" name="txt_GiaSP" value="<?php echo $GiaSP?>" >
    </div>
    <div id="div_bao_SL">
        <span>Số Lượng</span>
        <input id="txt_SL" name="txt_SL" type="number" value="<?php echo $SL?>" >
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
        <input type="button" id="btn_ThemSua" value="Thêm">
        <input type="button" id="btn_reset" value="Huỷ">
    </div>
</form>
<script>
    $(document).ready(function(){
        $('#btn_ThemSua').on('click',function(e){
        e.preventDefault();
        var formdata = new FormData(document.getElementById("Form_ThemSuaSP"));
        // fd.append('HA',$('#file_HA')[0].files[0])
        new_MaSP = $('#txt_MaSP').val();
        new_SP = $('#txt_TenSP').val();
        // new_TL = $('#select_loaisp').val();
        // new_GBH = $('#select_GBH').val();
        new_SL = $('#txt_SL').val();
        // new_TT = $('#select_tinhtrang').val();
        tool='t';
        formdata.append('MaSP',new_MaSP);
        if($('#btn_ThemSua').val()!="Thêm")
        tool='s';
        formdata.append('tool',tool);
        if(new_SP==""||new_SL=="")
        alert('Hãy nhập đầy đủ thông tin');
        else
        $.ajax({
            url: "./QLSanPham/xuly.php",
            method: "POST",
            // data: {tool:tool,MaSP:new_MaSP,SP:new_SP,HA:HA,TL:new_TL,GBH:new_GBH,SL:new_SL,TT:new_TT},
            data: formdata,
            contentType:false,
            processData:false,
            success:function(data) {
                console.log(data);
                $('#file_HA').val('');
                var file =  "./QLSanPham/QLSanPham.php";
                    $.get(file, {}, function(data) {
                        $("#QL_content").html(data);
                    })
                    
            }
        })

    })
    })
        $('#btn_reset').on('click',function(){            
            $('#txt_MaSP').val(<?php echo $rowMaxSP['MaxMASP']+1?>);
            $('#txt_TenSP').val('');
            $('#file_HA').val('');
            $('#select_loaisp').val(1);
            $('#select_GBH').val(1);
            $('#txt_GiaSP').val(0);
            $('#txt_SL').val(1);
            $('#select_tinhtrang').val(1);
            $('#btn_suaxoa').val("Thêm");
        })


    $("#file_HA").change(function(){
        
        thisval = $("#file_HA").val();
        str = thisval.split("fakepath")[1];
        img = str.slice(1)
        $('#img_HinhAnh').attr('src','../img/'+img);
    });
</script>