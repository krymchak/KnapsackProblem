<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

/**
 * Class KnapsackProblem
 */
class KnapsackProblem
{	
	
	private $algorithm;
	
	/**
	* KnapsackProblem constructor.
	* @param $algorithm - algorithm that solves the problem 
	*/ 
	public function __construct($algorithm) 
	{
		$this->algorithm = $algorithm; 
	} 

	/**
	* Find best decision of problem.
	* @return knapsack filled with items
	*/
	public function findBestDecision($size, $listOfItems)
	{
		$knapsack = $this->algorithm->start($size, $listOfItems);
		return $knapsack;
	}
	
}

?>