<?php
    include '../../config.php';
    $sqlDM = "SELECT *FROM loaisp WHERE MaLoai<>1";
    $dataDM= mysqli_query($conn, $sqlDM);
?>
<div class="div_tb_show">
<table class="tb_show" id="tb_showdm" border = "1">
        <thead>
            <tr>
                <th>Mã Loại</th>
                <th>Tên Loại</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($rowDM = mysqli_fetch_array($dataDM))
                {
                    
                    ?>
                    <tr>
                        <td><?php echo $rowDM['MaLoai']?></td>  
                        <td><?php echo $rowDM['TenLoai'] ?></td>
                        <td>
                            <a class="btn_sua" href="#" onclick="" id="btn_sua_<?php echo $rowDM['MaLoai']?>">Sửa</a> |
                            <a class="btn_xoa" href="#" id="btn_xoa_<?php echo $rowDM['MaLoai']?>">Xoá</a>
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
        MaLoai = idElement.split("btn_xoa_")[1];
        console.log(MaLoai);
        if (window.confirm("Bạn có chắc muốn xoá?")) {
                $.ajax({
                url: "./QLDanhMuc/xuly.php",
                method: "GET",
                data: {tool:"xoa",MaLoai:MaLoai},
                success:function(data) {
                    var file =  "./QLDanhMuc/QLDanhMuc.php";
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
        MaLoai = idElement.split("btn_sua_")[1];
        console.log(MaLoai);
        $("#btn_suaxoa").val('Sửa')
        $.ajax({
            url: "./QLDanhMuc/xuly.php",
            method: "GET",
            data: {tool:"GetTT",MaLoai:MaLoai},
            success:function(data) {
                $('#txt_MaLoai').val(MaLoai);
                $('#txt_TenLoai').val(data);
            }
        })
    })
</script>