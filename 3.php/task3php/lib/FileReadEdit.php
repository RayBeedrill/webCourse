<?php
/*
*
* Class which can read text from files store text and edit strings and chars in it
*
*/

class FileReadEdit
{
	private $pathToFile;
	private $textInFile = array();
	
	/*
	*	Constructor get path from config file as default
	*/
	public function __construct()
	{
		if(is_readable(PATH_TO_FILE))
		{	
			if(!is_dir(PATH_TO_FILE))
			{
				$this->pathToFile = PATH_TO_FILE;
				$this->setTextArray();
			}
		}
		
	}
	
	/*
	*	set path to the file with text 
	*/
	public function setPathToRead($path)
	{
		if(is_readable($path))
		{
			if(!is_dir(PATH_TO_FILE))
			{
				$this->pathToFile = $path;
				return 1;
			}
			else
			{
				return FOLDER_ERR;
			}
		}
		else
		{
			return FILE_SEL;
		}
	}
	
	public function setTextArray()
	{
		if(is_file($this->pathToFile))
		{
			return $this->textInFile = file($this->pathToFile);
		}
		else
		{
			$this->textInFile = OPEN_STREAM_ERR;
			return $this->textInFile;
		}
	}
	
	/*
	*	gets text by strings and put in an array 
	*/
	public function getString($number)
	{
		if(is_int($number))
		{
			if(is_array($this->textInFile))
			{
				$stringsNum = count($this->textInFile);
				if($number < $stringsNum)
				{
					return $this->textInFile[$number];
				}
				else
				{
					return COUNT_ERR;
				}
			}
			else
			{
				return ARR_ERR;
			}
		}
		else
		{
			return INT_ERR;
		}
	}
	
	/*
	*	gets text by chars and put in an array 
	*/
	public function getSymbol($stringNum,$symbolNum)
	{
		if(is_int($stringNum) && is_int($symbolNum))
		{
			if(is_array($this->textInFile))
			{
				$stringsCount = count($this->textInFile);
				if($stringNum < $stringsCount)
				{
					$string = $this->textInFile[$stringNum];
					$symbolCount = strlen($string);
					if($symbolNum < $symbolCount)
					{
						return $string[$symbolNum];
					}
					else
					{
						return COUNT_ERR;
					}
				}
				else
				{
					return COUNT_ERR;
				}
			}
			else
			{
				return ARR_ERR;
			}
		}
		else
		{
			return INT_ERR;
		}
	}
	
	/*
	*	gets text by strings and put in an array 
	*/
	public function getTextByStrings()
	{
        if(is_array($this->textInFile))
		{
			$text;
			$rowCount = count($this->textInFile);
			for($i = 0; $i < $rowCount; $i++)
			{
				$text .= $this->getString($i) . "<br>";
			}
			return $text;
		}	
		else
		{
			return ARR_ERR;
		}
	}
	
	/*
	*	gets text by chars and put in an array 
	*/
	public function getTextBySymbols()
	{
		if(is_array($this->textInFile))
		{
			$text;
			$rowCount = count($this->textInFile);
			for($i = 0; $i < $rowCount; $i++)
			{
				$string = $this->getString($i);
				$stringLen = strlen($string);
				for($j = 0; $j < $stringLen; $j++)
				{
					$text .= $this->getSymbol($i,$j);
				}
				$text .= "<br>";
			}
			return $text;
		}	
		else
		{
			return ARR_ERR;
		}
	}
	
	/*
	*	Changes one string in text array
	*/
	public function changeStringInText($numberOfString, $content)
	{
		if(is_int($numberOfString))
		{
			$this->textInFile[$numberOfString] =  $content . "\n";
			return $this->textInFile;
		}
		else
		{
			return INT_ERR;
		}
	}
	
	/*
	*	Changes one char in text array
	*/
	public function changeSymbolsInString($numberOfString, $numberOfchar, $content)
	{
        if(is_int($numberOfString) && is_int($numberOfchar)
        && is_array($this->textInFile))
		{
			$this->textInFile[$numberOfString][$numberOfchar] = $content;
			return $this->textInFile;
		}
		else
		{
			return INT_ERR;
		}
	}
	
	/*
	*	Saves all changes which made in text array to source file
	*/
	public function saveChangesInText()
	{
        if(is_file($this->pathToFile))
        {
            $fileStream = fopen($this->pathToFile,"w+");
        }
        else
		{
			$this->textInFile = OPEN_STREAM_ERR;
			return $this->textInFile;
        }
  
        if($fileStream)
		{
			foreach($this->textInFile as $key => $value)
			{
				fwrite($fileStream,$value);
			}
			
			fclose($fileStream);
			return 1;
		}
		else
		{
			$this->textInFile = OPEN_STREAM_ERR;
			return $this->textInFile;
		}
	}
}
