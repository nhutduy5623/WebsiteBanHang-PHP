<?php
    $MaGBH="";
    $PhuongThuc="";
    $dataMaxGBH=mysqli_query($conn, "SELECT max(MaGBH) MaxMAGBH from goibaohanh");
    $rowMaxGBH=mysqli_fetch_array($dataMaxGBH);
    $MaGBH = $rowMaxGBH['MaxMAGBH']+1;
    
?>
<form class="Form_ThemSua" action="xuly.php" method="GET">
    <div id="form_TSX">
    <div id="div_bao_MaGBH">
        <span>Mã Gói Bảo Hành (Auto)</span>
        <input id="txt_MaGBH" type="text" value="<?php echo $MaGBH?>" disabled>
    </div>
    <div id="div_bao_PhuongThuc">
        <span>Phương Thức</span>
        <input id="txt_PhuongThuc" type="text" value="<?php echo $PhuongThuc?>" >
    </div>
    <div id="tool_TSX">
        <input type="button" id="btn_suaxoa" value="Thêm">
        <input type="button" id="btn_reset" value="Huỷ">
    </div>
</form>
<script>
    $('#btn_suaxoa').on('click',function(){
        new_MaGBH = $('#txt_MaGBH').val();
        new_PhuongThuc = $('#txt_PhuongThuc').val();
        tool='t';
        if($('#btn_suaxoa').val()!="Thêm")
        tool='s';
        console.log(new_MaGBH,new_PhuongThuc)
        if(new_PhuongThuc=="")
        alert('Hãy nhập đầy đủ thông tin');
        else
        $.ajax({
            url: "./QLGBH/xuly.php",
            method: "GET",
            data: {tool:tool,MaGBH:new_MaGBH,PhuongThuc:new_PhuongThuc},
            success:function(data) {
                var file =  "./QLGBH/QLGBH.php";
                    $.get(file, {}, function(data) {
                        $("#QL_content").html(data);
                })
            }
        })

    })
        $('#btn_reset').on('click',function(){
            $('#txt_MaGBH').val(<?php echo $rowMaxGBH['MaxMAGBH']+1?>);
            $('#txt_PhuongThuc').val('');
            $('#btn_suaxoa').val("Thêm");
        })
</script>