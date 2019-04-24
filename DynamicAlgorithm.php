<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

class DynamicAlgorithm implements Algorithm
{	

	/**
	* Start algoritm.
	* @return $knapsack filled with items
	*/
	public function start($sizeOfKnapsack, $listOfItem)
	{	 
		$K=$this->buildTable($sizeOfKnapsack, $listOfItem); 	
		$items=$this->returnItems($sizeOfKnapsack, $listOfItem, $K);
		
		return new Knapsack($items);
	}
	
	/*
	* Build table of maximum value of items.
	* @return table K.
	*/
	private function buildTable($sizeOfKnapsack, $listOfItem)
	{
		$n = count($listOfItem);
		$K = array_fill(0, $n + 1, array_fill(0, $sizeOfKnapsack + 1, NULL)); 
   
		for ($i = 0; $i <= $n; $i++)  
		{ 
			for ($w = 0; $w <= $sizeOfKnapsack; $w++)  
			{ 
				if ($i == 0 || $w == 0) 
					$K[$i][$w] = 0; 
				else if ($listOfItem[$i - 1]->getWeight() <= $w) 
					$K[$i][$w] = max($listOfItem[$i - 1]->getValue() +  
						$K[$i - 1][$w - $listOfItem[$i - 1]->getWeight()],  
							$K[$i - 1][$w]); 
				else
					$K[$i][$w] = $K[$i - 1][$w]; 
			} 
		}
		return $K;
	}
	
	/*
	* Build array of items.
	* @param $sizeOfKnapsack - size of knapsack
	* @param $K - table of maximum value of items
	* @return items 
	*/
	private function returnItems($sizeOfKnapsack, $listOfItem, $K)
	{
		$items = [];
		$currentNumberOfItems = 0;
		$n = count($listOfItem);
		$w = $sizeOfKnapsack; 
		$totalWeight=$K[$n][$sizeOfKnapsack];
		for ($i = $n; $i > 0 && $totalWeight > 0; $i--)  
		{ 
			if ($totalWeight == $K[$i - 1][$w])  
				continue;     
			else 
			{ 
				$items[$currentNumberOfItems++]=$listOfItem[$i - 1];
				$totalWeight = $totalWeight - $listOfItem[$i - 1]->getValue(); 
				$w = $w - $listOfItem[$i - 1]->getWeight(); 
			} 
		}
		return $items;
	}
		
}
?>