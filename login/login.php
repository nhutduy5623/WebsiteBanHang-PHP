<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../WebBH/fontawesome-free-6.1.0-web/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="./login.css">
    <title>Document</title>
</head>
<body>
<section id="form_SignIn" class="vh-150 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5"> 
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <form method="POST" class="mb-md-5 mt-md-4 pb-5" id="form_DN">

              <h2 class="fw-bold mb-2 text-uppercase">Đăng Nhập</h2>
              <p class="text-white-50 mb-5">Hãy Nhập Tài Khoản Và Mật Khẩu</p>

              <div class="form-outline form-white mb-4">
                <label class="form-label" for="TK">Tài Khoản</label>
                <input type="text" id="TK" class="form-control form-control-lg" />
                <span class = "span_Error"></span>
              </div>

              <div class="form-outline form-white mb-4">
                <label class="form-label" for="MK">Mật Khẩu</label>
                <input type="password" id="MK" class="form-control form-control-lg" />
                <span class = "span_Error"></span>
              </div>

              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Quên Mật Khẩu?</a></p>

              <input class="btn btn-outline-light btn-lg px-5 submit_form" id="Submit_DN" type="button" value="Đăng Nhập" >

              <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div>

            </form>

            <div>
              <p class="mb-0">Bạn Chưa Có Tài Khoản? <a href="#" onclick="changeForm(0)" class="text-white-50 fw-bold">Đăng Ký</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<section style="display: none;" id="form_SignUp" class="vh-150 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <form method="POST" id="form_DK" class="mb-md-5 mt-md-4 pb-5">
            
              <h2 class="fw-bold mb-2 text-uppercase">Đăng Ký</h2>
              <p class="text-white-50 mb-5">Hãy Nhập Đầy Đủ Thông Tin Đăng Ký</p>

                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="TK">Tài Khoản</label>
                    <input type="text" id="TK" class="form-control form-control-lg" />
                    <span class = "span_Error" id="span_DKTK"></span>
                </div>

                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="MK">Mật Khẩu</label>
                    <input type="password" id="MK" class="form-control form-control-lg" />
                    <span class = "span_Error"></span>
                </div>
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="NLMK">Nhập Lại Mật Khẩu</label>
                    <input type="password" id="NLMK" class="form-control form-control-lg" />
                    <span class = "span_Error"></span>
                </div>
              

                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="Email">Email</label>
                    <input type="text" id="Email" class="form-control form-control-lg" />
                    <span class = "span_Error" id="span_DKEM"></span>
                </div>
                <div class="form-outline form-white mb-4">
                    <label class="form-label" for="SDT">Điện Thoại</label>
                    <input type="text" id="SDT" class="form-control form-control-lg" />
                    <span class = "span_Error" id="span_DKSDT"></span>
                </div>
              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!"></a></p>
              <input class="btn btn-outline-light btn-lg px-5 btn_DN " id="Submit_DK" value="Đăng Ký" type="button">
            </form>
            <div>
              <p class="mb-0">Quay Lại Đăng Nhập? <a href="#" onclick="changeForm(1)" class="text-white-50 fw-bold">Đăng Nhập</a>
              </p>
              
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div id="xuly_Login"></div>
<?php
  if($_GET['action']=="DK")
  echo "<script>
  document.getElementById('form_SignUp').style.display='flex';
  document.getElementById('form_SignIn').style.display='none';
  </script>";
  else 
  echo "<script>
  document.getElementById('form_SignUp').style.display='none';
  document.getElementById('form_SignIn').style.display='flex';
  </script>";
