<?php
	namespace app\contrl;
	use core\lib\model;
	
	Class indexContrl extends \core\imooc{
		
		
		public function index(){
		echo "it is index contrl";
    
			/*	Model类	*/
			$model = new \app\model\cModel();
			$result = $model->lists();
		
			
			/*	view类	*/	
			$this->display();
		}
		
		public function test(){
			$this->display('test');
		}
	}
?>
