<?php

class DataModel
{
	
	public static function Normalisation(array $arr) : array
	{
		$min = $arr[0];
		$max = $arr[0];
		array_map(function($val) use (&$min, &$max) {
			$min = $min <= $val ? $min : $val;
			$max = $max >= $val ? $max : $val;
		}, $arr);
		// print_r($min);
		// echo " - ";
		// print_r($max);

		$midd = ($min + $max) / count($arr);
		// echo " - ";
		// print_r($midd);

		return self::func2($arr, $midd);
	}

	/**
	 * every elements of array is division on middle
	 */
	private static function func1(array $arr, float $midd) : array
	{
		for ($i=0; $i < count($arr); $i++) { 
			$arr[$i] = round($arr[$i] / $midd, 2);
		}
		return $arr;
	}

	/**
	 * element minus the previous element will divided on middle
	 */
	private static function func2(array $arr, float $midd) : array
	{
		$temp= [0];
		for ($i=1; $i < count($arr); $i++) { 
			$temp[$i] = round(($arr[$i] - $arr[$i - 1]) / $midd, 2);
		}
		return $temp;
	}

}

?>