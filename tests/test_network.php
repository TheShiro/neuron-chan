<?php

error_reporting(E_ALL);

require_once("../NeuralNetwork.php");
echo "<pre>";

$network = new NeuralNetwork(3, 1, [2]);
//$network->enterData([0,0,0]);

//print_r($network);

//$network->execute();
$data = [
	[0, [0,0,0]],
	[0, [0,0,1]],
	[1, [0,1,1]],
	[1, [0,1,0]],
	[0, [1,1,0]],
	[0, [1,0,0]],
	[1, [1,0,1]],
	[1, [1,1,1]]
];
$network->backPropagation(1.0, [0,0,0]);

print_r($network->getResult());

echo "OK";