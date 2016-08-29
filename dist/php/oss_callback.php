<?php
/**
 * Created by PhpStorm.
 * User: luckerdj
 * Date: 16/8/28
 * Time: 下午1:11
 */

require_once 'oss.php';

echo json_encode([
    'state' => 'SUCCESS',
    'url' => $host.'/'.$_POST['filename'],
    'title' => basename($_POST['filename']),
    'original' => basename($_POST['filename']),
    'type' => $_POST['mimeType'],
    'size'=>$_POST['size']
]);