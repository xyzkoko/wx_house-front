<?php

/**
 * Created by IntelliJ IDEA.
 * User: seuic
 * Date: 2017/6/28
 * Time: 19:25
 */
class Common_Function
{
   public function curl($url,$data = null){
       $ch = curl_init();
       curl_setopt($ch,CURLOPT_URL,$url);
       curl_setopt($ch,CURLOPT_HEADER,0);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
       $res = curl_exec($ch);
       curl_close($ch);
       return $res;
   }

    /**
     * config随机数
     * @desc 内部调用
     */
    public function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     * 用SHA1算法生成安全签名
     * @param string $token 票据
     * @param string $timestamp 时间戳
     * @param string $nonce 随机字符串
     * @param string $encrypt 密文消息
     */
    public function getSHA1($token, $timestamp, $nonce, $encrypt_msg = null)
    {
        //排序
        try {
            $array = array($encrypt_msg, $token, $timestamp, $nonce);
            sort($array, SORT_STRING);
            $str = implode($array);
            return sha1($str);
        } catch (Exception $e) {
            return false;
        }
    }
}

