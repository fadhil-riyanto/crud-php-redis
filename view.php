<?php
require 'redisDB.php';
$redis = new redisDB();
 
/* mendapatkan semua key */
$getdata = $redis->FindRedis('*');
?>
<html>
    <head>
        <title>Create/Update Redis</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        [<a href="edit.php">Tambah Baru</a>]
        <table border="1">
            <tr>
                <td>Key</td>
                <td>Action</td>
            </tr>
            <?php
            if (!empty($getdata)) {
                foreach ($getdata as $row) {
                    ?>
                    <tr>
                        <td><?= $row ?></td>
                        <td><a href="edit.php?key=<?= $row ?>">edit</a> | <a href="delete.php?key=<?= $row ?>">delete</a></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </body>
</html>