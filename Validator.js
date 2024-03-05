function Validator(options) {
    var formElement = document.querySelector(options.form);
    if(formElement)
    {
        console.log(formElement);
        options.rules.forEach(function (rule) {
            var inputElement = formElement.querySelector(rule.selector);
            if(inputElement) {
                inputElement.onblur = function() {
                    console.log('blur' + rule.selector);
                    input_Value = inputElement.value;
                    var erroMessage = rule.test(input_Value);
                    console.log(inputElement);
                    var erroElement = inputElement.parentElement.querySelector('.span_Error');
                    if(erroMessage)
                    {
                        erroElement.innerText = erroMessage;
                        inputElement.classList.add('InputError');
                    }
                    else
                    {
                        erroElement.innerText = "";
                        inputElement.classList.remove('InputError');
                    }
                }
            }
        });
    }
}
Validator.isRequired = function(Selector) {
    return {
        selector: Selector,
        test: function (value) {
            return value.trim() ? undefined : 'Không Được Bỏ Trống'
        }
    };
}
Validator.isAccount = function(Selector) {
    return {
        selector: Selector,
        test: function (value) {
            var ktraDoDai = /^[a-zA-Z0-9]{5,30}$/;
            var ktraTK = /^[a-zA-Z0-9]*$/;
            if(!value.trim())
            return 'Không Được Bỏ Trống'
            else if(!ktraTK.test(value)) 
            return 'Tài khoản đang chứa ký tự đặt biệt'
            else if(!ktraDoDai.test(value))
            return 'Tên Tài Khoản Phải Trên 5 và nhỏ hơn 30 ký tự'
            else
            return undefined;
        }
    };
}
Validator.isEmail = function(Selector) {
    return {
        selector: Selector,
        test: function (value) {
            ktraEmail=/^[A-Za-z][\w$.]+@[\w]+\.\w+$/
            if(!value.trim())
            return 'Không Được Bỏ Trống'
            else if(!ktraEmail.test(value))
            return 'Email không hợp lệ'
            else
            return undefined; 
        }
    };
}
Validator.isPassWord = function(Selector) {
    return {
        selector: Selector,
        test: function (value) {
            var ktraPASS = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
            if(!value.trim())
            return 'Không Được Bỏ Trống'
            else if(!ktraPASS.test(value))
            return 'Tối thiểu tám ký tự, ít nhất một chữ cái và một số:'
            else
            return undefined;
        }
    };
}
Validator.isPhoneNumber = function(Selector) {
    return {
        selector: Selector,
        test: function (value) {
            ktraSDT=/^[0-9]{9,10}$/
            if(!value.trim())
            return 'Không Được Bỏ Trống'
            else if(!ktraSDT.test(value))
            return 'SĐT phải có 9-10 ký tự và ở dạng số'
            else
            return undefined; 
        }
    };
}
Validator.isNLPassWord = function(Selector) {
    return {
        selector: Selector,
        test: function (value) {
            var MatKhau = document.querySelector('#form_SignUp #MK').value;
            if(MatKhau!=value)
            return 'Mật khẩu không trùng khớp'
            else
            return undefined;
        }
    };
}

Validator.isHaveAcc = function(Selector) {
    var s=0;
    return {
        selector: Selector,
        test: function (value) {
            var ktraDoDai = /^[a-zA-Z0-9]{5,30}$/;
            var ktraTK = /^[a-zA-Z0-9]*$/;
            if(!value.trim())
            return 'Không Được Bỏ Trống'
            else if(!ktraTK.test(value)) 
            return 'Tài khoản đang chứa ký tự đặt biệt'
            else if(!ktraDoDai.test(value))
            return 'Tên Tài Khoản Phải Trên 5 và nhỏ hơn 30 ký tự'
            else
            {
                $.ajax({
                    url: "KtraTrung.php",
                    method: "POST",
                    data: {TK:value},
                    success:function(data){
                        console.log("data="+data!=0);
                        s=data;
                        
                        if(data!=0)
                        document.getElementById('span_DKTK').innerHTML='Tài khoảng đã có người sử dụng';
                        else 
                        document.querySelector('#span_DKTK').setText='';
                    }                   
                })      
            }
            
        }
    }
} 
Validator.isHaveMail = function(Selector) {
    var s=0;
    return {
        selector: Selector,
        test: function (value) {
            ktraEmail=/^[A-Za-z][\w$.]+@[\w]+\.\w+$/
            if(!value.trim())
            return 'Không Được Bỏ Trống'
            else if(!ktraEmail.test(value))
            return 'Email không hợp lệ'
            else
            $.ajax({
                url: "KtraTrung.php",
                method: "POST",
                data: {Email:value},
                success:function(data){
                    if(data!=0)
                        document.getElementById('span_DKEM').innerHTML='Email đã có người sử dụng';
                        else 
                        document.querySelector('#span_DKEM').setText='';
                }
            }) 
        }
    }
} 
Validator.isHaveSDT = function(Selector) {
    var s=0;
    return {
        selector: Selector,
        test: function (value) {
            ktraSDT=/^[0-9]{9,10}$/
            if(!value.trim())
            return 'Không Được Bỏ Trống'
            else if(!ktraSDT.test(value))
            return 'SĐT phải có 9-10 ký tự và ở dạng số'
            else
            $.ajax({
                url: "KtraTrung.php",
                method: "POST",
                data: {SDT:value},
                success:function(data){
                    if(data!=0)
                        document.getElementById('span_DKSDT').innerHTML='Số điện thoại đã có người sử dụng';
                        else 
                        document.querySelector('#span_DKSDT').setText='';
                }
            }) 
        }
        
        
    }
    
} 



