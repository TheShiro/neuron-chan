<?php

require_once("Neuron.php");
require_once("Layer.php");
require_once("File.php");
require_once("common/functions.php");

class NeuralNetwork
{
	
	public $layers;
	public $inputCount;
	public $outputCount;
	public $hiddenCount;
	public $learningRate = 0.1;

	public function __construct(int $inputCount, int $outputCount, array $hiddenCount)
	{
		//initialize properties
		$this->inputCount = $inputCount;
		$this->outputCount = $outputCount;
		$this->hiddenCount = $hiddenCount;
		//create layers
		$this->CreateInputLayer();
		$this->CreateHiddenLayer();
		$this->CreateOutputLayer();
	}

	public static function init(string $filename) : NeuralNetwork
	{
		//get saving NN from saving file
		$jsonNetwork = File::get($filename);
		$tmpNetwork = json_decode($jsonNetwork);
		//initialize NN
		$self = new self($tmpNetwork->inputCount, $tmpNetwork->outputCount, $tmpNetwork->hiddenCount);
		//set weihts nerouns from saving
		$self->initWeights($tmpNetwork->layers);

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
			//get signals from previous layer
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

				//visual representation NN
				draw_network($this->layers);
			}
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

		for ($j = count($this->layers) - 2; $j >= 0; $j--) { 
			$layer = $this->layers[$j];
			$prevLayer = $this->layers[$j + 1];

			for ($i=0; $i < count($layer->neurons); $i++) { 
				$neuron =  $layer->neurons[$i];

				for ($k=0; $k < count($prevLayer->neurons); $k++) { 
					$prevNeuron = $prevLayer->neurons[$k];
					$error = $prevNeuron->weights[$i] * $prevNeuron->delta;
					$neuron->learn($error, $this->learningRate);
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
			throw new Exception("Error! The number of input signals is different", 1);
		}

		$this->firstLayer()->setSignals($inputSignals);

		return $this;
	}

	public function saveNetwork(string $name) : void 
	{
		File::set($name, json_encode($this));
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
		$inputLayer->setCount($this->inputCount)
				   ->addNeurons(new Neuron(1, 'input'));
		$this->addLayer($inputLayer);
	}

	private function CreateHiddenLayer() : void
	{
		foreach($this->hiddenCount as $count) {
			$hiddenLayer = new Layer();
			$hiddenLayer->setCount($count)
						->addNeurons(new Neuron($this->lastLayer()->count));
			$this->addLayer($hiddenLayer);
		}
	}

	private function CreateOutputLayer() : void
	{
		$outputLayer = new Layer();
		$outputLayer->setCount($this->outputCount)
					->addNeurons(new Neuron($this->lastLayer()->count, 'output'));
		$this->addLayer($outputLayer);
	}

	private function initWeights(array $layers) : void
	{
		foreach ($layers as $l => $layer) {
			foreach ($layer->neurons as $n => $neuron) {
				$this->layers[$l]->neurons[$n]->initWeights($neuron->weights);
			}
		}
	}

}