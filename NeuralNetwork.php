<?php

require_once("Neuron.php");
require_once("Layer.php");
require_once("classes/functions.php");

class NeuralNetwork
{
	
	public $layers;
	public $inputCount;
	public $outputCount;
	public $hiddenCount;
	public $learningRate = 0;

	public function __construct(int $inputCount, int $outputCount, array $hiddenCount)
	{
		$this->inputCount = $inputCount;
		$this->outputCount = $outputCount;
		$this->hiddenCount = $hiddenCount;

		$this->CreateInputLayer();
		$this->CreateHiddenLayer();
		$this->CreateOutputLayer();
	}

	public static function loadNetwork(string $filename) : NeuralNetwork
	{
		//TODO load file with weights
		$self = new self();
		$self->inputCount = $inputCount;
		$self->outputCount = $outputCount;
		$self->hiddenCount = $hiddenCount;

		$self->CreateInputLayer();
		$self->CreateHiddenLayer();
		$self->CreateOutputLayer();

		return $self;
	}

	public function setLearningRate(float $rate) : NeuralNetwork
	{
		$this->learningRate = $rate;
		return $this;
	}

	public function execute() : NeuralNetwork
	{
		foreach($this->layers as $k => $layer) {
			if($k == 0) continue;

			$signals = $this->layers[$k - 1]->getSignals();

			foreach($layer->neurons as $neuron) {
				$neuron->activation($signals);
			}
		}

		return $this;
	}

	public function learn(array $dataset, int $epoch) : float 
	{
		$error = 0.0;

		for($i = 0; $i < $epoch; $i++) {
			foreach ($dataset as $date) {
				$error += $this->backPropagation($date[0], $date[1]);
			}
			//print_r($this->layers[1]);
			//print_network($this->layers);
			//echo "<br>----------------------------------------<br>";
		}

		return $error / $epoch;
	}

	private function backPropagation(float $expected, array $inputs) : float
	{
		$this->enterData($inputs)->execute();
		
		$actual = $this->getResult()->output;
		$difference = $actual - $expected;

		foreach ($this->lastLayer()->neurons as $key => $neuron) {
			$neuron->learn($difference, $this->learningRate);
		}

		for ($i = count($this->layers) - 2; $i >=0; $i--) { 
			$layer = $this->layers[$i + 1];

			foreach ($this->layers[$i]->neurons as $key => $neuron) {
				//print_r($neuron);
				foreach ($layer->neurons as $k => $n) {
					$error = $n->weights[$key] * $n->delta;
					$neuron->learn($error, $this->learningRate);
					//echo "<br><br>";
				}
			}
		}

		return $difference ** 2;
	}

	public function getResult() : Neuron
	{
		return end($this->lastLayer()->neurons);
	}

	public function enterData(array $inputSignals) : NeuralNetwork
	{
		if(count($inputSignals) != $this->inputCount) {
			throw new Exception("Error! The number of input signals different from the number of neurons of first layer", 1);
		}

		$this->firstLayer()->setSignals($inputSignals);

		return $this;
	}

	private function addLayer(Layer $layer) : void
	{
		$this->layers[] = $layer;
	}

	private function firstLayer() : Layer 
	{
		return $this->layers[0];
	}

	private function lastLayer() : Layer 
	{
		return end($this->layers);
	}

	private function CreateInputLayer() : void
	{
		$inputLayer = new Layer();
		$inputLayer->setCount($this->inputCount)->addNeurons(new Neuron(1, 'input'));
		$this->addLayer($inputLayer);
	}

	private function CreateHiddenLayer() : void
	{
		foreach($this->hiddenCount as $count) {
			$hiddenLayer = new Layer();
			$hiddenLayer->setCount($count)->addNeurons(new Neuron($this->lastLayer()->count));
			$this->addLayer($hiddenLayer);
		}
	}

	private function CreateOutputLayer() : void
	{
		$outputLayer = new Layer();
		$outputLayer->setCount($this->outputCount)->addNeurons(new Neuron($this->lastLayer()->count, 'output'));
		$this->addLayer($outputLayer);
	}

}