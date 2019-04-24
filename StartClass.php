<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

/**
 * Class StartClass
 */
class StartClass
{
	private $listOfItems;
	private $way;
	private $size;
	private $alg=1;
	
	private $algorithms=["GreedyAlgorithm", "DynamicAlgorithm"];
	
	/**
	* Load arguments of skript to variables
	*/
	public function loadArguments()
	{
		global $argc;
		// Check number of arguments
		if ($argc < 5 || $argc > 7) 
		{
			//die(PHP_EOL . 'Error: wrong number of arguments' . PHP_EOL);
			throw new Exception('Wrong number of arguments.');
		}
		
		//Load arguments to array
		$shortopts  = "";
		$longopts  = ["way:", "size:","alg:"];
		$options = getopt($shortopts, $longopts);
		
		$this->way=$options['way'];
		$this->size=$options['size'];
		
		//Check if exists of alg
		if(array_key_exists('alg', $options))
			$this->alg=$options['alg'];
		
		
	}
	
	/**
	* Check arguments types and values
	*/
	public function checkArguments()
	{
		// Check if file is a .csv file
		if(substr($this->way, -4) !== '.csv') 
		{
			//die(PHP_EOL . 'Error: invalid format of file' . PHP_EOL);
			throw new Exception('Invalid format of file.');
		}
		// Check if size have a numeric type
		if (!is_Numeric($this->size))
		{
			//die(PHP_EOL . 'Error: invalid type of argument size' . PHP_EOL);
			throw new Exception('Invalid type of argument size.');
		}
		// Check if alg have a numeric type
		if (!is_Numeric($this->alg))
		{
			//die(PHP_EOL . 'Error: invalid type of argument alg' . PHP_EOL);
			throw new Exception('Invalid type of argument alg.');
		}
		// Check number of algorithm
		if ($this->alg-1>=count($this->algorithms))
		{
			throw new Exception('Wrong number of algorithm.');
		}
	}
	
	/**
	* Load data from csv file to array
	*/
	public function loadData()
	{
		$file = fopen($this->way, "r");
		$items = fgetcsv($file);
		$numberOfItems=0;
		while ( ($items = fgetcsv($file,100,";") ) !== FALSE ) 
		{
			$this->checkItems($items);
			$this->loadItems($items, $numberOfItems);
			$numberOfItems++;
		}
	}
	
	/**
	* Load data of item
	* @param $items - array of arguments items
	* @param $numberOfItems - current index of listOfItems
	*/
	public function loadItems($items, $numberOfItems)
	{
		$id = $items[0];
		$weight = $items[1];
		$value = $items[2];
		$this->listOfItems[$numberOfItems]=new Item($id,$weight,$value);
	}
	
	/**
	* Check item's data types and values.
	* @param $items - array of arguments items
	*/
	public function checkItems($items)
	{
		// Check number of data
		if (count($items)!=3)
		{
			//die(PHP_EOL . 'Error: wrong format of data' . PHP_EOL);
			throw new Exception('Wrong format of data.');
		}
		// Check if data have a numeric type
		if (!is_Numeric($items[0]) || !is_Numeric($items[1]) || !is_Numeric($items[2]))
		{
			//die(PHP_EOL . 'Error: wrong type of data' . PHP_EOL);
			throw new Exception('Wrong type of data.');
		}
	}
	
	/**
	* Write result of algorithm.
	* @param $knapsack - knapsack filled with items
	*/
	public function writeResult($knapsack)
	{
		echo "Lista wybranych przedmiotów:\n";
		$items = $knapsack->getItems();
		foreach ($items as $x)
		{
			echo (string)$x;
		}
		echo "Całkowita wartość wybranych przedmiotów:\n";
		echo $knapsack->getTotalValue()."\n";
		echo "Sumaryczna waga wybranych przedmiotów\n";
		echo $knapsack->getTotalWeight()."\n";
	}
	
	public function getAlgorithm()
	{
		return $this->algorithms[$this->alg-1];
	}
	
	
	/**
	* Start the script.
	*/
	public function run()
	{
		try
		{
			$this->loadArguments();
			$this->checkArguments();
			$this->loadData();
			$algorithmClass = $this->getAlgorithm();
			$problem = new KnapsackProblem(new $algorithmClass);
			$knapsack=$problem->findBestDecision($this->size, $this->listOfItems);
			$this->writeResult($knapsack);
		}
		catch (Exception $e) 
		{
			echo 'Error: ',  $e->getMessage(), "\n";
		}
	}
}

$skript=new StartClass();
$skript->run();
?>