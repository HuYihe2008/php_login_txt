<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://www.recaptcha.net/recaptcha/api.js' async defer ></script>
    <script src='js/index.js' async defer ></script>
    <title>呼号系统注册页</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <div class="from-box">
            <!-- 登录 -->
            <form class="login-box" id="log_form" method="post">
                <h1>查询呼号</h1>
                <!--input type="text" placeholder="用户名">
                <input type="password" placeholder="密码">
                <button>登录</button-->
                <input onkeyup="this.value=this.value.replace(/[, ]/g,'')" type="text" placeholder="3位大写字母,例: CSC" name="acc_log" maxlength="3"/>     
                <input onkeyup="this.value=this.value.replace(/[, ]/g,'')" type="text" placeholder="4位数字,例: 1000" name="num_log" maxlength="4"/>
                <input onkeyup="this.value=this.value.replace(/[, ]/g,'')" type="password" placeholder="密码" name="pwd_log"/>
                <input onkeyup="this.value=this.value.replace(/[, ]/g,'')" type="number" placeholder="权限" name="level_log" min="1" max="12"/>
                <input type="hidden" name="name"/>
                <!--<div class="g-recaptcha" data-sitekey="6LeZ-G0eAAAAAILOGZvW2DWFXCVuRW9K2HaSQtKn" data-theme="dark"></div>-->
                <button onclick="submit_log()">查询</button>
            </form>
            <!-- 注册 -->
            <form class="register-box hidden" method="post" id="reg_form">            
                <h1>注册</h1>
                <input onkeyup="this.value=this.value.replace(/[, ]/g,'')" type="text" placeholder="3位大写字母,例: CSC" name="acc" maxlength="3"/>
                <input onkeyup="this.value=this.value.replace(/[, ]/g,'')" type="text" placeholder="4位数字,例: 1000" name="num" maxlength="4"/>    
                <input onkeyup="this.value=this.value.replace(/[, ]/g,'')" type="password" placeholder="密码" name="pwd"/>
                <!--input type="number" placeholder="权限" name="level"/-->
                <input type="hidden" name="name"/>
                <!--<div class="g-recaptcha" data-sitekey="6LeZ-G0eAAAAAILOGZvW2DWFXCVuRW9K2HaSQtKn" data-theme="dark"></div> -->   
                <button onclick="submit_reg()">注册</button>                
            </form>
        </div>
        <div class="con-box left">
            <h3><span>标题1</span></h3>  
            <p>快来领取你的<span>账号</span>吧</p>          
            <img src="./images/1.png" alt="">
            <p>已有账号？</p>
            <button id="login">去登录</button>
        </div>
        <div class="con-box right">
            <h3><span>标题1</span></h3>  
            <p>快来领取你的<span>账号</span>吧</p>   
            <img src="./images/2.png" alt="">
            <p>没有账号?</p>
            <button id="register">去注册</button>
        </div>
    </div>
    <div class="footer">
        <footer>
            <p>本注册系统制作版权归yido酱_official所有</p>
            <p>授权使用方：标题1</p>
            <p>托管方：yido酱_official</p>
        </footer>
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


//验证码区域
/*    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        if (strstr($_POST['g-recaptcha-response'] , " " )) {
            alert("it has problem");
            return;
        } else {

            $secretKey   = "6LeZ-G0eAAAAALstmpOBIyTfHC30fhHw4zXnux10";
            $responseKey = $_POST['g-recaptcha-response'];
            $userIP      = $_SERVER['REMOTE_ADDR'];
            $url         = "https://www.recaptcha.net/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
            $response    = file_get_contents($url);
            $response    = json_decode($response);
    
            if($response->success){
                alert("人机验证成功！") ;
                alert("code:6886_seccess message:login in human");
                }        
            } 
        }   else {
            alert("人机验证失败！请重试！");
            alert("code:6886_unseccess message:Are You human?");
            return;
        }
*/
// 验证区域
    if ( $post['acc'] == null) {
        if ( $post['acc_log'] == null) {
            alert("必须填写航司");
            return;
        } 
    } 
   /* if ( $post['level'] == null) {
        if ( $post['level_log'] == null) {
            alert("必须填写权限");
            return;
        } 
    }*/
    if ( $post['pwd'] == null) {
        if ( $post['pwd_log'] == null) {
            alert("必须填写密码");
            return;
        }
    }  
    
    $acc = $post['acc'];
    $acc_len = strlen($acc);
    $num = $post['num'];
    $num_len = strlen($num);
    $pwd = $post['pwd'];
    $pwd_len = strlen($pwd);
    $level = $post['level'];
    $level_len = strlen($level);
    $acc_log = $post['acc_log'];
    $acc_len_log = strlen($acc_log);
    $num_log = $post['num_log'];
    $num_len_log = strlen($num_log);
    $pwd_log = $post['pwd_log'];
    $pwd_len_log = strlen($pwd_log);
    $level_log = $post['level_log'];
    $level_len_log = strlen($level_log);

    if ($acc_len !== (int)"3") {
        if ($acc_len_log !== (int)"3") {
            alert("格式不正确");
            return;
        }
    }
    if ($num_len !== (int)"4") {
        if ($num_len_log !== (int)"4") {
            alert("格式不正确");
            return;
        }
    }
