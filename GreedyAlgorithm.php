<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

class GreedyAlgorithm implements Algorithm
{	

	/**
	* Start algoritm.
	* @return $knapsack filled with items
	*/
	public function start($sizeOfKnapsack, $listOfItem)
	{
		$items = [];
		$weight = 0.0;
		$currentNumberOfItems = 0;
		// Sort items by ratio value and weight
		
		usort($listOfItem, array($this, 'compare'));
		for($i = 0; $i < count($listOfItem); $i++) 
		{
			if($weight + $listOfItem[$i]->getWeight() <= $sizeOfKnapsack) 
			{
			
				$weight += $listOfItem[$i]->getWeight();
				$items[$currentNumberOfItems++] = $listOfItem[$i];
			}
		}
		return new Knapsack($items);
	}
	
	/**
	* Compare to items by ratio value and weight.
	* @param $a - first item to compare
	* @param $b - second item to compare
	* @return comparison result
	*/
	function compare($a, $b)
	{
		$firstValue = (float)$a->getValue() / $a->getWeight();
		$secondValue = (float)$b->getValue() / $b->getWeight();
		return $firstValue < $secondValue;
	}
}
?>