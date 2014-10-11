<?php 
	require_once ('config.php');

	abstract class DBAbstractModel {

		//TODO: externelizar la configuración
		private $db_host 	= DB_HOST;
		private $db_user 	= DB_USER;
		private $db_pass 	= DB_PASS;
		private $db_name 	= DB_NAME;

		protected $query;
		protected $rows = array();
		private $_connection;
		public $mensaje;


		private function _open_connection(){
			$this->_connection = new mysqli($this->db_host, $this->db_user,
			                               $this->db_pass, $this->db_name);
		}

		private function _close_connection(){
			$this->_connection->close();
		}

		protected function execute_single_query(){
			// if($_POST){
				$this->_open_connection();
				$this->_connection->query($this->query);
				$this->_close_connection();
			// }
			// else{
			// 	$this->mensaje = 'Metodo no permitido';
			// }
		}

		protected function get_results_from_query(){
			$this->_open_connection();
			$result = $this->_connection->query($this->query);
			while($this->rows[] = $result->cubrid_fetch_assoc());
			$result->close();
			$this->_close_connection();
			array_pop($this->rows);
		}
		//TODO: agregar patron singleton
	}

 ?>