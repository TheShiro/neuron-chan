<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("../NeuralNetwork.php");
echo "<pre>";

$network = new NeuralNetwork(3, 1, [2]);
//$network->enterData([0,0,0]);

//print_r($network);

//$network->execute();
$data = [
	[1, [1,1,1]],
	[1, [0,0,1]],
	[1, [0,1,1]],
	[1, [0,1,0]],
	[1, [1,1,0]],
	[0, [1,0,0]]
];
$error = $network->setLearningRate(0.1)->learn($data, 300);
//print_r($network->layers);
print_r($error);
//$network->learn($data, 3);

//print_r($network->getResult());

echo "<br>OK";