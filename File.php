<?php 

class File 
{

	private static $path = "../networks/";

	public static function get(string $filename) : string
	{
		return file_get_contents(self::$path . $filename);
	}

	public static function set(string $filename, string $data) : void
	{
		file_put_contents(self::$path . $filename, $data);
	}

}

?>