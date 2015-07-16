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

$q = "SELECT * FROM usuarios";
$t->setQuery($q);

echo $t->getQuery($q);
$t->get_results_from_query();
$aux = $t->getRows();
echo '<h1>AUX</h1><br>';
var_dump($aux);
echo '<h1>getRows()</h1><br>';
var_dump($t->getRows());
?>