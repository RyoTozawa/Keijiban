<?php
include('module.php');
require_once(dirname(__FILE__).'/module/config.php');
$target_file = "index.txt";
//$file = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
//$count = count($file);
?>

<?php
$current_time = date("Y/m/d H:i:s");
//$form_edit = $_POST["edit"];
//$form_status = $_POST["status"];
$form_name = "";
$form_comment = "";
$form_password = "";

echo $POST["edit"];
if(isset($POST["edit"])){
    $comment = ORM::for_table('comment')->find_one($POST["edit"]);
    $form_name = $comment->name;
    $form_comment = $comment->comment; 
}

if(isset($_POST["name"]) and isset($_POST["comment"]) and isset($_POST["password"])){
    $comment = ORM::for_table('comment')->create();
    $comment->user = $_POST["name"];
    $comment->comment = $_POST["comment"];
    $comment->time = $current_time;
    $comment->password = $_POST["password"];
    $comment->save();
}
?>

<script>
    function submitSend () {
        var flag = confirm ("送信してもよろしいですか？");
        return flag;
    }
</script>

<html>
<link rel="stylesheet/less" type="text/css" href="styles.less">
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.0.2/less.min.js" ></script>
    <div class="wrapper">
        <h1 align="center">掲示板</h1>
            <form class="form">
                <button type="button" onclick="location.href='post.php'" style="position: absolute; right: 140px; top: 0px;/">投稿</button>
                <button type="submit" style="position: absolute; right: 70px; top: 0px;/">消去</button>
                <button type="button" onclick="location.href='edit.php'" style="position: absolute; right: 0px; top: 0px;/">編集</button>
        <div class="container">
            <h2 align="center">入力</h2>
                 <form class="form" action="index.php" method="post" onsubmit="return submitSend()">
                    <input type="text" name="name" placeholder="名前" value='<?php echo $form_name;?>'>
                    <textarea name="comment" cols="30" rows="3" placeholder="コメント"><?php echo $form_comment;?></textarea>
                    <input type="password" name="password" placeholder="パスワード">
                    <button type="submit" id="login-button" >投稿</button>
                </form>
            <ul class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
</html>