?>
<script src="../Validator.js"></script>
<script>
  $('#Submit_DN').on('click',function(){
      var TaiKhoan = $('#TK').val();
      var MatKhau = $('#MK').val();
      var action="DN";
      var ktraTK = /^[a-zA-Z0-9]*$/;
      var ktraDoDai = /^[a-zA-Z0-9]{5,30}$/
      var ktraPASS = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
      if(!ktraTK.test(TaiKhoan)||!ktraPASS.test(MatKhau)||!ktraDoDai.test(TaiKhoan))
        alert("Thông tin không hợp lệ")
      else
        $.ajax({
          url: "xuly.php",
          method : "POST",
          data:{TK:TaiKhoan,MK:MatKhau,action:"DN"},
          success:function(data) {
            if(data=="0")
                alert("Sai tên đăng nhập hoặc mật khẩu");
            else
            {
                alert("Đăng nhập thành công")
                console.log(data);
                localStorage.setItem('TK', TaiKhoan);
                localStorage.setItem('MK', MatKhau);
                localStorage.setItem('LoaiTK', data);
                window.location="../index.php"
                // $("#xuly_Login").html(data);
            }   
              
          }
        })

    });

    Validator({
      form: '#form_DN',
      rules: [
        Validator.isAccount('#TK'),
        Validator.isPassWord('#MK'),
      ],
    });

    Validator({
      form: '#form_DK',
      rules: [
        Validator.isHaveAcc('#TK'),
        Validator.isHaveMail('#Email'),
        Validator.isHaveSDT('#SDT'),  
        // Validator.isAccount('#TK'),
        Validator.isPassWord('#MK'),
        Validator.isNLPassWord('#NLMK'),
        // Validator.isEmail('#Email'),
        // Validator.isPhoneNumber('#SDT'),

      ],
    });

    $('#Submit_DK').on('click',function(){
      var TaiKhoan = $('#form_DK #TK').val();
      TaiKhoan=TaiKhoan.toLowerCase().trim();
      var MatKhau = $('#form_DK #MK').val();
      console.log(TaiKhoan);
      console.log(MatKhau);
      var NLMK = $('#NLMK').val();
      var Email = $('#Email').val();
      Email=Email.toLowerCase().trim();
      var SDT = $('#SDT').val();
      console.log(NLMK);
      console.log(Email);
      console.log(SDT);

      var ktraTK = /^[a-zA-Z0-9]*$/;
      var ktraDoDai = /^[a-zA-Z0-9]{5,30}$/
      var ktraPASS = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
      var ktraSDT = /^[0-9]{9,10}$/;
      var ktraEmail = /^[A-Za-z][\w$.]+@[\w]+\.\w+$/;
      var ErroTK_Value = document.getElementById('span_DKTK').innerHTML;
      var ErroEM_Value = document.getElementById('span_DKEM').innerHTML;
      var ErroSDT_Value = document.getElementById('span_DKSDT').innerHTML;
      if(!ktraTK.test(TaiKhoan)||!ktraPASS.test(MatKhau)||!ktraDoDai.test(TaiKhoan)||!ktraEmail.test(Email)||!ktraSDT.test(SDT)||MatKhau!=NLMK||ErroTK_Value!=""||ErroEM_Value!=""||ErroSDT_Value!="")
        alert("Thông tin không hợp lệ")
      else
        $.ajax ({
          url: "xuly.php",
          method : "POST",
          data:{TK:TaiKhoan,MK:MatKhau,Email:Email,SDT:SDT,action:"DK"},
          success:function(data) {
                console.log(data);
                alert('Đăng ký thành công')
                localStorage.setItem('TK',TaiKhoan);
                localStorage.setItem('MK',MatKhau);
                localStorage.setItem('LoaiTK', '2');
                window.location="../index.php"
          }
        })

    })

    function changeForm(i) {
        if(i==1)
          {
            document.getElementById('form_SignUp').style.display='none';
            document.getElementById('form_SignIn').style.display='flex';
          }
        else
        {
            document.getElementById('form_SignUp').style.display='flex';
            document.getElementById('form_SignIn').style.display='none';
        }

    }


    //check trùng 
    // $(document).ready(function(){
    //   $("#form_DK #TK").blur(function(){
    //     var val = $("#form_DK #TK").val();
    //     $.post("KtraTrung.php", {TK:val}, function(data){
    //         if(data!=0)
    //         $('#form_DK #TK span_Error').html("Tài khoảng đã có người sử dụng")
    //         else
    //         $('#form_DK #TK span_Error').html('')
    //     })
    //   })
    // }) 
</script>
</body>
</html>