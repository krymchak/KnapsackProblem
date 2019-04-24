<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

/**
 * Class Knapsack
 */
class Knapsack
{
	
	private $items;
	
	/**
	* Knapsack constructor.
	* @param $items - array of knapsack contents
	*/
	public function __construct($items) 
	{
		$this->items = $items;
	} 
	
	/**
	* Returns items
	* @return array items
	*/
	public function  getItems()
	{
		return $this->items;
	}
	
	/**
	* Count total value of items
	* @return total value
	*/
	public function getTotalValue()
	{
		$sum=0;
		foreach ($this->items as $val)
			$sum+=$val->getValue();
			
		return $sum;
	}
	
	/**
	* Count total weight of items
	* @return total weight
	*/
	public function getTotalWeight()
	{
		$sum=0;
		foreach ($this->items as $w)
			$sum+=$w->getWeight();
			
		return $sum;
	}
}

?>