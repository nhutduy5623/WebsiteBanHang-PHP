<?php
    $sqlDataLoai = mysqli_query($conn, "SELECT * FROM loaisp");
    ?>
            <a href="#" class="PhanLoai" id="Loai_0">Tất Cả</a>
    <?php
    while($rowLSP = mysqli_fetch_array($sqlDataLoai))
    {
        ?>
            <a class="PhanLoai" id="Loai_<?php echo $rowLSP['MaLoai']?>" href="#"><?php echo $rowLSP['TenLoai']?></a>
        <?php
    }
?>
<style>

</style>
<script>
    if (!sessionStorage.getItem("MaLoai"))
    sessionStorage.setItem("MaLoai",0);
    if (!sessionStorage.getItem("TimKiem"))
    sessionStorage.setItem("TimKiem","");

    $('.PhanLoai').on('click', function(){
        document.getElementById('GioHang').style.display = "none";
        document.getElementById('DonHang').style.display = "none";
        document.getElementById('iconGH').style.display="flex";
        document.getElementById('iconDH').style.display="none";
        idElement = this.getAttribute('id');
        Maloai = idElement.split("Loai_")[1];
        console.log(Maloai);
        sessionStorage.setItem("MaLoai",Maloai);
        TimKiem = $('.search_input').val();

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
            data: {Maloai:Maloai, Trang:"1", TimKiem:TimKiem, GiaTu:GiaTu, GiaDen:GiaDen, SX:SX, ThuTu:ThuTu, SoSP1trang:SoSP1trang},
            success:function(data){
                $("#content").html(data);   
            }
        })
    })

    $('.search_icon').on('click', function(){
        Maloai = sessionStorage.getItem("MaLoai");        
        TimKiem = $('.search_input').val();
        console.log(TimKiem);
        // sessionStorage.setItem("TimKiem",TimKiem);
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
            data: {Maloai:Maloai, TimKiem:TimKiem, Trang:"1", GiaTu:GiaTu, GiaDen:GiaDen, SX:SX, ThuTu:ThuTu, SoSP1trang:SoSP1trang},
            success:function(data){
                $("#content").html(data);
            }
        }) 
    })



    
</script>