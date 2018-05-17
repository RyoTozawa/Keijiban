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
    if($file = file($file_name)){
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
    }else{
        echo "投稿はありません";
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
    echo (string)$edit_number."を編集します </br>";
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

function edit_content($file_name, $edit_number, $user, $comment){
    $file = file($file_name);
    $count = count($file);
    $body = "";
    for($i=0 ; $i < $count ; $i++){
        $array = explode('<>', trim($file[$i]));
        if((int)$edit_number == (int)$array[0]){
            $file[$i][1] = $user;
            $file[$i][2] = $comment;
        }
        $body .= $file[$i]."\n";
    }
    return $body;
}
?>