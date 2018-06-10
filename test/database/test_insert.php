<?php
$db_user = 'root';
$db_password = 'root';
$db = 'intern';
$table = 'comment_log';
$db_host = 'localhost';
$connection = null;
try {
    $connection = new PDO("mysql:host={$db_host};dbname={$db};charset=utf8",$db_user,$db_password);
    $sql = "INSERT INTO {$table} (id,user,comment,time,password) VALUES ('1','DoSuKoI','TEST','2018','test')";
    // クエリ実行（データを取得）
    $res = $connection->query($sql);
    echo $sql;
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}  
?>