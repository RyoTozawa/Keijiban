<?php
    require_once(dirname(__FILE__).'/module/config.php');
?>

<?php
$current_time = date("Y/m/d H:i:s");
$form_status = "POST";


if(isset($_POST["edit"]) and isset($_POST["mode"])){
    $comment = ORM::for_table('comment')->find_one((int)$_POST["edit"]);
    $form_name = $comment->user;
    $form_comment = $comment->comment; 
    $form_status = $_POST["mode"];
}
?>

<?php
    if(isset($_POST["name"]) and isset($_POST["comment"]) and isset($_POST["password"])){
        $comment = ORM::for_table('comment')->create();
        $comment->user = $_POST["name"];
        $comment->comment = $_POST["comment"];
        $comment->time = $current_time;
        $comment->password = $_POST["password"];
        $comment->save();
    }
?>

<script>
    function submitSend () {
        var flag = confirm ("Agree with Sending?");
        return flag;
    }
</script>

<html>
<link rel="stylesheet/less" type="text/css" href="styles.less">
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.0.2/less.min.js" ></script>
    <div class="wrapper">
        <h1 align="center"><?php echo $form_status;?></h1>
            <form class="form">
                <button type="button" onclick="location.href='index.php'" style="position: absolute; right: 245px; top: 0px;/">TOP</button>
                <button type="button" onclick="location.href='post.php'" style="position: absolute; right: 167px; top: 0px;/">POST</button>
                <button type="button" onclick="location.href='delete.html'" style="position: absolute; right: 70px; top: 0px;/">DELETE</button>
                <button type="button" onclick="location.href='edit.html'" style="position: absolute; right: 0px; top: 0px;/">EDIT</button>
            </form>
        <div class="container">
            <h2 align="center">Form</h2>
                <form class="form" action="index.php" method="post" onsubmit="return submitSend()">
                    <input type="text" name="name" placeholder="Name" value='<?php echo $form_name;?>'>
                    <textarea name="comment" cols="30" rows="3" placeholder="Comment"><?php echo $form_comment;?></textarea>
                    <input type="password" name="password" placeholder="Your Pass">
                    <button type="submit" id="login-button" >Confirm</button>
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
