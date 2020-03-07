<?php
	//print_network($layers); 
	//print_r($layers);
?>
<link rel="stylesheet" href="../common/style.css">

<div class="network">
	<div class="layout">
		<div class="neuron"><?=$layers[0]->neurons[0]->output?></div>
		<div class="neuron_2"><?=$layers[0]->neurons[1]->output?></div>
		<div class="neuron_3"><?=$layers[0]->neurons[2]->output?></div>
		<div class="neuron_33"><?=$layers[0]->neurons[3]->output?></div>

		<div class="weight_1"><?=$layers[1]->neurons[0]->weights[0]?></div>
		<div class="weight_2"><?=$layers[1]->neurons[1]->weights[0]?></div>
		<div class="weight_3"><?=$layers[1]->neurons[0]->weights[1]?></div>
		<div class="weight_4"><?=$layers[1]->neurons[1]->weights[1]?></div>
		<div class="weight_5"><?=$layers[1]->neurons[0]->weights[2]?></div>
		<div class="weight_6"><?=$layers[1]->neurons[1]->weights[2]?></div>

		<div class="weight_55"><?=$layers[1]->neurons[0]->weights[3]?></div>
		<div class="weight_66"><?=$layers[1]->neurons[1]->weights[3]?></div>
	</div>
	<div class="layout">
		<div class="neuron_4"><?=$layers[1]->neurons[0]->output?></div>
		<div class="neuron_5"><?=$layers[1]->neurons[1]->output?></div>

		<div class="weight_7"><?=$layers[2]->neurons[0]->weights[0]?></div>
		<div class="weight_8"><?=$layers[2]->neurons[0]->weights[1]?></div>
	</div>
	<div class="layout">
		<div class="neuron_6"><?=$layers[2]->neurons[0]->output?></div>
	</div>
</div>