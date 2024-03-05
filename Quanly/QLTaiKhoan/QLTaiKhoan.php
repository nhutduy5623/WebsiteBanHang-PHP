<?php
    include '../../config.php';
    $sqlTK = "SELECT *FROM taikhoang";
    $dataTK= mysqli_query($conn, $sqlTK);
?>
<div class="div_tb_show">
<table class="tb_show" id="tb_showtk" border = "1">
        <thead>
            <tr>
                <th>MãTK</th>
                <th>Tên TK</th>
                <th>Mật Khẩu</th>
                <th>Loại TK</th>
                <th>Tình Trạng</th>
                <th>Thông Tin</th>
                <th>Tool</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($rowTK = mysqli_fetch_array($dataTK))
                {
                    $dataLoaiTK = mysqli_query($conn, "SELECT TenLoai from loaitk where MaLoai=".$rowTK['MaLoai']."");
                    $rowLoaiTK = mysqli_fetch_array(($dataLoaiTK));
                    $rowTK['TinhTrang']==1? $tt="Hiện":$tt="Ẩn"; 
                        if($rowTK['MaLoai']==2)
                            $dataTTTK = mysqli_query($conn, "SELECT * from khachhang where MaKH = ".$rowTK['MaTK']."");
                        else
                            $dataTTTK = mysqli_query($conn, "SELECT * from nhanvien where MaNV = ".$rowTK['MaTK']."");
                        $rowTTTK = mysqli_fetch_array($dataTTTK);                
                    
                    

                    ?>
                    <tr>
                        <td><?php echo $rowTK['MaTK']?></td>
                        <td><?php echo $rowTK['TenTK'] ?></td>
                        <td><?php echo $rowTK['MatKhau'] ?></td>  
                        <td><?php echo $rowLoaiTK['TenLoai'] ?></td>
                        <td><?php echo $tt ?></td>
                        <td><?php
                        $EM="";
                        $SDT="";
                        $DC="";
                        if($rowTK['MaLoai']!=1)
                        {
                            $EM=$rowTTTK['Email'];
                            $SDT=$rowTTTK['SDT'];
                            $DC=$rowTTTK['DiaChi'];
                        }
                        if($rowTK['MaLoai']!=1) 
                            echo  "Email: ".$EM."</br> SĐT: ".$SDT."</br> Địa chỉ: ".$DC."</br>";
                        else
                            echo "Admin";
                        ?>
                        </td>
                        <td>
                            <a class="btn_sua" href="#" onclick="" id="btn_sua_<?php echo $rowTK['MaTK']?>">Sửa</a>
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
        MaTK = idElement.split("btn_xoa_")[1];
        console.log(MaTK);
        if (window.confirm("Bạn có chắc muốn xoá?")) {
                $.ajax({
                url: "./QLTaiKhoan/xuly.php",
                method: "GET",
                data: {tool:"xoa",MaTK:MaTK},
                success:function(data) {
                    var file =  "./QLTaiKhoan/QLTaiKhoan.php";
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
        MaTK = idElement.split("btn_sua_")[1];
        console.log(MaTK);
        $("#btn_suaxoa").val('Sửa')
        $('#select_loaitk').attr('disabled', 'disabled');
        $.ajax({
            url: "./QLTaiKhoan/xuly.php",
            method: "GET",
            data: {tool:"GetTT",MaTK:MaTK},
            success:function(data) {
                $('#txt_MaTK').val(MaTK);
                $('#txt_TenTK').val(data.split('+')[0]);
                $('#txt_MK').val(data.split('+')[1]);
                $('#txt_UN').val(data.split('+')[2]);
                $('#txt_EM').val(data.split('+')[3]);
                $('#txt_SDT').val(data.split('+')[4]);
                $('#txt_DC').val(data.split('+')[5]);
                $('#select_loaitk').val(data.split('+')[6]);
                $('#select_tinhtrang').val(data.split('+')[7]);
            }
        })
    })
</script>