<?php
	namespace app\model;
	
	
	Class cModel extends \core\lib\model{
				
		/*	数据所有查询	*/
		public function lists(){			
			$result = $this->select('txt2','*');		
			return $result;		
		}
		
		/*	查询单条数据	*/
		public function getOne($id){
			$result = $this->select('txt2','*',array(
				'id'=>$id
			));
			return $result;
		}
		
		/*	增添数据	*/
		public function add($data){
			$result = $this->insert('txt2',$data);
			return $result;
		}
		
		/*	更新数据	*/
		public function save($data,$id){
			$result = $this->update('txt2',$data,array(
				'id'=>$id
			));
			return $result;		/*	返回影响行数	*/
		}
		
		/*	删除数据	*/
		public function del($id){
			$result = $this->delete('txt2',array(
				'id'=>$id
			));
			return $result;		/*	返回影响行数	*/
		}
	}
?>
