<?php
	namespace core\lib;		
	/*
	*	拼接路径引入配置文件
	*	将引入的数组文件返回到成员属性中
	*	检查数组成员是否存在
	*	检查数组文件是否引入
	*/
	
	Class config{
		/*	声明配置文件储存变量	*/
		static public $confile = array();
		
		/*	加载单项配置文件	*/
		static public function get($name,$file){
			
			/*	拼接路径	*/
			$path = CORE.'/config/'.$file.'.php';
			$path = str_replace('\\','/',$path);
			/*	如果已经加载该配置文件	*/
			if(isset(self::$confile[$file])){
				/*	则返回该配置文件的属性	*/
				return self::$confile[$file][$name];
			}else{				
				/*	否则 引入该配置文件并放到类属性中	*/
				if(is_file($path)){
					$conf = include $path;						
					/*	查看配置属性是否存在	一定要检查在不在,报错信息*/
					if(isset($conf[$name])){
						/*	如果存在 放入当前类属性中 避免重复引入配置文件	*/
						self::$confile[$file]  = $conf;
						/*	返回配置项键值	*/
						return $conf[$name];
					}else{
						throw new \Exception('找不到配置项'.$name);
					}			
				}else{
					throw new \Exception('找不到配置文件'.$file);
				}
			}
		}
		
		/*	加载多项配置文件	*/
		static public function all($file){
			/*	拼接路径	*/
			$path = CORE.'/config/'.$file.'.php';
			$path = str_replace('\\','/',$path);
			/*	如果已经加载该配置文件	*/
			if(isset(self::$confile[$file])){
				/*	则返回该配置文件的属性	*/
				return self::$confile[$file];
			}else{				
				/*	否则 引入该配置文件并放到类属性中	*/
				if(is_file($path)){
					$conf = include $path;
					self::$confile[$file] = $conf;
					return $conf;
				}else{
					throw new \Exception('找不到配置文件'.$file);
				}
			}
		}
	}
?>
