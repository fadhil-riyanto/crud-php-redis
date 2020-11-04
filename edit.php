<?php
error_reporting(0);
require 'redisDB.php';
$redis = new redisDB();
$dtkey = $dtvalue = null;
if (!empty($_POST)) {
    /* menyimpan value dan key */
    $redis->InsertDataToKey($_POST['key'], $_POST['value']);
}
if (!empty($_GET['key'])) {
    /* mendapatkan value dari redis key */
    $getdata = $redis->GetDatafromKeys($_GET['key']);
    $dtkey = $_GET['key'];
    $dtvalue = $getdata;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create/Update Redis</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form name="edit" method="post">
            <table>
                <tr>
                    <td>Key</td>
                    <td><input name="key" value="<?= $dtkey ?>" /></td>
                </tr>
                <tr>
                    <td>Value</td>
                    <td><input name="value" value="<?= $dtvalue ?>" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit"></td>
                </tr>
            </table>
        </form>
    </body>
</html>
