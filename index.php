<?php
include('module.php');
$target_file = "index.txt";
$file = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$count = count($file);
?>

<html>
<link rel="stylesheet/less" type="text/css" href="styles.less">
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.0.2/less.min.js" ></script>
<div class="wrapper">
    <h1 align="center">掲示板</h1>
    <!--
    <div class="container">
        <h1>掲示板</h1>
        <form class="form">
            <input type="text" placeholder="Username">
            <input type="password" placeholder="Password">
            <button type="submit" id="login-button">Login</button>
        </form>
    </div>
    -->
    <?php foreach( $file as $row ):?>
    <?php $array = explode('<>', trim($row)); ?>
    <p>
        <span><?php echo "投稿番号：".$array[0]."</br>" ?></span>
        <span><?php echo "投稿者：".$array[1]."</br>" ?></span>
        <span><?php echo "コメント：".$array[2]."</br>" ?></span>
        <span><?php echo "投稿時間：".$array[3]."</br>" ?></span>
    </p>
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
</html>
