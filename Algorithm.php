<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
/**
 * Abstract class Algorithm
 */
interface  Algorithm
{	
	public function start($sizeOfKnapsack, $listOfItem);

}
?>