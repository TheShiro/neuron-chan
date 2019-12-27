<?php

class Neuron 
{

	public $weights;
	public $inputs;
	public $type;
	public $output;
	public $delta;

	public function __construct(int $inputCount, string $type = "hidden")
	{
		$this->type = $type;

		if($this->type != "input") {
			for($i = 0; $i < $inputCount; $i++) {
				$this->weights[$i] = rand(0, 100) / 100;
			}
		} else {
			$this->weights = array_fill(0, $inputCount, 1);
		}
	}

	public function activation(array $inputs) : void
	{
		if(count($inputs) != count($this->weights)) {
			throw new Exception("Error! The number of input signals different from the number of weights of the neuron", 1);
		}

		$sum = 0.0;

		foreach ($inputs as $key => $value) {
			$this->inputs[$key] = $value;
			$sum += $value * $this->weights[$key];
		}

		$this->output = $this->sigmoid($sum);
	}

	public function setSignal(float $signal) : void
	{
		$this->output = $signal;
	}

	private function sigmoid(float $x) : float 
	{
		return 1.0 / (1.0 + exp(-$x));
	}

	private function sigmoidDelta(float $x) : float
	{
		return $this->sigmoid($x) / (1 - $this->sigmoid($x));
	}

	public function learn(float $error, float $rate) : void
	{
		if($this->type == "input") return;

		$this->delta = $error * $this->sigmoid($this->output);

		foreach ($this->weights as $key => $value) {
			$this->weights[$key] = $value - $this->inputs[$key] * $this->delta * $rate;
		}
	}

}