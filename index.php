<?php
include('module.php');
?>

<?php
$target_file = "index.txt";
$PATH = $target_file;
$angle_brace = "<>";
$edit = 0;

touch($PATH);

if(isset($_POST["delete"])){
    $form_delete = $_POST["delete"];
    $new_body = delete_row($target_file, $form_delete);
    file_put_contents($target_file, $new_body, LOCK_EX );
} 

if(isset($_POST["edit"]) and isset($_POST["status"])){
    if($_POST["status"] == "EDIT"){
        $user = get_user($target_file, $_POST["edit"]);
        $comment = get_comment($target_file, $_POST["edit"]);
        $edit = $_POST["status"];
    }   
}

if(isset($_POST["name"]) and $_POST["comment"]){
    echo "編集番号：".$edit."</br>";
    $user = $_POST["name"];
    $comment = $_POST["comment"];
    if($edit != "0"){
        $body = edit_content($target_file, $_POST["edit"], $user, $comment);
        file_put_contents($target_file, $body, LOCK_EX );
        $edit = "0";
    }else if($edit == "0"){
        $form_name = $_POST["name"];
        $form_comment = $_POST["comment"];
        echo "Normal </br>";
        $comment_number = check_number($target_file);
        $current_time = date("Y/m/d H:i:s");
        $body = (string)$comment_number.
        $angle_brace.$form_name.
        $angle_brace.$form_comment.
        $angle_brace.(string)$current_time."\n";
        file_put_contents($target_file, $body, FILE_APPEND | LOCK_EX ); 
    }
}

$_POST = array();

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
    <form action="index.php" method="post">
        <div class="name"><span class="label">名前：</span><input type = "text" name ="name" value='<?php echo $user;?>'></div><br/>
        <div class="comment"><span class="label">コメント：</span><textarea name ="comment" cols="30" rows="3" placeholder="50字以内で入力してください"><?php echo $comment;?></textarea></div><br/>
        <input type = "submit" value ="送信">   
    </form>
</section>

<section>
    <h5>消去フォーム</h5>
    <form action="index.php" method="post">
        <div class="delete"><span class="label">消去番号：</span><input type = "text" name ="delete"></div><br>
        <input type = "submit" value ="送信">
    </form>
</section>

<section>
    <h5>編集フォーム</h5>
    <form action="index.php" method="post">
        <div class="edit"><span class="label">編集番号：</span><input type = "text" name ="edit"></div><br>
        <input type="hidden" name="status" value="EDIT">
        <input type = "submit" value ="送信">
    </form>
</section>

<section class="toukou">
    <h2>投稿一覧</h2>
</section>

</body>
</html>

<?php display_text($target_file); ?>