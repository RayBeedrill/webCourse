<?php
/**
 *  Class for autoloading classes
 */
class Autoloader
{
    
	/**
	 *  convert namespace to full file path
	 * @param  STRING $class string of namespace
	 * 
	 */
    public static function loadPackages($class)
    {
		$class = '' . str_replace('\\', '/', $class) . '.php';
		
		if(!TEST_MODE)
		{
			include_once($class);	
		}
		else
		{
			@include_once($class); 	// used for dissabling test module error
		}
    }
}