<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../WebBH/fontawesome-free-6.1.0-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="Quanly.css">
    <title>Quản Lý</title>
</head>
<body style="position: fixed; top:0; right: 0; bottom: 0; left: 0%;">
    <?php
        include '../config.php';
    ?>
    <div id="QL_header">
        <div id="Icon"></div>
        <div id="TimKiem_QL"></div>
    </div>
    <div id="QL_menu">
        <a style="width: 10%;" href="../index.php"><input style=" color: white; width: 100%;" value="Trang Chủ" style="height: 100%; width: 100%;" type="button"></a>
        <input class="btn_QL" id="QLDanhMuc" value="Quản Lý Danh Mục" type="button" style="display: none;">
        <input class="btn_QL" id="QLSanPham" value="Quản Lý Sản Phẩm" type="button" style="display: none;">
        <input class="btn_QL" id="QLGBH" value="Quản Lý Gói Bảo Hành" type="button" style="display: none;">
        <input class="btn_QL" id="QLTaiKhoan" value="Quản Lý Tài Khoản" type="button" style="display: none;">
        <input class="btn_QL" id="QLDonHang" value="Quản Lý Đơn Hàng" type="button" style="display: none;">        
        <input class="btn_QL" id="ThongKe" value="Thống Kê" type="button" style="display: none;">        
    </div>
    <div id="QL_content" style="padding: 2%;">
        
    </div>
</body>
<script>
    if(localStorage.getItem('LoaiTK')==3)
    {
        document.getElementById('QLDonHang').style.display='block';
        document.getElementById('QLDonHang').style.width='100%';
    } else if (localStorage.getItem('LoaiTK')==1) {
        document.getElementById('QLDanhMuc').style.display='block';
        document.getElementById('QLSanPham').style.display='block';
        document.getElementById('QLGBH').style.display='block';
        document.getElementById('QLTaiKhoan').style.display='block';
        document.getElementById('QLDonHang').style.display='block';
        document.getElementById('ThongKe').style.display='block';
    }
    $('#QL_menu input').on('click',function(){
        var idElement = this.getAttribute('id');        
        console.log($("#"+idElement));
        var file =  "./"+idElement+"/"+idElement+".php";
        $.get(file, {}, function(data) {
            $("#QL_content").html(data);
        })
    })

</script>
</html>