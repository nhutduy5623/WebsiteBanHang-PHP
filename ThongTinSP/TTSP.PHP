
<div class="layer_TTSP" id="layer_TTSP">
    <div class="TTSP">
        <div class="TTSP_name">
            <p id="TTSP_NameSP"></p>
            <i class="fa-solid fa-xmark" id="Btn_CloseTTSP" onclick="closeTTSP()"></i>
        </div>
        <div class="TTSP_main">
            <img class="TTSP_img" src="" alt="">
            <div class="TTSP_ttsp">
                <div class="TTSP_gia" style="color: black; border-bottom: 1px solid black; margin-bottom: 2%;"></div>
                <div style="font-weight: 300; font-size: 70%; display: inline-flex;" >Còn Lại:  <p style="margin: 0 2px;" class="TTSP_SLCL"></p> SP </div>
                <input id="TTSP_SLCL" type="button" value="" style="background-color: #00000000; opacity: 0; height: 0px; width: 0px; font-size: 0px;">
                <label for="" style="font-size: 80%; font-weight: 100; margin-top:1%;">Bảo Hành:</label>
                <div class="TTSP_ttbh"></div>
                <input id="TTSP_MaGBH" type="button" value="" style="background-color: #00000000; opacity: 0; height: 0px; width: 0px; font-size: 0px;">
                <div class="btn_changeSL_Buy">
                    <div class="ChangeSL">
                        <input id="val_SLSP" type="number" value="1" max="20" min="1">
                    </div>
                    <input type="button" class="TTSP_clickbuy" onclick="" value="Buy">
                    <input id="TTSP_MaSP" type="button" value="" style="background-color: #00000000; opacity: 0; height: 0px; width: 0px; font-size: 0px;">
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="./ThongTinSP/TTSP.css">
<style>
    .TTSP {
        background-color: white;
        border-radius: 1%;
        border: solid 2px black;
    }
    .TTSP_name {
        border-bottom: 1px solid black;

    }
    #Btn_CloseTTSP:hover {
        cursor: pointer;
        color: teal;
    }
</style>
<script>
    
    function closeTTSP(){
        document.querySelector('.layer_TTSP').style.display ="none";
    }
    
    $('.TTSP_clickbuy').on('click', function(){
        MaSP = $('#TTSP_MaSP').val();
        MaGBH = $('#TTSP_MaGBH').val();
        soLuong = parseInt($('#val_SLSP').val());
        soLuongCL = parseInt($('#TTSP_SLCL').val());
        TK = localStorage.getItem('TK');
        if(localStorage.getItem('TK')!="")
        {
            if(soLuong>0 && soLuong<=soLuongCL){
                $.ajax({
                url:'./GioHang/xuly.php',
                method: 'POST',
                data: {action:"addSPGH",TK:TK,MaSP:MaSP,MaGBH:MaGBH,soLuong:soLuong},
                success:function(data){
                    //console.log(data);
                    soLuongCL=soLuongCL-soLuong;
                     $('#TTSP_SLCL').val(soLuongCL);
                     $('.TTSP_SLCL').html(soLuongCL);
                }
                })
            }
            else
            {
                console.log('Khi khong hop le')
                console.log(soLuongCL)
                console.log(soLuong)
                console.log(soLuong>0 && soLuong<=soLuongCL)
                alert("Số lượng không hợp lệ");
            }
        }
        else
            alert("Vui lòng đăng nhập!!");

    })
</script>