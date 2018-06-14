<?php
include('module.php');
require_once(dirname(__FILE__).'/module/config.php');
$target_file = "index.txt";
//$file = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
//$count = count($file);
?>
<html>
<link rel="stylesheet/less" type="text/css" href="styles.less">
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.0.2/less.min.js" ></script>
    <div class="wrapper">
        <h1 align="center">掲示板</h1>
            <form class="form">
                <button type="button" onclick="location.href='post.php'" style="position: absolute; right: 140px; top: 0px;/">投稿</button>
                <button type="submit" style="position: absolute; right: 70px; top: 0px;/">消去</button>
                <button type="button" onclick="location.href='edit.php'" style="position: absolute; right: 0px; top: 0px;/">編集</button>
            </form>
        <div class="container">
            <h2 align="center">ログ</h2>
                <?php $record = ORM::for_table('comment')->find_many();?>
                <?php foreach( $record as $row ):?>
                <div class="box">
                    <p>
                        <span><?php echo "投稿番号：".$row->id."</br>" ?></span>
                        <span><?php echo "投稿者：".$row->user."</br>" ?></span>
                        <span><?php echo "コメント：".$row->comment."</br>" ?></span>
                        <span><?php echo "投稿時間：".$row->time."</br>" ?></span>
                    </p>
                </div>
                <?php endforeach;?>
            <ul class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
</html>
