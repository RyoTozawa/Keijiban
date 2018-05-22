<?php

function check_number($file_name){
    $count = count(file($file_name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
    if($count === 0){
        return 1;
    }else{
        return $count+1;
    }
}

function get_user($file_name, $edit_number){
    $file = file($file_name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $count = count($file);
    $ans = NULL;
    $edit = (int)$edit_number;
    for($i=0 ; $i < $count ; $i++){
        $array = explode('<>', trim($file[$i]));
        if($edit == $array[0]){
            $ans = $array[1];
            break;
        }
    }
    return $ans;
}

function get_comment($file_name, $edit_number){
    $file = file($file_name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $count = count($file);
    $edit = (int)$edit_number;
    $ans = NULL;
    for($i=0 ; $i < $count ; $i++){
        $array = explode('<>', trim($file[$i]));
        if($edit == $array[0]){
            $ans = $array[2];
            break;
        }
    }
    return $ans;
}

function display_text($file_name){
    $file = file($file_name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $count = count($file);
    if(!($count === 0)){
        for($i=0 ; $i < $count ; $i++){
            $array = explode('<>', trim($file[$i]));
            if(isset($array[0]) and isset($array[1]) and isset($array[2]) and isset($array[3])){
                echo "</br>";
                echo "投稿番号：".$array[0]."</br>";
                echo "投稿者：".$array[1]."</br>";
                echo "コメント：".$array[2]."</br>";
                echo "投稿時間：".$array[3]."</br>";
            }
        }
    }else{
        echo "投稿はありません";
    }
}

function delete_row($file_name, $delete_number){
    $file = file($file_name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $count = count($file);
    $body = "";
    $delete = (int)$delete_number;
    for($i=0 ; $i < $count ; $i++){
        $array = explode('<>', trim($file[$i]));
        if($delete != $array[0]){
            $body .= $file[$i]."\n";
        }    
    }
    return $body;
}

function edit_content($file_name, $edit_number, $user, $comment){
    $file = file($file_name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $count = count($file);
    $body = "";
    $edit = (int)$edit_number;
    $angle_brace = "<>";
    for($i=0 ; $i < $count ; $i++){
        $array = explode('<>', trim($file[$i]));
        if($edit == $array[0]){
            $current_time = date("Y/m/d H:i:s");
            $buffer = (string)$edit.
            $angle_brace.$user.
            $angle_brace.$comment.
            $angle_brace.(string)$current_time."\n";
            $body .= $buffer;  
        }else{
            $body .= $file[$i]."\n";
        }
    }
    return $body;
}
?>