<?php
include('module.php');
$target_file = "index.txt";
?>

<html>
<link rel="stylesheet/less" type="text/css" href="styles.less">
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.0.2/less.min.js" ></script>
<div class="wrapper">
    <div class="container">
        <h1>掲示板</h1>
        <?php display_text($target_file); ?>
        <!--
        <form class="form">
            <input type="text" placeholder="Username">
            <input type="password" placeholder="Password">
            <button type="submit" id="login-button">Login</button>
        </form>
        -->
    </div>
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
