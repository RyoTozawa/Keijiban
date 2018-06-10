<?php
$db_user = 'root';
$db_password = 'root';
$db = 'intern';
$table = 'comment_log';
$db_host = 'localhost';
$connection = null;

function insert_comment($id, $user, $comment, $pass){
    $connection = new PDO("mysql:host={$db_host};dbname={$db};charset=utf8",$db_user,$db_password);
    $sql ='INSERT INTO comment_log (id,user,comment,time,passeord) VALUES (:id,:user,:comment,:time,:pass)';
    try {
        $stmt = $connetion->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':user', $id);
        $stmt->bindValue(':comment', $id);
        $stmt->bindValue(':time', $id);
        $stmt->bindValue(':pass', $id);
        $ret = $stmt->execute();
    } catch(PDOException $e) {
        echo $e->getMessage();
        die();
    }  
}
?>
