<?php
//header('Access-Control-Allow-Origin: http://www.baidu.com'); //设置http://www.baidu.com允许跨域访问
//header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); //设置允许的跨域header
date_default_timezone_set("Asia/chongqing");
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8");
//载入OSS签名函数
require_once 'oss.php';

$CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("config.json")), true);
$action = $_GET['action'];

switch ($action) {
    case 'config':
        //$result =  json_encode($CONFIG, true);
        //加入OSS配置
        $oss_config = get_config();
        $oss_uconf = [
            'imageUpload2Oss'=>true,
            'imageUpload2OssActionUrl' => $oss_config['host'],
            'imageUpload2OssFormData' => [
                'key' => $oss_config['dir'].'${filename}', //文件命名规则, ${filename}以原文件名  ${random}随机文件名
                'policy' => $oss_config['policy'],
                'OSSAccessKeyId' => $oss_config['accessid'],
                'success_action_status' => '200',
                //'callback' => $oss_config['callback'],
                'Signature' => $oss_config['signature']
            ],
            //重写OSS接受文件字段名
            'imageFieldName' => 'file'
        ];
        //TODO, 是否有回调配置
        //$oss_uconf['imageUpload2OssFormData']['callback']='';
        $result = array_merge($CONFIG, $oss_uconf);
        $result = json_encode($result);
        break;

    /* 上传图片 */
    case 'uploadimage':
    /* 上传涂鸦 */
    case 'uploadscrawl':
    /* 上传视频 */
    case 'uploadvideo':
    /* 上传文件 */
    case 'uploadfile':
        $result = include("action_upload.php");
        break;

    /* 列出图片 */
    case 'listimage':
        $result = include("action_list.php");
        break;
    /* 列出文件 */
    case 'listfile':
        $result = include("action_list.php");
        break;

    /* 抓取远程文件 */
    case 'catchimage':
        $result = include("action_crawler.php");
        break;

    default:
        $result = json_encode(array(
            'state'=> '请求地址出错'
        ));
        break;
}

/* 输出结果 */
if (isset($_GET["callback"])) {
    if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
        echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
    } else {
        echo json_encode(array(
            'state'=> 'callback参数不合法'
        ));
    }
} else {
    echo $result;
}