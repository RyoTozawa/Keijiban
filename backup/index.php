<?php
include('module.php');
include('mysql.php');
?>

<?php
$target_file = "index.txt";
$buffer_file = "buffer.txt";
$PATH = $target_file;
$angle_brace = "<>";

$form_edit = $_POST["edit"];
$form_status = $_POST["status"];
$form_name = $_POST["name"];
$form_comment = $_POST["comment"];
$form_password = $_POST["password"];

touch($PATH);
touch($buffer_file);

if(isset($form_edit) and isset($form_status)){
    if($form_status == "EDIT"){
        $user = get_user($target_file, $form_edit);
        $comment = get_comment($target_file, $form_edit);
        file_put_contents($buffer_file, $form_edit, LOCK_EX );
    }   
}

if(isset($form_name) and isset($form_comment)){
    $user = $form_name;
    $comment = $form_comment;
    if($edit = file($buffer_file, FILE_SKIP_EMPTY_LINES)){
        echo "編集中 </br>";
        echo $edit[0];
        $body = edit_content($target_file, $edit[0], $form_name, $form_comment, $form_password);
        echo $body;
        file_put_contents($target_file, $body, LOCK_EX );
        unlink($buffer_file);
    }else{
        echo "通常運行 </br>";
        $comment_number = check_number($target_file);
        $current_time = date("Y/m/d H:i:s");
        insert_comment($comment_number,$form_name,$form_comment,$form_password);
        $body = (string)$comment_number.
        $angle_brace.$form_name.
        $angle_brace.$form_comment.
        $angle_brace.(string)$current_time.
        $angle_brace.$form_password."\n";
        file_put_contents($target_file, $body, FILE_APPEND | LOCK_EX ); 
    }
}

if(isset($_POST["delete"])){
    $form_delete = $_POST["delete"];
    $new_body = delete_row($target_file, $form_delete);
    file_put_contents($target_file, $new_body, LOCK_EX );
} 
//$_POST = array();
?>

<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset = "UTF-8">
<link href="keijiban.css" rel="stylesheet" type="text/css" media="all">
<title>簡易掲示板の作成</title>
</head>

<body>
<h1><span>掲示板</span></h1>

<script>
    function submitSend () {
        var flag = confirm ("送信してもよろしいですか？");
        return flag;
    }
</script>

<h5>投稿フォーム</h5>
<section class="toukou">
    <form action="index.php" method="post" onsubmit="return submitSend()">
        <div class="name"><span class="label">名前：</span><input type="text" name="name" value='<?php echo $user;?>'></div><br/>
        <div class="comment"><span class="label">コメント：</span><textarea name="comment" cols="30" rows="3" placeholder="50字以内で入力してください"><?php echo $comment;?></textarea></div><br/>
        <div class="password"><span class="label">パスワード：</span><input type="password" name="password" placeholder="Over 3 Word"></div><br/> 
        <button type="submit">送信</button>   
    </form>
</section>

<h5>消去フォーム</h5>
<section class="delete">
    <form action="index.php" method="post">
        <div class="delete"><span class="label">消去番号：</span><input type = "text" name ="delete"></div><br>
        <button type="submit">送信</button>
    </form>
</section>

<h5>編集フォーム</h5>
<section>
    <form action="index.php" method="post">
        <div class="edit"><span class="label">編集番号：</span><input type = "text" name ="edit"></div><br>
        <input type="hidden" name="status" value="EDIT">
        <button type="submit">送信</button>
    </form>
</section>

<section class="itiran">
    <h2>投稿一覧</h2>
</section>

</body>
</html>

<?php display_text($target_file); ?>