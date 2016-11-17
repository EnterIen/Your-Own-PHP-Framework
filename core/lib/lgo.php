<?php
	namespace core\lib;
	use \core\lib\config;
	/**
	*	TODO: 日志类
	*	a>   加载日志形式[日志的存储有多种方式]
	*	b>    获取URL参数 重组URL参数
	*/ 
	Class lgo{
		/*	存储日志配置类	*/
		static public $logclass;
		
		static public function init(){
			/*	引入日志配置 返回日志配置项	*/
			$drivefile  = config::get('DRIVE','log'); #默认日志加载形式为file
			/*	拼接日志配置项类路径	*/
			$logclass   = 'core\lib\drive\lgo\\'.$drivefile;				
			self::$logclass = new $logclass;		
		}		
		
		static public function log($content){
			
			/*	调用日志配置项的类方法	*/
			$a = new self::$logclass();		
			$a->log($content,$file = 'log' );	
		}
	}
?>
