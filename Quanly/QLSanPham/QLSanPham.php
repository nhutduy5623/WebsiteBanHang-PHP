<?php
    include '../../config.php';
    $sqlSP = "SELECT *FROM sanpham";
    $dataSP= mysqli_query($conn, $sqlSP);
?>
<div class="div_tb_show">
<table class="tb_show" id="tb_showSP" border = "1">
        <thead>
            <tr>
                <th>MãSP</th>
                <th>Tên Sản Phẩm</th>
                <th>Hình Ảnh</th>
                <th>Loại SP</th>
                <th>Bảo Hành</th>
                <th>Giá Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Tình Trạng</th>
                <th>Tool</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($rowSP = mysqli_fetch_array($dataSP))
                {
                    //Loại SP
                    $dataLoaiSP = mysqli_query($conn, "SELECT TenLoai from loaiSP where MaLoai=".$rowSP['MaLoai']."");
                    $rowLoaiSP = mysqli_fetch_array(($dataLoaiSP));
                    $rowSP['TinhTrang']==1? $tt="Hiện":$tt="Ẩn";               
                    
                    //Bảo Hành
                    $dataTTBH = mysqli_query($conn, "SELECT PhuongThuc from goibaohanh where MaGBH=".$rowSP['MaGBH']."");
                    $rowBH = mysqli_fetch_array($dataTTBH);
                    ?>
                    <tr>
                        <td><?php echo $rowSP['MaSP']?></td>
                        <td><?php echo $rowSP['TenSP'] ?></td>
                        <td><img width="100px" style="margin: 5px 0;" src="../img/<?php echo $rowSP['HinhAnh']?>" alt=""></td>  
                        <td><?php echo $rowLoaiSP['TenLoai'] ?></td>
                        <td><?php echo $rowBH['PhuongThuc'] ?></td>
                        <td><?php echo $rowSP['GiaSP'] ?></td>
                        <td><?php echo $rowSP['SoLuong'] ?></td>
                        <td><?php echo $tt ?></td>
                        <td>
                            <a class="btn_sua" style="margin: 0 4px;" href="#" onclick="" id="btn_sua_<?php echo $rowSP['MaSP']?>">Sửa</a>|
                            <a class="btn_xoa" onclick="" href="#" id="btn_xoa_<?php echo $rowSP['MaSP']?>">Xoá</a>
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
    var HA='';
    $(".btn_xoa").on("click", function(){
        idElement = this.getAttribute('id');
        console.log(idElement);
        MaSP = idElement.split("btn_xoa_")[1];
        console.log(MaSP);
        if (window.confirm("Bản chỉ có thể ẨN sản phẩm và xoá sản phẩm chưa kinh doanh")) {
                $.ajax({
                url: "./QLSanPham/xuly.php",
                method: "POST",
                data: {tool:"xoa",MaSP:MaSP},
                success:function(data) {
                    console.log(data);
                    var file =  "./QLSanPham/QLSanPham.php";
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
        MaSP = idElement.split("btn_sua_")[1];
        console.log(MaSP);
        $("#btn_ThemSua").val('Sửa')
        $.ajax({
            url: "./QLSanPham/xuly.php",
            method: "POST",
            data: {tool:"GetTT",MaSP:MaSP},
            success:function(data) {
                $('#txt_MaSP').val(MaSP);
                $('#txt_TenSP').val(data.split('+')[0]);
                $('#file_HA').prop('files')[0];
                document.getElementById('file_HA').value="";
                console.log(data.split('+')[1]);
                $('#img_HinhAnh').attr('src','../img/'+data.split('+')[1]);
                $('#select_loaisp').val(data.split('+')[2]);
                $('#select_GBH').val(data.split('+')[3]);
                $('#txt_GiaSP').val(data.split('+')[4]);
                $('#txt_SL').val(data.split('+')[5]);
                $('#select_tinhtrang').val(data.split('+')[6]);
            }
        })
    })
</script>


