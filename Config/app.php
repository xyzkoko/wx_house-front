<?php
/**
 * 请在下面放置任何您需要的应用配置
 */

return array(

    /**
     * 微信配置
     */
    'weichat' => array(
        'AppID' => 'wxb60c2a526baa3e0d',
        'AppSecret' => 'a9d8a2d071631585faf45b33a63eac69',
        'Token' => 'zz5500513',
        'EncodingAESKey' => 'AdahMC0SoYR7UxRNPkmOE2kBlK4qZwxFWouaZSrBpLG'
    ),

    /**
     * 极光配置
     */
    'jsms' => array(
        'appkey' => 'adb44b72db892ef07f4c182d',
        'DevSecret' => 'a398dc0a91b59f3323ebd7fd'
    ),

    /**
     * 应用接口层的统一参数
     */
    'apiCommonRules' => array(
        //'sign' => array('name' => 'sign', 'require' => true),
    ),

    /**
     * 接口服务白名单，格式：接口服务类名.接口服务方法名
     *
     * 示例：
     * - *.*            通配，全部接口服务，慎用！
     * - Default.*      Api_Default接口类的全部方法
     * - *.Index        全部接口类的Index方法
     * - Default.Index  指定某个接口服务，即Api_Default::Index()
     */
    'service_whitelist' => array(
        'WeiChat.Index',
        'WeiChat.Oauth2',
        'WeiChat.GetWebConfig',
        'User.Flush',
        '*.*'       //TODO 暂时开放微信登陆
    ),
);
