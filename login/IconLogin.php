<div id="header_DN_DK">
    <a href="./login/login.php?action=DK" class="TK_DN_DK_DX" id="header_DK">Đăng Ký</a>
    <div class="dauxuyet">|</div>
    <a href="./login/login.php?action=DN" class="TK_DN_DK_DX" id="header_DN">Đăng Nhập</a>
</div>
<div id="header_TTK_DX" style="display: none;"> 
    <div class="TK_DN_DK_DX" id="header_TTK"></div>
    <div class="dauxuyet">|</div>
    <div class="TK_DN_DK_DX" id="header_DX">Đăng Xuất</div>
</div>

<style>
    #header_DN_DK {
        width: 100% !important;
        height: 100%;
        display: flex;
        flex-direction: row;
        float: right;
        justify-content: center;
    }
    #header_TTK_DX {
        width: 100% !important;
        height: 100%;
        display: flex;
        flex-direction: row;
        float: right;
        justify-content: center;
    }
    .dauxuyet {
        color: white;
    }
    .TK_DN_DK_DX {
        margin: 0 1%;
        color: white;
    }
    .TK_DN_DK_DX:hover {
        cursor: pointer;
        color: #94b0b7;
    }
</style>


<!--  onclick DangNhap_DangXuat -->
<script>
    $('#header_DN').on('click', function(){

    })
    $('#header_DK').on('click', function(){
        
    })
    $('#header_DX').on('click', function(){
        localStorage.setItem('TK',"");
        localStorage.setItem('MK',"");
        localStorage.setItem('LoaiTK',"");
        HienThiDN_TTK();
        window.location.reload();

        
    })
    $('#header_DN').on('click', function(){
        
    })
</script>

<!-- Hiển thị tên đăng nhập hoặc button đăng nhập, giỏ hàng -->
<script>
    window.onload = function() {
        HienThiDN_TTK();
    };
    function HienThiDN_TTK(){
    if(typeof localStorage.getItem('TK') == "undefined")
    {
        localStorage.setItem('TK',"");
        localStorage.setItem('MK',"");
        localStorage.setItem('LoaiTK',"");
    }
    var TK = localStorage.getItem('TK');
    var MK = localStorage.getItem('MK');
    var LoaiTK = localStorage.getItem('LoaiTK');
    console.log(TK);
    if(TK!="") {
        $.ajax({
          url: "./login/checkTKLocalstorage.php",
          method : "POST",
          data:{TK:TK, MK:MK, LoaiTK:LoaiTK},
          success:function(data) {  
            console.log(data);
            if(data=="0")
            {
                localStorage.setItem('TK',"");
                localStorage.setItem('MK',"");
                localStorage.setItem('LoaiTK',"");                
            }
            else
            {
                document.getElementById('header_TTK_DX').style.display="flex";
                document.getElementById('header_DN_DK').style.display="none";
                document.getElementById('header_TTK').innerHTML=TK;
                if(LoaiTK==2)
                    {
                        document.getElementById('Icon_GH').style.display='flex'
                        document.getElementById('Icon_QL').style.display='none'
                    }
                else if(LoaiTK==1 || LoaiTK==2 || LoaiTK==3)
                    {
                        document.getElementById('Icon_QL').style.display='flex'
                        document.getElementById('Icon_GH').style.display='none'
                    }
                else 
                    {
                        document.getElementById('Icon_QL').style.display='none'
                        document.getElementById('Icon_GH').style.display='none'
                    }

            }   
              
          }
        })
    }
    else 
    {
        console.log('Đăng xuất');
        document.getElementById('header_TTK_DX').style.display="none";
        document.getElementById('header_DN_DK').style.display="flex";
    }

    };


</script>