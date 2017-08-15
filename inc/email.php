<?php

class EmailHandler {

	function extractHeadersAndRawBody($content){
		$lines = preg_split("/(\r?\n|\r)/", $content);

		$currentHeader = '';

		$rawFields = Array();

		$i = 0;
		foreach ($lines as $line)
		{
		  if($this->isNewLine($line))
		  {
				// end of headers
				$this->rawBodyLines = array_slice($lines, $i);
				break;
		  }

		  if ($this->isLineStartingWithPrintableChar($line)) // start of new header
		  {
				preg_match('/([^:]+): ?(.*)$/', $line, $matches);
				$newHeader = strtolower($matches[1]);
				$value = $matches[2];

				if(!isset($rawFields[$newHeader]) || !is_array($rawFields[$newHeader])){
					 $rawFields[$newHeader] = Array();
					 $currentArrayIndex = 0;
				}
				else{
					 $currentArrayIndex = count($rawFields[$newHeader]);
				}

				$rawFields[$newHeader][$currentArrayIndex] = $value;
				$currentHeader = $newHeader;
		  }
		  else // more lines related to the current header
		  {
				if ($currentHeader) { // to prevent notice from empty lines
					 $rawFields[$currentHeader][count($rawFields[$currentHeader]) - 1] .= ' ' . substr($line, 1);
				}
		  }
		  $i++;
		}

		return $rawFields;

	}

	function isNewLine($line){
		$line = str_replace("\r", '', $line);
		$line = str_replace("\n", '', $line);

		return (strlen($line) === 0);
	}

	function isLineStartingWithPrintableChar($line){
		return preg_match('/^[A-Za-z]/', $line);
	}



	function doParse($email){
		$auth = array("dkim"=>False, "spf"=>False);
		$parsed = $this->extractHeadersAndRawBody($email);

		if(!isset($parsed) || !isset($parsed['authentication-results']) || !is_array($parsed['authentication-results'])){
		  return $auth;
		}

		foreach($parsed['authentication-results'] as $row){

			$spfStr = " spf=pass ";
			if(strpos($row, $spfStr) !== false){
				$auth['spf'] = true;
			}

			$dkimStr = " dkim=pass ";
			if(strpos($row, $dkimStr) !== false){
				$auth['dkim'] = true;
			}

		}

		return $auth;

	}

	function pickRow($arr, $key, $val){
		foreach($arr as $row){
			if($row[$key] == $val){
				return $row;
			}
		}

		return false;
	}

}

$emailHandler = new EmailHandler();

?>
