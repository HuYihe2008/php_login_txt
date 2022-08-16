//注册
window.captexec = function (res) {
    if (res.ret === 0) {
        $("div[name='cap']").val(res.ticket);
        $("#reg_form").submit_reg();
    }
}
window.onload = function() {
    //$("#reg").modal({show:true, backdrop: 'static', keyboard: false}); 
    //$("#reg").modal('show');
};
function submit_reg() {
    $("#reg_form").submit_reg();
}
//登录
window.captexec = function (log) {
    if (log.ret === 0) {
        $("div[name='cap']").val(log.ticket);
        $("#log_form").submit_log();
    }
}
window.onload = function() {
    //$("#reg").modal({show:true, backdrop: 'static', keyboard: false}); 
    //$("#reg").modal('show');
};
function submit_log() {
    $("#log_form").submit_log();
}

        //要操作到的元素
        let login = document.getElementById("login");
        let register = document.getElementById("register");
        let form_box = document.getElementsByClassName("from-box")[0];
        let register_box = document.getElementsByClassName("register-box")[0];
        let login_box = document.getElementsByClassName("login-box")[0];
        //点击去注册按钮点击事件
        register.addEventListener('click',()=>{
            form_box.style.transform='translateX(82%)';
            login_box.classList.add('hidden');
            register_box.classList.remove('hidden');
        })
        //点击去登录按钮点击事件
        login.addEventListener('click',()=>{
            form_box.style.transform='translateX(0%)';
            register_box.classList.add('hidden');
            login_box.classList.remove('hidden');
        })

        function ValidateValue(textbox) {
            var IllegalString = "[`~!#$^&*()=|{}':;',\\[\\].<>/?~！#￥……&*（）——|{}【】‘；：”“'。，、？]‘'";
            var textboxvalue = textbox.value;
            var index = textboxvalue.length - 1;
            
            var s = textbox.value.charAt(index);
            
            if (IllegalString.indexOf(s) >= 0) {
            s = textboxvalue.substring(0, index);
            textbox.value = s;
            }
            }