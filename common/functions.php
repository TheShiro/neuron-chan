<?php

function print_network(array $layers)
{
	echo "<table border=1>";

	//print_r($layers);
	foreach ($layers as $key => $layer) {
		echo "<tr>";
		//print_r($layer);
		foreach ($layer->neurons as $key => $neuron) {
			echo "<td>";
			echo "<pre>";
			print_r($neuron);
			echo "</td>";
		}

		echo "</tr>";
	}

	echo "</table>";
}

function draw_network(array $layers, int $exp)
{
	require "network.php";
	echo "expected = " . $exp;
}

?>