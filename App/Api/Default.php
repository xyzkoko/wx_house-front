<?php
/**
 * 默认接口服务类
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */

class Api_Default extends PhalApi_Api {

    /**
     * 清空所有缓存
     * @desc 清空用户登陆状态及所有缓存
     * @return int code 接口状态 0 成功
     * @return string error 错误提示信息
     */
    public function flush() {
        $array = array(
            'code' => 0
        );
        session_destroy();
        DI()->cache->flush();
        return $array;
    }
}
