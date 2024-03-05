<?php
 include 'config.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./fontawesome-free-6.1.0-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./LocSP/LocSP.js"></script>
    <script src="./GioHang/GioHang.js"></script>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/Loc.css">

    
    <title>Document</title>
</head>
<body style="height: 1200px;">
    <?php
        include 'config.php';
    ?>
    <div id="Main_header">
        <div id="Home_Icon" style="height: 100%; width: 100%; display: flex; flex-direction: row;">
            <a href="./index.php" style="height: 100%; width: 60%;"><img src="./img/logo.PNG" height="100%" alt=""></a>
            <a id="Click_GT" href="./gioithieu.php" ><p style="">GIỚI THIỆU</p></a>         
            <style>
                #Click_GT {
                    font-weight: 400;
                    margin: 0 auto;
                    height: 30%; 
                    width: 40%; 
                    text-align: center; 
                    display: flex; 
                    justify-self: center; 
                    border-left: 1px solid #94b0b7;
                    border-right: 1px solid #94b0b7;

                }
                #Click_GT p{
                    margin: auto; 
                    font-size: 130%; 
                    color: #94b0b7;
                }
                #Click_GT:hover {
                    text-decoration: none;
                }
            </style>
        </div>
        <div id="TK_PL">
            <?php
                include './ThanhTimKiem/ThanhTK.php';
                ?><div id="PLSP"><?php include './LocSP/Loai.php'; ?></div><?php
            ?>
        </div>
        <div id="Div_Login_TK_GH">
            <div id="Login_TTK">
                <?php include './login/IconLogin.php'?>
            </div>
            <div class="Icon_GH_QL" id="Icon_GH">
                <i class="fa-solid fa-cart-shopping iconQL_GH"  id="iconGH"></i>
                <i class="fa-solid fa-receipt iconQL_GH" id="iconDH" style="display: none;"></i>
            </div>
            <a class="Icon_GH_QL" id="Icon_QL" href="./Quanly/Quanly.php"><i class="fa-solid fa-wrench iconQL_GH" ></i></a>
        </div>
    </div>

    <div id="Main_content">
        <?php
            include './GioHang/giohang.php';
            include './DonHang/donhang.php';
        ?>
        <div id="Main_filter">
            <div id="LocTheoGia">
                <p  style="color: white; font-size: large; font-weight: 500; margin: 0 auto;">Lọc Theo Giá</p>
                <p style="margin: 0 auto; color: white;">Từ</p>
                    <input type="number" class="NhapGiaLoc" id="GiaTu">
                <p style="margin: 0 auto; color: white;">Đến</p>
                    <input type="number" class="NhapGiaLoc" id="GiaDen">
            </div>
            <div id="SapXep">
                <p style="color: white; font-size: large; font-weight: 500; margin: 0 auto;">Sắp xếp</p>
                <div>
                    <input type="radio" value="BT" name="ChoseSapXep" id="SX_MD" checked>
                    <label style="color: white;" for="SX_G_TD">Mặc Định</label>
                </div>
                <div>
                    <input type="radio" value="G_TD" name="ChoseSapXep" id="SX_G_TD">
                    <label style="color: white;" for="SX_GTD">Giá Tăng Dần</label>
                </div>
                <div>
                    <input type="radio" value="G_GD" name="ChoseSapXep" id="SX_G_GD">
                    <label style="color: white;" for="SX_GDD">Giá Giảm Dần</label>
                </div>
                <div>
                    <input type="radio" value="N_TD" name="ChoseSapXep" id="SX_T_AZ">
                    <label style="color: white;" for="SX_T_AZ">Từ A-Z</label>
                </div>
                <div>
                    <input type="radio" value="N_GD" name="ChoseSapXep" id="SX_T_ZA">
                    <label style="color: white;" for="SX_T_ZA">Từ Z-A</label>
                </div>
            </div>
            <div id="choseSoSP">
            <p style="color: white; font-size: large; font-weight: 500; margin: 0 auto;">Số Sản Phẩm Hiển Thị</p>
            <select name="selectSLSP" id="selectSLSP" value="" style="width: 50%; margin: 0 auto;">
                    <option value="2">2</option>
                    <option value="4">4</option>
                    <option value="6" selected>6</option>
                    <option value="8">8</option>
                    <option value="10">10</option>
                    <option value="12">12</option>
                </select>
            </div>  
            <div id="btnLoc">Lọc</div>  <!--Script V-->
        </div>
        <div id="content">

        </div>
        <?php
            include './ThongTinSP/TTSP.PHP'
        ?>
    </div>
    <div id="Main_footer">

    </div>
</body>
</html>


<script>


    $('#btnLoc').on('click',function(){
    Maloai = 0;
    Maloai = sessionStorage.getItem("MaLoai");
    TimKiem = $('.search_input').val();
    GiaTu = $('#GiaTu').val();
    GiaDen = $('#GiaDen').val();
    if(GiaTu=="" && GiaDen=="")
    {
        GiaTu =0; GiaDen=0;
    }
    console.log(GiaTu);
    console.log(GiaDen);
    SX="BT";
    SapXep = $('input[name="ChoseSapXep"]:checked').val();

    ThuTu = "BT"
    
    if(SapXep!='BT')
    {
        SX = SapXep.split('_')[0];
        ThuTu = SapXep.split('_')[1];
    }
    SoSP1trang=8;
    console.log(SX);
    SoSP1trang = $('#selectSLSP').val();
    console.log(SX);
    $.ajax({
        url: "./LocSP/xuly.php",
        method: "POST",
        data: {Maloai:Maloai, TimKiem:TimKiem, Trang: "1", GiaTu:GiaTu, GiaDen:GiaDen, SX:SX, ThuTu:ThuTu, SoSP1trang:SoSP1trang},
        success:function(data){
            $("#content").html(data);
        }
    })  
})

