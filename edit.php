<?php
include('module.php');
require_once(dirname(__FILE__).'/module/config.php');
?>

<html>
<link rel="stylesheet/less" type="text/css" href="styles.less">
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.0.2/less.min.js" ></script>
    <div class="wrapper">
        <h1 align="center">掲示板</h1>
        <div class="container">
            <h2 align="center">編集フォーム</h2>
                 <form class="form" action="index.php" method="post" onsubmit="return submitSend()">
                    <input type="text" name="edit" placeholder="編集する番号">
                    <button type="submit" id="login-button">変更</button>
                </form>
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
