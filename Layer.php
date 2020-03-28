<?php

class Layer
{

	public $neurons;
	public $count;

	public function setCount(int $count) : Layer
	{
		$this->count = $count;
		return $this;
	}

	public function addNeurons(Neuron $neuron) : Layer
	{
		for ($i=0; $i < $this->count; $i++) { 
			$this->neurons[] = clone $neuron;
		}
		return $this;
	}

	public function getSignals() : array
	{
		$arr = [];
		foreach ($this->neurons as $neuron) {
			$arr[] = $neuron->output;
		}
		return $arr;
	}

	public function setSignals(array $inputSignals) : void
	{
		foreach ($inputSignals as $key => $signal) {
			$this->neurons[$key]->setSignal($signal);
		}
	}

}

?>