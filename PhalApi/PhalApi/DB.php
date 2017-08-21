<?php
/**
 * PhalApi_DB数据库接口
 * 
 *
 * 
 * @package     PhalApi\DB
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author      dogstar <chanzonghuang@gmail.com> 2015-02-09
 */
interface PhalApi_DB{

	public function connect();
	
	public function disconnect();
}
