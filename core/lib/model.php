<?php
	namespace core\lib;		
	use core\lib\config;
	Class model extends \medoo{
		
		public function __construct(){
			$DB = config::all('config');	
			parent::__construct($DB);	
		}
	}
?>
