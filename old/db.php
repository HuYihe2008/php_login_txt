<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8"> 
        <title>呼号注册</title>
        <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.2.0-beta1/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/index.css" rel="stylesheet">
        <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.2.0-beta1/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-repeat:no-repeat; background-size:100% 100%; background-attachment: fixed;" background="http://api.btstu.cn/sjbz/?lx=dongman">
<style>
        .modal-dialog {
        opacity: 0.75;
        position: absolute;
        top: 50%;
        width: 100%;
        left: 50%;
        z-index: 3;
        margin: auto; 
        -webkit-transform: translate(-50%, -50%) !important;
        -moz-transform: translate(-50%, -50%) !important;
        -ms-transform: translate(-50%, -50%) !important;
        -o-transform: translate(-50%, -50%) !important;
        transform: translate(-50%, -50%) !important;
    }
</style>
<script>
    window.onload = function() {
        $("#reg").modal({show:true, backdrop: 'static', keyboard: false}); 
        $("#reg").modal('show');
    };

    function submit() {
        $("#reg_form").submit();
    }
    function gennum() {
        $("input[name='num']").val(parseInt(Math.random() * (9999 - 1000 + 1) + 1000));
        return false;
    }
</script>
<div id="reg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                <h5 class="modal-title">呼号注册</h5>
            </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="post" id="reg_form">
                    <div class="input-group form-group">
                        <input class="form-control required" type="text" placeholder="3位大写字母,例: CSC" name="acc" maxlength="3"/>
                        <input class="form-control required" type="text" placeholder="4位数字,例: 1000" name="num" maxlength="4"/>
                        <button class="btn btn-primary" onclick="return gennum()">自动生成呼号</button>
                    </div>
                    <div class="input-group form-group">
                        <input class="form-control required" type="password" placeholder="密码" name="pwd"/>
                    </div>
                    <input class="form-control" type="hidden" name="name"/>
                    <input class="form-control" type="hidden" name="captTicket"/>
                    <input class="form-control" type="hidden" name="captStr"/>
                </form>
                        </div>
            <div class="modal-footer">
		<div class="btn-group">
                    <!-- See Tencent captcha docs (data-appid) -->
                    <!-- button id="TencentCaptcha" class="btn btn-secondary" data-appid="" data-cbfn="captexec" type="button">注册</button -->
                    <button class="btn btn-secondary" onclick="submit()">注册</button>
                    </div>  
        <div class="footer">
                    <footer>
                        <p>本注册系统版权归JamYido所有</p>
                    </footer>
                    </div>
            <div class="modal-backdrop">        
            </div>
        <div>
    </div>

</div>
</body>
</html>

<?php

function alert($message) {
    echo "<script type='text/javascript'>";
    echo "alert('".$message."');";
    echo "</script>";
}
$post = $_POST;
if (empty($post))
    return;
    
    if ($post['num'] == null) {
        alert("必须填写呼号");
        return;
    }
    if ($post['acc'] == null) {
        alert("必须填写航司");
        return;
    }
    if ($post['pwd'] == null) {
        alert("必须填写密码");
        return;
    }
    $acc = $post['acc'];
    $acc_len = strlen($acc);
    $num = $post['num'];
    $num_len = strlen($num);
    $pwd = $post['pwd'];
    $pwd_len = strlen($pwd);

    if ($acc_len !== (int)"3") {
        alert("格式不正确");
        return;
    }
    if ($num_len !== (int)"4") {
        alert("格式不正确");
        return;
    }
    if (!is_numeric($num)) {
        alert("格式不正确");
        return;
    }
    if (!ctype_alpha($acc)) {
        alert("格式不正确");
        return;
    }
    if (mb_strtoupper($acc) !== $acc) {
        alert("格式不正确");
        return;
    }
    if (strstr($acc, ";")) {
        alert("航司不能包含分号");
        return;
    }
    if (strstr($acc, "'")) {
        alert("航司不能包含引号");
        return;
    }
    if (strstr($acc, '"')) {
        alert("航司不能包含引号");
        return;
    }
    if (strstr($post['num'], ";")) {
        alert("呼号不能包含分号");
        return;
    }
    if (strstr($post['num'], "'")) {
        alert("呼号不能包含引号");
        return;
    }
    if (strstr($post['num'], '"')) {
        alert("呼号不能包含引号");
        return;
    }
    $filename="/cscfsx/fsd/cert.txt";   

    $handler=fopen($filename,"r");
    if(!feof($handler))
    {
        $m = fgets($handler); //fgets逐行读取，4096最大长度，默认为1024
        if(substr_count($m,"$acc$num")) //查找字符串
            {
                alert("这个呼号注册了哦！换一个吧");
                alert("系统信息：code:6886 message:The acc is init");
                fclose($handler); //关闭文件
                return;
            } else{
                $handle=fopen($filename,"a+");    
                $str=fwrite($handle,"$acc$num $pwd 1 \n");
                fclose($handle);
                alert("注册成功,请等待20秒后尝试登录哦！祝你有一个快乐的飞行之旅！");
                alert("系统信息：ncode:6886 message:ok");
                return;
            }
            
    } else {
        alert("注册失败");
        alert("系统信息：code:6886 message:Not Found Server");
        fclose($handler); //关闭文件
        return;
    }
    
?>