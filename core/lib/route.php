<?php
	namespace core\lib;
	use \core\lib\config;
	/**
	*	TODO: 路由类
	*	a>    隐藏index.php
	*	b>    获取URL参数 重组URL参数
	*/
	Class route{
		public $contrl;
		public $action;
		
		public function __construct(){					
			/*
			*获取REQUEST_URL参数,解析数组,获得当前控制器和方法
			*
			*/
			if($_SERVER['REQUEST_URI'] && $_SERVER['REQUEST_URI'] != '/'){
				$routearr = explode('/',trim($_SERVER['REQUEST_URI'],'/'));
				
				/*	当控制器参数被省略时	*/
				if(isset($routearr[0])){
					$this->contrl = $routearr[0];	
					unset($routearr[0]);				
				}
					
				if(isset($routearr[1])){
					$this->action = $routearr[1];
					unset($routearr[1]);
				}else{
					/*	当方法省略时,默认为index方法	*/
					$this->action = 'index';
				}
				
				/*	
        * URL GET参数部分	
				*	先去掉前面两个URL参数
				*	重组数组
				*/
				dump($routearr);die;
				
				$i= 2;
				$count = count($routearr) + 2;
				while($i < $count){
					/*
					*键 = 值
					*/
					$_GET[$routearr[$i]] = $routearr[$i + 1];
					$i = $i+2;
				}
				
			}else{
				/*	当$_SERVER['REQUEST_URI']不存在或为'/'时	*/
				$this->contrl  = 'index';
				$this->action  = 'index';
			}
		}
		
		
		
	}
?>
