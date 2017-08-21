<?php
/**
 * App 统一入口
 */
session_start();
require_once dirname(__FILE__) . '/../init.php';
//装载你的接口
DI()->loader->addDirs('App');
//拦截器
DI()->filter = 'Common_Session';
//通用函数基础类
DI()->function = new Common_Function();
//极光推送
DI()->loader->addDirs('Library');
DI()->jsms = new Jsms_Message(DI()->config->get('app.jsms.appkey'), DI()->config->get('app.jsms.DevSecret'), [ 'ssl_verify' => false ]);
/** ---------------- 响应接口请求 ---------------- **/

$api = new PhalApi();
$rs = $api->response();
$rs->output();

