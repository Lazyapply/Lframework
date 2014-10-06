<?php 
	require_once ('config.php');

	abstract class DBAbstractModel{

		private static $db_host = Config::$db_host;
		private static $db_user = Config::$db_user;
		private static $db_pass = Config::$db_pass;
		protected $db_name 		= Config::$db_name;
		protected $query;
		protected $rows = array();
		private $_connection;
		public $mensaje;

		//metodos abstractos para ABM de las clases que hereden
		abstract protected function get();
		abstract protected function set();
		abstract protected function edit();
		abstract protected function delete();

		private function _open_connection(){
			$this->_connection = new mysqli(self::$db_host, self::$db_user,
			                               self::$db_pass, self::db_name);
		}

		private function _close_connection(){
			$this->_connection->close();
		}

		protected function execute_single_query(){
			if($_POST){
				$this->open_contection();
				$this->_connection->query($this->query);
				$this->close_connection();
			}
			else{
				$this->mensaje = 'Metodo no permitido';
			}
		}

		protected function get_results_from_query(){
			$this->open_contection();
			$result = $this->_connection->query($this->query);
			while($this->rows[] = $result->cubrid_fetch_assoc());
			$result->close();
			$this->close_connection();
			array_pop($this->rows);
		}
		//TODO: agregar patron singleton
	}

 ?>