/*    if (!is_numeric($num)) {
        if (!is_numeric($num_log)) {
            alert("格式不正确");
            return;
        }
    }
    if(!empty($level)){
        if($level > 12 ){
            alert("就十二个等级你哪里冒出的$level");
            return;
        }
        if (!is_numeric($level)) {
                alert("格式不正确");
                return;
        }
    }
    if(!empty("$level_log")) {
        if ($level_log > 12 ) {
            alert("就十二个等级你哪里冒出的$level");
            return;
        }
        if (!is_numeric($level_log)) {
            alert("格式不正确");
            return;
        }
    }*/
    if (!ctype_alpha($acc)) {
        if (!ctype_alpha($acc_log)) {
            alert("格式不正确");
            return;
        }
    }
    if (mb_strtoupper($acc) !== $acc) {
        if (mb_strtoupper($acc_log) !== $acc_log) {
            alert("格式不正确");
            return;
        }
    }
    if (strstr($acc, ";")) {
        if (strstr($acc_log, ";")) {
            alert("航司不能包含分号");
            return;
        }
    }
    if (strstr($acc , "'")) {
        if (strstr($acc_log , "'")) {
            alert("航司不能包含引号");
            return;
        }
    }
    if (strstr($acc , '"')) {
        if (strstr($acc_log , '"')) {
            alert("航司不能包含引号");
            return;
        }
    }
    $str="<,>/?~`!@#%^&*()+|\='";#定义你认为是特殊字符的字符
    if(similar_text($acc,$str)>0)#表明$name中有你定义的特殊字符
        {
            if(similar_text($acc_log,$str)>0)#表明$name中有你定义的特殊字符
                {
                    alert("呼号不能包含空格");
                    return;
                }
        }
    if(similar_text($num,$str)>0)#表明$name中有你定义的特殊字符
        {
            if(similar_text($num_log,$str)>0)#表明$name中有你定义的特殊字符
                {
                    alert("呼号不能包含空格");
                    return;
                }
        }
    if(similar_text($pwd,$str)>0)#表明$name中有你定义的特殊字符
        {
            if(similar_text($pwd_log,$str)>0)#表明$name中有你定义的特殊字符
                {
                    alert("呼号不能包含空格");
                    return;
                }
        }
    if(ctype_space($acc)){
        if (ctype_space($acc_log)) {
            alert("呼号不能包含空格");
            return;
        }
    }
    if(ctype_space($num)){
        if (ctype_space($num_log)) {
            alert("呼号不能包含空格");
            return;
        }
    }    
    if(ctype_space($pwd)){
        if (ctype_space($pwd_log)) {
            alert("呼号不能包含空格");
            return;
        }
    }
    
//后台数据输入区域
$filename="./cert.txt";   
$size= filesize($filename);
$handler=fopen($filename,"r");
if(!feof($handler))
{
    $m = fread($handler,$size); //fgets逐行读取
    //如果输入了登录页内容
    if(!empty($acc_log)){
        
        if(substr_count($m,"$acc_log$num_log $pwd_log $level_log")) //查找字符串
            {
                alert("恭喜你，在检索目录中找到了你的账户！");
                alert("系统信息：code:6886 message:The acc_log is init");;
                fclose($handler); //关闭文件
                return;
            } else{
                alert("对不起，您好像还没注册哦，亦或者您注册失败了！请重新注册！");
                alert("系统信息：ncode:6886 message:acc_log not found");
                return;
            }
    } 
    //如果输入了注册页内容
    elseif(!empty($acc)) {
        if(substr_count($m,"$acc$num")) //查找字符串
            {
                alert("这个呼号注册了哦！换一个吧");
                alert("系统信息：code:6886 message:The acc is init");
                fclose($handler); //关闭文件
                return;
            } else{
                $handle=fopen($filename,"a+");    
                $str=fwrite($handle,"$acc$num $pwd 1\n");
                fclose($handle);
                alert("注册成功,请等待20秒后尝试登录哦！祝你有一个快乐的飞行之旅！");
                alert("系统信息：ncode:6886 message:ok");
                return;
            }
        }        
} else {
            alert("注册失败");
            alert("系统信息：code:6886 message:Not Found Server");
            fclose($handler); //关闭文件
            return;
}  
?>