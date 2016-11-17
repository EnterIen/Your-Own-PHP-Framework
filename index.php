<?php
	/**
	*   TODO 入口文件
	*   a>   定义常量
	*   b>   加载函数库
	*   c>   启动框架
	*   time  : 11/11/2016
	*   Author: entner <wangyiicloud@icloud.com>
	*/
	
	
	define('IMOOC',realpath('./'));  //框架路径
	define('CORE',IMOOC . '/core'); //核心类文件路径
	define('APP',IMOOC . '/app');  //项目分组文件
	define('DEBUG',true);
	
	/*	引入filp/whoops插件	*/
	include('vendor/autoload.php');
	/*	开启调试模式	  */
	if(DEBUG){
		$whoops = new \Whoops\Run;
		$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
		$whoops->register();
		ini_set('display_error','1');   //开启错误提示
	}else{
		ini_set('display_error','0');   //关闭错误提示
	}
	
	/*	加载函数库	*/
	include CORE.'/common/function.php';
	/*	加载基础类	*/
	include CORE.'/imooc.php';
	
	/*	类自动加载	*/
	spl_autoload_register('\core\imooc::load');		/*spl_autoload_register 将实现的方法加载到自动加载类的队列中*/
	
	/*	启动框架	*/
	\core\imooc::run();
	
?>
