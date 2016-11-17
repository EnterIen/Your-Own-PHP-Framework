<?php
	namespace core;		
	
	Class imooc{
		/*	现有类数组	*/
		public static  $classarr = array();			
		/*		*/
		public $assgin;
		
		static public function run(){
			
			/*	测试调用函数	*/
			p('ok');
			/*	启动日志类	*/
			lib\lgo::init();	
			/*	启动路由类	*/
			$route = new \core\lib\route();
			/*	加载控制器	*/
			$contrlClass  = $route->contrl;
			$contrlAction = $route->action;
			/*	日志写入	*/
			lib\lgo::log('contrl:'.$contrlClass.'   '.'action:'.$contrlAction);
			/*	拼接出控制器的文件路径并引进	*/
			$actionfile = APP . '/contrl/'.$contrlClass.'Contrl.php';
			$actionfile = str_replace('\\','/',$actionfile);	
			/*	实例化对象	*/
			$object =  '\app'.'\contrl\\'.$contrlClass.'Contrl';
			if(is_file($actionfile)){
				include($actionfile);
				$contrl = new $object();
				$contrl->$contrlAction();		
			}else{
				throw new \Exception('找不到控制器'.$contrlClass);
			}
		}
		
		/*	自动加载类方法	*/
		static public function load($class){		
			/**
			*	类的一般加载形式: new \core\route()  
			*	类的实质        : 加载IMOOC/core/route.php
			*	$class参数实质上就是new的那个类的一般加载路径 如: core\lib\route p($class);die;
			*/
			
			if(isset($classarr[$class])){
				return true;
			}else{
				$class = str_replace('\\','/',$class);		
				$classfile = IMOOC.'/'.$class.'.php';
				if(is_file($classfile)){
					include($classfile);
					self::$classarr[$class] = $class;
				}else{
					return false;
				}	
			}
			
		}
		
		public function assgin($name,$value){
			$this->assgin[$name] = $value;		
			
			while($val = current($this->assgin)){
				 echo $val;
				 next($this->assgin);		
			}
		}
		
		public function display(){
			/*	加载控制器	*/
			$route = new \core\lib\route();
			$contrlAction = $route->action;
				/*	拼接路径	*/
			$view = APP . '/view/'.$contrlAction.'.html';			
			if(is_file($view)){
				include($view);		/*	引入视图文件	*/
			}else{
				throw new \Exception('找不到视图文件'.$html);
			}
			
		}
	}
?>

