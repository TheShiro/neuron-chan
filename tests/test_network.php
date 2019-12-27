<?php

error_reporting(E_ALL);

require_once("../NeuralNetwork.php");
echo "<pre>";

$network = new NeuralNetwork(3, 1, [2]);
//$network->enterData([0,0,0]);

//print_r($network);

//$network->execute();
$data = [
	[0, [0,0,0]]
];
$network->setLearningRate(0.1)->learn($data, 3);
//$network->learn($data, 3);

//print_r($network->getResult());

echo "OK";