<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("../NeuralNetwork.php");
echo "<pre>";

$network = new NeuralNetwork(4, 1, [2]);

$data = [
	[0, [0,0,0,0]],
	[0, [0,0,0,1]],
	[1, [0,0,1,0]],
	[0, [0,0,1,1]],
	[0, [0,1,0,0]],
	[0, [0,1,0,1]],
	[1, [0,1,1,0]],
	[0, [0,1,1,1]],
	[1, [1,0,0,0]],
	[1, [1,0,0,1]],
	[1, [1,0,1,0]],
	[1, [1,0,1,1]],
	[1, [1,1,0,0]],
	[0, [1,1,0,1]],
	[1, [1,1,1,0]],
	[1, [1,1,1,1]],
];
//Обучение
//$error = $network->setLearningRate(0.1)->learn($data, 10);
//$network->saveNetwork("testing");
//print_r($network->layers);

//print_r($error);
//print_r($network);


$network = NeuralNetwork::init("testing");
print_r($network);

echo "<br>OK";