<?php 
require 'redisDB.php';
$redis = new redisDB();
 
if (!empty($_GET['key'])) {
    /* menghapus value dari redis key */
    $redis->RemoveRedis($_GET['key']);
    header("location:" . $_SERVER['HTTP_REFERER']);
}