<?php

/**
 * Created by IntelliJ IDEA.
 * User: seuic
 * Date: 2017/6/28
 * Time: 19:25
 */
class Common_Session implements PhalApi_Filter
{

    public function check()
    {
        if(!isset($_SESSION['uid'])){
            $url = 'http://www.allwinits.com/?service=WeiChat.Index&state=register';
            header("Location:".$url);exit;
        }
        return;
    }
}

