<?php
include('module.php');

$target_file = "index.txt";
$PATH = $target_file;

touch($PATH);

$angle_brace = "<>";

if(isset($_POST["name"]) && isset($_POST["comment"]) && isset($_POST["status"])){
    if($_POST["status"] == "editing"){
        
    }
    $comment_number = check_number($target_file);
    $current_time = date("Y/m/d H:i:s");
    $body = (string)$comment_number.
    $angle_brace.$_POST["name"].
    $angle_brace.$_POST["comment"].
    $angle_brace.(string)$current_time."\n";
    file_put_contents($target_file, $body, FILE_APPEND | LOCK_EX );
}

if(isset($_POST["delete"])){
    $new_body = delete_row($target_file, $_POST["delete"]);
    file_put_contents($target_file, $new_body, LOCK_EX );
}

if(isset($_POST["edit"])){
    if(check_edit($target_file, $_POST["edit"])){
        $user = get_user($target_file, $_POST["edit"]);
        $comment = get_comment($target_file, $_POST["edit"]);
    }
}

?>

<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset = "UTF-8">
<link href="keijiban.css" rel="stylesheet" type="text/css" media="all">
<title>簡易掲示板の作成</title>
</head>
<body>
<h1>掲示板</h1>

<section>
    <h5>投稿フォーム</h5>
    <form action = "index.php" method = "post">
        <div class="name"><span class="label">名前：</span><input type = "text" name ="name" value="<?php echo $user;?>"></div><br/>
        <div class="comment"><span class="label">コメント：</span><textarea name ="comment" cols="30" rows="3" placeholder="50字以内で入力してください"><?php echo $comment;?></textarea></div><br/>
        <input type = "submit" value ="送信">
        <input type="hidden" name="status" value="posting">
    </form>
</section>

<section class="toukou">
    <h2>投稿一覧</h2>
    <?php display_text($target_file); ?>
</section>

<section class="sonota">
    <h5>消去フォーム</h5>
    <form action = "index.php" method = "post">
        <div class="delete"><span class="label">消去番号：</span><input type = "text" name ="delete"></div><br>
        <input type = "submit" value ="送信">
    </form>

    <h5>編集フォーム</h5>
    <form action = "index.php" method = "post">
        <div class="edit"><span class="label">編集番号：</span><input type = "text" name ="edit"></div><br>
        <input type = "submit" value ="送信">
        <input type="hidden" name="status" value="editing">
    </form>
</section>


</body>
</html>

