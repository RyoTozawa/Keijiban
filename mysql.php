<?php
$db_user = 'root';
$db_password = 'root';
$db = 'intern';
$table = 'comment_log';
$db_host = 'localhost';
$connection = null;
try {
    $connection = new PDO("mysql:host={$db_host};dbname={$db};charset=utf8",$db_user,$db_password);
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}  

function insert_comment($id, $user, $comment, $pass){
    $current_time = date("Y/m/d H:i:s");
    try {
        $sql = "INSERT INTO comment_log (id,user,comment,time,password) VALUES ({$id},{$user},{$comment},{$current_time},{$pass})";
        $res = $connection->query($sql);
        echo "insert ${id},${user},$comment </br>";
    } catch(PDOException $e) {
        echo $e->getMessage();
        die();
    }  
}

function select_comment($id, $user, $comment, $pass){
    $current_time = date("Y/m/d H:i:s");
    $insert_sql = "INSERT INTO ${table} (
        id, user, comment, time, password 
        ) VALUES (
            ${id},${user},${comment},${current_time},${pass}
        )";
    echo "insert ${id},${user},$comment </br>";
}
?>
