<?php 

require_once '../app/core/constants.php';
require_once INCLUDES.DS.'db_abstract_model.php';

echo '<h1>test!!!!</h1><br><br>';

class test extends DBAbstractModel{
	//solo debemos sobrecargar las funciones protected
	public function get_results_from_query(){
		parent::get_results_from_query();
	}
}


$t = new test();
echo '<h1>Test conexion</h1><br>';
$t->testConnection().'<br>';
// var_dump($t->getErrors());

// echo '<h1>Error provocado</h1><br>';
// $q = "SELECT ca FROM usuarios";
// $t->setQuery($q);
// $t->get_results_from_query();
// var_dump($t->getErrors());

// $q = "SELECT * FROM usuarios";
// $t->setQuery($q);

// echo $t->getQuery($q);
// $t->get_results_from_query();
// $aux = $t->getRows();
// echo '<h1>AUX</h1><br>';
// var_dump($aux);
// echo '<h1>getRows()</h1><br>';
// var_dump($t->getRows());
?>