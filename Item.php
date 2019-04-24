<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

/**
 * Class Item
 */
class Item
{
	private $id;
	private $weight;
	private $value;
	
	/**
	* Item constructor.
	* @param $id - item's id
	* @param $weight - item's weight
	* @param $value - item's value
	*/	
	public function __construct($id,$weight,$value) 
	{
		$this->id=$id;
		$this->weight=$weight;
		$this->value=$value;
	} 
	
	/**
	* Returns item's id
	* @return id
	*/
	public function  getId()
	{
		return $this->id;
	}
	
	/**
	* Returns item's weight
	* @return weight
	*/
	public function  getWeight()
	{
		return $this->weight;
	}
	
	/**
	* Returns item's value
	* @return value
	*/
	public function  getValue()
	{
		return $this->value;
	}
 
	/**
	* Display item's information
	* @return string   information about item
	*/
	public function __toString()
	{
		return "(ID: " . $this->id . ", wartosc: " . $this->value . ", waga: " . $this->weight . ")\n";
	}

}

?>