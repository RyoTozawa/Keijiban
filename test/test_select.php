<?php
$db_user = 'root';
$db_password = 'root';
$db = 'intern';
$table = 'comment_log';
$db_host = 'localhost';
$connection = null;
try {
    $connection = new PDO("mysql:host={$db_host};dbname={$db};charset=utf8",$db_user,$db_password);
    $sql = "SELECT * FROM {$table}";
    // クエリ実行（データを取得）
    $res = $connection->query($sql);
    // 取得したデータを出力
	foreach( $res as $value ) {
		echo "{$value[user]} <br>";
	}
} catch(PDOException $e) {
    echo $e->getMessage();
    die();
}  
?>