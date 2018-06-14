<?php
require_once(dirname(__FILE__).'/module/config.php');
?>

<html>
<link rel="stylesheet/less" type="text/css" href="styles.less">
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.0.2/less.min.js" ></script>
    <div class="wrapper">
        <h1 align="center">Forum</h1>
            <form class="form">
                <button type="button" onclick="location.href='index.php'" style="position: absolute; right: 245px; top: 0px;/">Top</button>
                <button type="button" onclick="location.href='post.php'" style="position: absolute; right: 167px; top: 0px;/">POST</button>
                <button type="button" onclick="location.href='delete.html'" style="position: absolute; right: 70px; top: 0px;/">DELETE</button>
                <button type="button" onclick="location.href='edit.html'" style="position: absolute; right: 0px; top: 0px;/">EDIT</button>
            </form>
        <div class="container">
            <h2 align="center">Log</h2>
                <?php $record = ORM::for_table('comment')->find_many();?>
                <?php foreach( $record as $row ):?>
                <div class="box">
                    <p>
                        <span><?php echo "Number：".$row->id."</br>" ?></span>
                        <span><?php echo "Name：".$row->user."</br>" ?></span>
                        <span><?php echo "Comment：".$row->comment."</br>" ?></span>
                        <span><?php echo "Post-Time：".$row->time."</br>" ?></span>
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