$('input[name="ChoseSapXep"]').on('click',function(){
    Maloai = 0;
    Maloai = sessionStorage.getItem("MaLoai");
    TimKiem = $('.search_input').val();
    GiaTu = $('#GiaTu').val();
    GiaDen = $('#GiaDen').val();
    if(GiaTu=="" && GiaDen=="")
    {
        GiaTu =0; GiaDen=0;
    }
    console.log(GiaTu);
    console.log(GiaDen);
    SX="BT";
    SapXep = $('input[name="ChoseSapXep"]:checked').val();

    ThuTu = "BT"
    
    if(SapXep!='BT')
    {
        SX = SapXep.split('_')[0];
        ThuTu = SapXep.split('_')[1];
    }
    SoSP1trang=8;
    console.log(SX);
    SoSP1trang = $('#selectSLSP').val();
    $.ajax({
        url: "./LocSP/xuly.php",
        method: "POST",
        data: {Maloai:Maloai, TimKiem:TimKiem, Trang: "1", GiaTu:GiaTu, GiaDen:GiaDen, SX:SX, ThuTu:ThuTu, SoSP1trang:SoSP1trang},
        success:function(data){
            $("#content").html(data);
        }
    })  
})

$('#selectSLSP').change(function(){
    Maloai = 0;
    Maloai = sessionStorage.getItem("MaLoai");
    TimKiem = $('.search_input').val();
    GiaTu = $('#GiaTu').val();
    GiaDen = $('#GiaDen').val();
    if(GiaTu=="" && GiaDen=="")
    {
        GiaTu =0; GiaDen=0;
    }
    console.log(GiaTu);
    console.log(GiaDen);
    SX="BT";
    SapXep = $('input[name="ChoseSapXep"]:checked').val();

    ThuTu = "BT"
    
    if(SapXep!='BT')
    {
        SX = SapXep.split('_')[0];
        ThuTu = SapXep.split('_')[1];
    }
    SoSP1trang=8;
    console.log(SX);
    SoSP1trang = $('#selectSLSP').val();
    console.log($('select[name="selectSLSP"]:selected').text())
    $.ajax({
        url: "./LocSP/xuly.php",
        method: "POST",
        data: {Maloai:Maloai, TimKiem:TimKiem, Trang: "1", GiaTu:GiaTu, GiaDen:GiaDen, SX:SX, ThuTu:ThuTu, SoSP1trang:SoSP1trang},
        success:function(data){
            $("#content").html(data);
        }
    })  
})


    $('#Icon_GH').on('click', function(){
        TK = localStorage.getItem('TK');
        $.ajax({
            url: './GioHang/xuly.php',
            method: 'POST',
            data: {action:"showGH", TK:TK},
            success:function(data){
                document.getElementById('tbl_body_GH').innerHTML=data;
            }   
        })
        $.ajax({
            url: './GioHang/xuly.php',
            method: 'POST',
            data: {action:"TinhTongTien", TK:TK},
            success:function(data){
                document.getElementById('GH_ThanhTien').innerHTML = data;
                document.getElementById('DonHang').style.display="none";
                document.getElementById('GioHang').style.display="flex";
                document.getElementById('iconGH').style.display="none";
                document.getElementById('iconDH').style.display="flex";
            }   
        })
    })
    $('#iconDH').on('click',function(){

        TK = localStorage.getItem('TK');
        $.ajax({
            url: './DonHang/xuly.php',
            method: 'POST',
            data: {action:"showDH", TK:TK},
            success:function(data){
                console.log(data);
                document.getElementById('tbl_body_DH').innerHTML=data;
                document.getElementById('GioHang').style.display="none";
                document.getElementById('DonHang').style.display="flex";
                document.getElementById('iconGH').style.display="flex";
                document.getElementById('iconDH').style.display="none";
            }   
        })
    })

    
        var href=location.href;
        if(href.split('#')[1]=="GH")
        {
            document.getElementById('GioHang').style.display="flex";      
            TK = localStorage.getItem('TK');
            $.ajax({
                url: './GioHang/xuly.php',
                method: 'POST',
                data: {action:"showGH", TK:TK},
                success:function(data){
                    document.getElementById('tbl_body_GH').innerHTML=data;
                }   
            })
            $.ajax({
                url: './GioHang/xuly.php',
                method: 'POST',
                data: {action:"TinhTongTien", TK:TK},
                success:function(data){
                    document.getElementById('GH_ThanhTien').innerHTML = data;
                    document.getElementById('GioHang').style.display="flex";
                }   
            })      
        }
        if(href.split('WebBH/')[1]=="")
        {
            window.location.href="./gioithieu.php";
        }

</script>