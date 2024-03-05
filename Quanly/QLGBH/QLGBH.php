<?php
    include '../../config.php';
    $sqlGBH = "SELECT *FROM goibaohanh where MaGBH<>0";
    $dataGBH= mysqli_query($conn, $sqlGBH);
?>
<div class="div_tb_show">
<table class="tb_show" id="tb_showgbh" border = "1">
        <thead>
            <tr>
                <th>Mã Gói Bảo Hành</th>
                <th>Phương Thức</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($rowGBH = mysqli_fetch_array($dataGBH))
                {
                    
                    ?>
                    <tr>
                        <td><?php echo $rowGBH['MaGBH']?></td>  
                        <td><?php echo $rowGBH['PhuongThuc'] ?></td>
                        <td>
                            <a class="btn_sua" href="#" onclick="" id="btn_sua_<?php echo $rowGBH['MaGBH']?>">Sửa</a> |
                            <a class="btn_xoa" href="#" id="btn_xoa_<?php echo $rowGBH['MaGBH']?>">Xoá</a>
                        </td>
                    </tr>
                    
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>
<?php
    include 'themsuaxoa.php';
?>
<script>
    $(".btn_xoa").on("click", function(){
        idElement = this.getAttribute('id');
        console.log(idElement);
        MaGBH = idElement.split("btn_xoa_")[1];
        console.log(MaGBH);
        if (window.confirm("Bạn có chắc muốn xoá?")) {
                $.ajax({
                url: "./QLGBH/xuly.php",
                method: "GET",
                data: {tool:"xoa",MaGBH:MaGBH},
                success:function(data) {
                    var file =  "./QLGBH/QLGBH.php";
                    $.get(file, {}, function(data) {
                        $("#QL_content").html(data);
                })
                }
            })
        }
        
    })

    $(".btn_sua").on("click", function(){
        idElement = this.getAttribute('id');
        console.log(idElement);
        MaGBH = idElement.split("btn_sua_")[1];
        console.log(MaGBH);
        $("#btn_suaxoa").val('Sửa')
        $.ajax({
            url: "./QLGBH/xuly.php",
            method: "GET",
            data: {tool:"GetTT",MaGBH:MaGBH},
            success:function(data) {
                $('#txt_MaGBH').val(MaGBH);
                $('#txt_PhuongThuc').val(data);
            }
        })
    })
</script>