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
    <form class="form">
    <button type="submit" style="position: absolute; right: 0px; top: 5px;/">消去</button>
    <button type="submit" style="position: absolute; right: 0px; top: 55px;/">編集</button>
    </form>
    <div class="container">
        <h2 align="center">入力</h2>
        <form class="form" action="index.php" method="post">
            <input type="text" placeholder="ユーザ名" value='<?php echo $user;?>'>
            <textarea name="comment" cols="30" rows="3" placeholder="50字以内"><?php echo $comment;?></textarea>
            <input type="password" placeholder="3文字以上">
            <button type="submit" id="login-button">投稿</button>
        </form>
    <h2 align="center">ログ</h2>
    <?php foreach( $file as $row ):?>
    <?php $array = explode('<>', trim($row)); ?>
    <div class="box">
    <p>
        <span><?php echo "投稿番号：".$array[0]."</br>" ?></span>
        <span><?php echo "投稿者：".$array[1]."</br>" ?></span>
        <span><?php echo "コメント：".$array[2]."</br>" ?></span>
        <span><?php echo "投稿時間：".$array[3]."</br>" ?></span>
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
