<?php

class SurveyParser
{
	/**
	 * Parse a text from the body based on the rules
	 * 
	 * @param String $text
	 * @param Array $rules
	 * @return Array
	 * */
	public function parse($text, $rules)
	{
		// do not try parsing if text was not provide or is invalid
		if(empty($text)) return array(); 

		// convert text to array of entries
		$entries = $this->textToArrayOfEntries($text);

		// parse the text based on the rules
		foreach ($rules as $rule)
		{
			// get the entry mathing the rule
			$name = $rule[0];
			$type = $rule[1];
			$enums = $rule[2];
	
			// only work for the values passed
			if(isset($entries[$name]))
			{
				// get the value passed by the user 
				$value = $entries[$name];

				// check for date rules
				switch ($type)
				{
					case "date" : { $entries[$name] = $this->parseDate($value); break; }
					case "gender" : { $entries[$name] = $this->parseGender($value); break; }
					case "enum" : { $entries[$name] = $this->parseEnum($value, $enums); break; }
					case "list" : { $entries[$name] = $this->parseList($value); break; }
					default : $entries[$name] = trim($value);
				}
			}
		}

		return $entries;
	}

	/**
	 * Convert text to array of results
	 * */
	public function textToArrayOfEntries($text)
	{
		// convert and return
		return parse_ini_string($text, false, INI_SCANNER_RAW);
	}

	/**
	 * Parse a date
	 * */
	public function parseDate($value)
	{
		// read date in Spanish
		setlocale(LC_ALL,"es_ES");

		// try getting the date
		$date = DateTime::createFromFormat("d/m/Y", $value);

		// if date could not be calculated, return null 
		if(empty($date)) return null;
		else return strftime("%Y-%m-%d", $date->getTimestamp());
	}

	/**
	 * Parse a gender
	 * */
	public function parseGender($value)
	{
		$upperValue = strtoupper($value);
		$valueFirstCharacter = substr($upperValue, 0, 1);

		if($value == "HOMBRE" || $value == "VARON" || $valueFirstCharacter == "M") return "M";
		if($value == "HEMBRA" || $value == "MUJER" || $valueFirstCharacter == "F") return "F";
		return "";
	}

	/**
	 * Parse a comma separated list
	 * */
	public function parseList($value)
	{
		// do not work if the list is empty
		if(empty($value)) return null;

		// clean the list
		$cleanList = array();
		foreach (explode(",", $value) as $element)
		{
			$cleanList[] = trim($element);
		}

		// return cleaned list
		return $cleanList;
	}

	/**
	 * Parse an enum
	 * 
	 * @param String value to be parsed
	 * @param Array of keys
	 * @return String correct enum value
	 * */
	public function parseEnum($value, $enums)
	{
		$value = trim(strtoupper($value));
		$similarityPercent = array(); 

		// get all similarity percents
		foreach ($enums as $enum)
		{
			// do not waste resources if is the exact value 
			$upperEnum = strtoupper($enum);
			if($value == $upperEnum) return $enum;

			// else calculate the similarity
			similar_text($value, $upperEnum, $percent);
			$similarityPercent[] = $percent; 
		}

		// if no object was 100% similar, get the most similar
		$higest = 0;
		for ($i=1; $i<count($similarityPercent); $i++)
		{
			if($similarityPercent[$i] > $similarityPercent[$higest]) $higest = $i;
		}

		// retuen higest value if it is real similar
		if($similarityPercent[$higest] > 50) return $enums[$higest];
		else return null;
	}
}
