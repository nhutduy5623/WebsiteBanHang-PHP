<?php
    $MaLoai="";
    $TenLoai="";
    $dataMaxDM=mysqli_query($conn, "SELECT max(MaLoai) MaxMADM from loaisp");
    $rowMaxDM=mysqli_fetch_array($dataMaxDM);
    $MaLoai = $rowMaxDM['MaxMADM']+1;
    
?>
<form class="Form_ThemSua" action="xuly.php" method="GET">
    <div id="form_TSX">
    <div id="div_bao_MaLoai">
        <span>Mã Loại (Auto)</span>
        <input id="txt_MaLoai" type="text" value="<?php echo $MaLoai?>" disabled>
    </div>
    <div id="div_bao_TenLoai">
        <span>Tên Loại</span>
        <input id="txt_TenLoai" type="text" value="<?php echo $TenLoai?>" >
    </div>
    <div id="tool_TSX">
        <input type="button" id="btn_suaxoa" value="Thêm">
        <input type="button" id="btn_reset" value="Huỷ">
    </div>
</form>
<script>
    $('#btn_suaxoa').on('click',function(){
        new_MaLoai = $('#txt_MaLoai').val();
        new_TenLoai = $('#txt_TenLoai').val();
        tool='t';
        if($('#btn_suaxoa').val()!="Thêm")
        tool='s';
        console.log(new_MaLoai,new_TenLoai)
        if(new_TenLoai=="")
        alert('Hãy nhập đầy đủ thông tin');
        else
        $.ajax({
            url: "./QLDanhMuc/xuly.php",
            method: "GET",
            data: {tool:tool,MaLoai:new_MaLoai,TenLoai:new_TenLoai},
            success:function(data) {
                console.log(data);
                var file =  "./QLDanhMuc/QLDanhMuc.php";
                    $.get(file, {}, function(data) {
                        $("#QL_content").html(data);
                })
            }
        })

    })
        $('#btn_reset').on('click',function(){
            $('#txt_MaLoai').val(<?php echo $rowMaxDM['MaxMADM']+1?>);
            $('#txt_TenLoai').val('');
            $('#btn_suaxoa').val("Thêm");
        })
</script>