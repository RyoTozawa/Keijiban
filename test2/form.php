<!-- CSSと同じようにlinkタグから.lessファイルを呼び出す rel=”stylesheet/less” となる点に注意してください -->
<html>
<link rel="stylesheet/less" type="text/css" href="styles.less">
<!-- less.jsは.lessファイルの後に呼び出します -->
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.0.2/less.min.js" ></script>
<div class="wrapper">
    <div class="container">
        <h1>Welcome</h1>
        <form class="form">
            <input type="text" placeholder="Username">
            <input type="password" placeholder="Password">
            <button type="submit" id="login-button">Login</button>
        </form>
    </div>
    <?php echo "hello </br>"; ?>
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
