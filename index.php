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
<title>簡易掲示板の作成</title>
</head>
<body>

<h1>投稿フォーム</h1>
<form action = "index.php" method = "post">
名前：<input type = "text" name ="name" value="<?php echo $user;?>"><br/>
コメント：<input type = "text" name ="comment" value="<?php echo $comment;?>"><br/>
<input type = "submit" value ="送信">
</form>

<h1>消去フォーム</h1>
<form action = "index.php" method = "post">
消去番号：<input type = "text" name ="delete"><br>
<input type = "submit" value ="送信">
</form>

<h1>編集フォーム</h1>
<form action = "index.php" method = "post">
編集番号：<input type = "text" name ="edit"><br>
<input type = "submit" value ="送信">
<input type = "hidden" name = "edit" value = "edit_mode">
</form>

</body>
</html>

<?php display_text($target_file); ?>