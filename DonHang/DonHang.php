<link rel="stylesheet" href="./DonHang/Donhang.css">
<div id="DonHang">
    <div id="DH_Header">
        <i class="fa-solid fa-angles-left" id="DH_btn_TroVe" onclick="closeDH()"></i>
        <div id="DH_Title">Đơn Hàng</div>
    </div>
    <div id="DH_Content">
        <div id="DH_DSSP">
            <table style="height: 100%; width: 100%;"  id="Tbl_DH">
                <thead>
                    <tr>
                        <th>Mã Đơn Hàng</th>
                        <th>Sản Phẩm</th>
                        <th>Đơn Giá</th>
                        <th>Thời Gian</th>
                        <th>Thông Tin Giao Hàng</th>
                        <th>Tình Trạng</th>
                    </tr>
                </thead>
                <tbody id="tbl_body_DH">
                </tbody>
            </table>
        </div>
        
    </div>
    <div id="DH_Footer">

    </div>
</div>
<script>
    function closeDH(){
        document.getElementById('GioHang').style.display = "none";
        document.getElementById('DonHang').style.display = "none";
        document.getElementById('iconGH').style.display="flex";
        document.getElementById('iconDH').style.display="none";
    } 



</script>

<style>
    .tb_show tr, th, td{
    border-bottom: 2px solid rgb(0, 0, 0);
    background-color: white;
}
#DH_btn_TroVe {
    color: white;
    font-size: 200%;
}
#DH_btn_TroVe:hover {
    cursor: pointer;
    color: rgb(185, 185, 185);
}

</style>