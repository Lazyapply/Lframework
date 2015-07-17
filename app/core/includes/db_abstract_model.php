<?php 
	require_once CORE_PATH.DS.'config.php';

	abstract class DBAbstractModel {

		//TODO: externelizar la configuración
		private $db_host 	= DB_HOST;
		private $db_user 	= DB_USER;
		private $db_pass 	= DB_PASS;
		private $db_name 	= DB_NAME;

		protected $query;
		protected $rows;
		private $_connection;
		public $mensaje;
		public $errors = array();

		public function __destruct(){
			unset($this);
		}

		private function _open_connection(){

			mysqli_report(MYSQLI_REPORT_STRICT);
			try{
				$this->_connection = new mysqli($this->db_host, $this->db_user,
			                               $this->db_pass, $this->db_name);
				
			}catch (Exception  $e){

				array_push($this->errors, ('['.$e->getCode().'] - '.$e->getMessage()));
				echo '['.$e->getCode().'] - '.$e->getMessage();
				die();
			}
			mysqli_set_charset($this->_connection, 'utf8');
		}

		private function _close_connection(){
			$this->_connection->close();
		}

		protected function execute_single_query(){

			$this->_open_connection();

			if(!$this->_connection->query($this->query)){
				array_push($this->errors, ('['.$this->_connection->errno.'] - '.$this->_connection->error));
				echo '['.$this->_connection->errno.'] - '.$this->_connection->error;
				die();
			}

			$this->_close_connection();
		}

		protected function get_results_from_query(){

			$this->_open_connection();
			$result = $this->_connection->query($this->query);

			if($result){
				while($this->rows[] = $result->fetch_assoc());
				$result->close();
				$this->_close_connection();
				array_pop($this->rows);
			}
			else{
				array_push($this->errors, ('['.$this->_connection->errno.'] - '.$this->_connection->error));
				echo '['.$this->_connection->errno.'] - '.$this->_connection->error;
				die();
			}
		}
		//TODO: agregar patron singleton
		
		public function testConnection(){

			$this->_open_connection();
			if($this->_connection)
				return true;
			else{
				$this->getErrors();
			}
			$this->_close_connection();
		}
		
		public function getCurrentConnections(){

			$this->query = "SHOW PROCESSLIST";
			$this->get_results_from_query();
			$aux = $this->rows;
			$this->clearRows();
			return $aux;
		}


		public function setQuery($q){$this->query = $q;}
		public function getQuery(){return $this->query;}
		public function getRows(){return $this->rows;}
		public function clearRows(){unset($this->rows);}
		public function getErrors(){return $this->errors;}
		public function getRowCount(){return count($this->rows);}

	}

 ?>