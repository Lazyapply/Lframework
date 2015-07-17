<?php 

require_once '../app/core/constants.php';
require_once INCLUDES.DS.'db_abstract_model.php';

echo '<h1>test!!!!</h1><br><br>';

class test extends DBAbstractModel{
	//solo debemos sobrecargar las funciones protected
	public function get_results_from_query(){
		parent::get_results_from_query();
	}

	public function execute_single_query(){
		parent::execute_single_query();
	}
}


$t = new test();
echo '<h1>Test conexion</h1><br>';
if($t->testConnection())
	echo "todo ok";

var_dump($t->getCurrentConnections());
// var_dump($t->getErrors());

echo '<h1>Error provocado (SELECT)</h1><br>';
$q = "SELECT caca FROM usuarios";
$t->setQuery($q);
$t->get_results_from_query();
echo $t->getRowCount();
var_dump($t->getRows());


echo '<h1>Error provocado (UPDATE)</h1><br>';
$q = "UPDATE usuarios SET nombrse='pacone' WHERE idUsuario=81";
$t->setQuery($q);
$t->execute_single_query();
?>