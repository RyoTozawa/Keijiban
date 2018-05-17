<?php
function check_number($file_name){
    $count = count(file($file_name));
    if($count==0){
        return 1;
    }else{
        return $count+1;
    }
}

function get_user($file_name, $edit_number){
    $file = file($file_name);
    $count = count($file);
    $ans = NULL;
    for($i=0 ; $i < $count ; $i++){
        $array = explode('<>', trim($file[$i]));
        if((int)$edit_number-1 == (int)$array[0]){
            $ans = $array[1];
            break;
        }
    }
    return $ans;
}

function get_comment($file_name, $edit_number){
    $file = file($file_name);
    $count = count($file);
    $ans = NULL;
    for($i=0 ; $i < $count ; $i++){
        $array = explode('<>', trim($file[$i]));
        if((int)$edit_number-1 == (int)$array[0]){
            $ans = $array[2];
            break;
        }
    }
    return $ans;
}

function display_text($file_name){
    $file = file($file_name);
    $count = count($file);
    for($i=0 ; $i < $count ; $i++){
        $array = explode('<>', trim($file[$i]));
        if($array[0]!=NULL && $array[1]!=NULL && $array[2]!=NULL && $array[3]!=NULL){
            echo "</br>";
            echo "投稿番号：".$array[0]."</br>";
            echo "投稿者：".$array[1]."</br>";
            echo "コメント：".$array[2]."</br>";
            echo "投稿時間：".$array[3]."</br>";
        }
    }
}

function delete_row($file_name, $delete_number){
    $file = file($file_name);
    $count = count($file);
    $body = "";
    for($i=0 ; $i < $count ; $i++){
        $array = explode('<>', trim($file[$i]));
        if((int)delete_number-1 != (int)$array[0]){
            $body .= $file[$i]."\n";
        }    
    }
    return $body;
}

function check_edit($file_name, $edit_number){
    $file = file($file_name);
    $count = count($file);
    for($i=0 ; $i<$count ; $i++){
        $array = explode('<>', trim($file[$i]));
        if((int)$edit_number-1 == (int)$array[0]){
            return TRUE;
        }
    }
    return FALSE;
}

$target_file = "index.txt";
$PATH = $target_file;

$form_name = $_POST["name"];
$form_comment = $_POST["comment"];
$form_delete = $_POST["delete"];
$form_edit = $_POST["edit"];

touch($PATH);

$angle_brace = "<>";

if(isset($form_name) && isset($form_comment)){
    $comment_number = check_number($target_file);
    $current_time = date("Y/m/d H:i:s");
    $body = (string)$comment_number.
    $angle_brace.$form_name.
    $angle_brace.$form_comment.
    $angle_brace.(string)$current_time."\n";
    file_put_contents($target_file, $body, FILE_APPEND | LOCK_EX );
    unset($form_name);
    unset($form_comment);
}

if(isset($form_delete)){
    $new_body = delete_row($target_file, $form_delete);
    file_put_contents($target_file, $new_body, LOCK_EX );
}

if(isset($form_edit)){
    if(check_edit($target_file, $form_edit)){
        $user = get_user($target_file, $form_edit);
        $comment = get_comment($target_file, $form_edit);
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
        <input type = "hidden" name = "edit" value = "edit_mode">
    </form>
</section>


</body>
</html>

