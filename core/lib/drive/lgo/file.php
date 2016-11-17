<?php
	namespace core\lib\drive\lgo;	
	use core\lib\config;
	
	class file{
		public $path;
    
		/*	加载日志路径	*/
		public function __construct(){
			$conf = config::get('OPTION','log');	
			$conf = str_replace('\\','/',$conf);
			$this->path = $conf['PATH'];		
		}
    
		/*	日志写入	*/
		public function log($content,$file){
			if(!is_dir($this->path)){
				mkdir($this->path,0777,true);				
			}else{	
				return file_put_contents($this->path.$file.'.php',date('Y/m/d H:i:s').json_encode($content).PHP_EOL,FILE_APPEND);
			}
		}
	}

?>
