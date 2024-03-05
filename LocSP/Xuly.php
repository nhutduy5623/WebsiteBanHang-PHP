<?php
    include '../config.php';
    $MaLoai = $_POST['Maloai'];
    $Trang = $_POST['Trang'];
    $TimKiem = "";
    if($_POST['TimKiem'])
    $TimKiem = $_POST['TimKiem'];
    //Tính số trang
    $GiaTu = 0;
    $GiaDen = 9000000000;
    if(isset($_POST['GiaTu'])&&$_POST['GiaDen'])
    if ($_POST['GiaTu']!="" && $_POST['GiaDen']!="") {
        $GiaTu = $_POST['GiaTu'];
        $GiaDen = $_POST['GiaDen'];
    }
    $SX="BT";
    $TT="BT";
    
    if(isset($_POST['SX'])&&$_POST['SX']!="BT")
    {
        $SX = $_POST['SX'];
        $TT = $_POST['ThuTu'];
        if($SX == 'G')
            $SX="GiaSP";
        else
            $SX="TenSP";
        if($TT == "GD")
            $TT='DESC';
        else {
            $TT='ASC';
        }
    }
    echo "<script>console.log('$SX')</script>";
    echo "<script>console.log('Gia Tu $GiaTu Den $GiaDen')</script>";
    if($TimKiem=="")
    {
        if($SX!="BT")
        {
            $dataSP = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and GiaSP>=$GiaTu and GiaSP<=$GiaDen ORDER BY $SX $TT");
            if($MaLoai!=0)
            $dataSP = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and MaLoai=$MaLoai and GiaSP>=$GiaTu and GiaSP<=$GiaDen ORDER BY $SX $TT");   
        }
        else
            {
                $dataSP = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and GiaSP>=$GiaTu and GiaSP<=$GiaDen");
            if($MaLoai!=0)
            $dataSP = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and MaLoai=$MaLoai and GiaSP>=$GiaTu and GiaSP<=$GiaDen");   
            }
    } 
    else
    {
        if($SX!="BT")
        {
            $dataSP = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and TenSP LIKE '%$TimKiem%' and GiaSP>=$GiaTu and GiaSP<=$GiaDen ORDER BY $SX $TT");
            if($MaLoai!=0)
            $dataSP = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and MaLoai=$MaLoai and TenSP LIKE '%$TimKiem%' and GiaSP>=$GiaTu and GiaSP<=$GiaDen ORDER BY $SX $TT");   
        }
        else
        {
            $dataSP = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and TenSP LIKE '%$TimKiem%' and GiaSP>=$GiaTu and GiaSP<=$GiaDen");
            if($MaLoai!=0)
            $dataSP = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and MaLoai=$MaLoai and GiaSP>=$GiaTu and GiaSP<=$GiaDen and TenSP LIKE '%$TimKiem%'");   
        }
    }
    $soluongSP = mysqli_num_rows($dataSP);
    $SoSP1Trang = 8;    
    $SoSP1Trang=$_POST['SoSP1trang'];
    $TuSP = $Trang*$SoSP1Trang-$SoSP1Trang;
    $SoTrang = $soluongSP/$SoSP1Trang;
    echo "<script>
    console.log($SoSP1Trang);
    </script>";
    //Lọc sản phẩm
    if($TimKiem == "")
    {
        if($SX!="BT")
        {
            $dataSPshow = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and GiaSP>=$GiaTu and GiaSP<=$GiaDen ORDER BY $SX $TT LIMIT $TuSP,$SoSP1Trang ");
            if($MaLoai!=0)
            $dataSPshow = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and MaLoai=$MaLoai and GiaSP>=$GiaTu and GiaSP<=$GiaDen ORDER BY $SX $TT LIMIT $TuSP,$SoSP1Trang");
        }
        else
        {   
            $dataSPshow = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and GiaSP>=$GiaTu and GiaSP<=$GiaDen LIMIT $TuSP,$SoSP1Trang ");
            if($MaLoai!=0)
            $dataSPshow = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and MaLoai=$MaLoai and GiaSP>=$GiaTu and GiaSP<=$GiaDen LIMIT $TuSP,$SoSP1Trang");
        }
    }
    else
    {
        if($SX!="BT")
        {
            $dataSPshow = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and TenSP LIKE '%$TimKiem%' and GiaSP>=$GiaTu and GiaSP<=$GiaDen ORDER BY $SX $TT LIMIT $TuSP,$SoSP1Trang");
            if($MaLoai!=0)
            $dataSPshow = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and MaLoai=$MaLoai and TenSP LIKE '%$TimKiem%' and GiaSP>=$GiaTu and GiaSP<=$GiaDen ORDER BY $SX $TT LIMIT $TuSP,$SoSP1Trang");
        }
        else
        {
            $dataSPshow = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and TenSP LIKE '%$TimKiem%' and GiaSP>=$GiaTu and GiaSP<=$GiaDen LIMIT $TuSP,$SoSP1Trang");
            if($MaLoai!=0)
            $dataSPshow = mysqli_query($conn, "SELECT * FROM sanpham where TinhTrang=1 and MaLoai=$MaLoai and TenSP LIKE '%$TimKiem%' and GiaSP>=$GiaTu and GiaSP<=$GiaDen LIMIT $TuSP,$SoSP1Trang");
        }
    }
    
