<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("../NeuralNetwork.php");
require_once("../DB.php");

session_start();
// $_SESSION['epoch'] = 1;
$epoch = 50;
/*if(!$_SESSION['epoch']) {
	$_SESSION['epoch'] = 1;
} else {
	$_SESSION['epoch'] += $epoch;
}*/

print_r($_SESSION['epoch']);

echo "<pre>";

$db = new DB();
$res = $db->select("SELECT * FROM data WHERE id IN (1,2,3,306,303,4,305,5,6,7,304) limit 10");

$dataset = [];
while($row = $res->fetch()) {
	// print_r($row);
	eval("\$dataset[] = [{$row['expected']}, [{$row['data']}]];");
}

// print_r($dataset);

$network = new NeuralNetwork(20, 1, [20]);

// $data = [
// 	[0, [0,0,0,0]],
// 	[0, [0,0,0,1]],
// 	[1, [0,0,1,0]],
// 	[0, [0,0,1,1]],
// 	[0, [0,1,0,0]],
// 	[0, [0,1,0,1]],
// 	[1, [0,1,1,0]],
// 	[0, [0,1,1,1]],
// 	[1, [1,0,0,0]],
// 	[1, [1,0,0,1]],
// 	[1, [1,0,1,0]],
// 	[1, [1,0,1,1]],
// 	[1, [1,1,0,0]],
// 	[0, [1,1,0,1]],
// 	[1, [1,1,1,0]],
// 	[1, [1,1,1,1]],
// ];

// print_r($data);
//Обучение
// $error = $network->setLearningRate(0.05)->learn($dataset, 10);
// $network->saveToDB($_SESSION['epoch'], $error);
//print_r($network->layers);

//print_r($error);
//print_r($network);


// $network = NeuralNetwork::init("learning", 1);

// foreach ($dataset as $key => $data) {
// 	$network = new NeuralNetwork(20, 1, [20]);
// 	$network->enterData($data[1])->execute();

// 	print_network($network->layers);
// 	echo "expected = " . $data[0];

// 	echo "<br>---<br>";
// 	$network = null;
// }
// $error = $network->setLearningRate(0.1)->learn($dataset, $epoch);
// $network->saveToDB($_SESSION['epoch'], $error);

//if($_SESSION['epoch'] > 500) exit("stop");

echo "<br>OK";

?>

<!-- <script type="text/javascript">
	window.location.reload();
</script> -->