?>
<div id="show_SP">
    <?php
        while($rowSP = mysqli_fetch_array($dataSPshow))
        {
            $MaSP = $rowSP['MaSP'];
            $img = $rowSP['HinhAnh'];
            $TenSP = $rowSP['TenSP'];
            $GiaSP = $rowSP['GiaSP'];
            ?>
                <div class="SP" id="SP_<?php echo $MaSP?>">
                    <img id="img_SP" id="img_<?php echo $MaSP?>"src="./img/<?php echo $img?>" alt="">
                    <p class="name_SP" id="NameSP_<?php echo $MaSP?>"><?php echo $TenSP?></p>      
                    <p class="gia_SP" id="giaSP_<?php echo $MaSP?>"><?php echo $GiaSP?></p>
                </div>
            <?php
        }
    ?>
</div>
<div id="PhanTrang">
    <?php
        if($soluongSP>$SoSP1Trang)
        for($i=1; $i<$SoTrang+1; $i++)
        {
            ?>
                <input type="button" class="SoTrang" id="SoTrang_<?php echo $i?>" value="<?php echo $i?>">
            <?php
        }
    ?>
</div>
<script>
    $('.SoTrang').on('click', function(){
    idElement = this.getAttribute('id');
    SoTrang = idElement.split("SoTrang_")[1];
    Maloai = sessionStorage.getItem("MaLoai");
    TimKiem = $('.search_input').val();
    console.log(Maloai);
    // Lọc v
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
    // Lọc ^
    SoSP1trang = 8;
    SoSP1trang = $('#selectSLSP').val();
    $.ajax({
        url: "./LocSP/xuly.php",
        method: "POST",
        data: {Maloai:Maloai, Trang:SoTrang, TimKiem:TimKiem, GiaTu:GiaTu, GiaDen:GiaDen, SX:SX, ThuTu:ThuTu, SoSP1trang:SoSP1trang},
        success:function(data){
            $("#content").html(data);
        }
    })  
    
})



// Show Thông tin sản phẩm
$('.SP').on('click', function(){
    idElement = this.getAttribute('id');
    MaSP = idElement.split('SP_')[1];
    $.ajax({
        url: './ThongTinSP/xuly.php',
        method: 'POST',
        data: {tool:"getTTSP",MaSP:MaSP},
        success:function(data){            
            document.querySelector('#TTSP_NameSP').innerHTML=data.split('+')[0];
            document.querySelector('.TTSP_img').src = "./img/"+data.split('+')[1];
            document.querySelector('.TTSP_gia').innerHTML=data.split('+')[2];
            document.querySelector('.TTSP_ttbh').innerHTML=data.split('+')[3];
            document.querySelector('.TTSP_SLCL').innerHTML=data.split('+')[5];
            document.querySelector('#TTSP_SLCL').value=data.split('+')[5];
            document.querySelector('#TTSP_MaSP').value=MaSP;
            document.querySelector('#TTSP_MaGBH').value = data.split('+')[4];
            document.getElementById('layer_TTSP').style.display ="flex";
            
        }
    })
})
</script>

<style>

</style>