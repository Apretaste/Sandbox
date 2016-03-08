<?php

class Utils
{
	/**
	 * Returns a valid Apretaste email to send an email
	 *
	 * @author salvipascual
	 * @return String, email address
	 */
	public function getValidEmailAddress()
	{
		// @NOTE
		// This method is not operative in the SandBox environment
		// Please call the method and it will work once in production
		return "apretaste@gmail.com";
	}

	/**
	 * Format a link to be an Apretaste mailto
	 *
	 * @author salvipascual
	 * @param String , name of the service
	 * @param String , name of the subservice, if needed
	 * @param String , pharse to search, if needed
	 * @param String , body of the email, if necessary
	 * @return String, link to add to the href section
	 */
	public function getLinkToService($service, $subservice=false, $parameter=false, $body=false)
	{
		$link = "mailto:".$this->getValidEmailAddress()."?subject=".strtoupper($service);
		if ($subservice) $link .= " $subservice";
		if ($parameter) $link .= " $parameter";
		if ($body) $link .= "&body=$body";
		return $link;
	}

	/**
	 * Check if the service exists
	 * 
	 * @author salvipascual
	 * @param String, name of the service
	 * @return Boolean, true if service exist
	 * */
	public function serviceExist($serviceName)
	{
		$di = \Phalcon\DI\FactoryDefault::getDefault();
		$wwwroot = $di->get('path')['root'];
		return file_exists("$wwwroot/services/$serviceName/config.xml");
	}
	
		/**
	 * Check if the Person exists in the database
	 * 
	 * @author salvipascual
	 * @param String $personEmail, email of the person
	 * @return Boolean, true if Person exist
	 * */
	public function personExist($personEmail)
	{
		$connection = new Connection();
		$res = $connection->deepQuery("SELECT email FROM person WHERE LOWER(email)=LOWER('$personEmail')");
		return count($res) > 0;
	}

	/**
	 * Get a person's profile
	 *
	 * @author salvipascual
	 * @return Array or false
	 * */
	public function getPerson($email)
	{
		// get the person
		$connection = new Connection();
		$person = $connection->deepQuery("SELECT * FROM person WHERE email = '$email'");

		// return false if there is no person with that email
		if (count($person)==0) return false;
		else $person = $person[0];

		// get number of tickets for the raffle adquired by the user
		$tickets = $connection->deepQuery("SELECT count(*) as tickets FROM ticket WHERE raffle_id is NULL AND email = '$email'");
		$tickets = $tickets[0]->tickets;

		// get the person's full name
		$fullName = "{$person->first_name} {$person->middle_name} {$person->last_name} {$person->mother_name}";
		$fullName = trim(preg_replace("/\s+/", " ", $fullName));

		// get the image of the person
		$image = NULL;
		$thumbnail = NULL;
		if($person->picture)
		{
			$di = \Phalcon\DI\FactoryDefault::getDefault();
			$wwwroot = $di->get('path')['root'];

			if(file_exists("$wwwroot/public/profile/$email.jpg")) 
			{
				$image = "$wwwroot/public/profile/$email.jpg";
			}

			if(file_exists("$wwwroot/public/profile/thumbnail/$email.jpg"))
			{ 
				$thumbnail = "$wwwroot/public/profile/thumbnail/$email.jpg";
			}
		}

		// get the interests as an array
		$person->interests = preg_split('@,@', $person->interests, NULL, PREG_SPLIT_NO_EMPTY);

		// remove all whitespaces at the begining and ending
		foreach ($person as $key=>$value)
		{
			if( ! is_array($value)) $person->$key = trim($value); 
		}

		// add elements to the response
		$person->full_name = $fullName;
		$person->picture = $image;
		$person->thumbnail = $thumbnail;
		$person->raffle_tickets = $tickets;
		return $person;
	}


	/**
	 * Get the path to a service. 
	 * 
	 * @author salvipascual
	 * @param String $serviceName, name of the service to access
	 * @return String, path to the service, or false if the service do not exist
	 * */
	public function getPathToService($serviceName)
	{
		// get the path to service 
		$di = \Phalcon\DI\FactoryDefault::getDefault();
		$wwwroot = $di->get('path')['root'];
		$path = "$wwwroot/services/$serviceName";

		// check if the path exist and return it
		if(file_exists($path)) return $path;
		else return false;
	}

	/**
	 * Return the current Raffle or false if no Raffle was found
	 * 
	 * @author salvipascual
	 * @return Array or false
	 * */
	public function getCurrentRaffle()
	{
		// @NOTE
		// This method is hardcoded in the SandBox environment
		// Call the method; it will work well once in production
		$object = new stdClass();
		$object->raffle_id = '7';
		$object->item_desc = 'Este mes rifamos $10 de recarga de Etecsa, ya sea para su telefono celular, para su nauta o para navegar por Internet, usted elige. Si sale ganador le enviaremos un email preguntando su eleccion y le asignaremos la recarga en las siguientes 72 horas. Como ya es comun tambien rifamos dos recargas de $5 en credito de Apretaste para el segundo y el tercer lugar.';
		$object->start_date = '2015-11-01 00:00:00';
		$object->end_date = '2015-11-30 23:59:59';
		$object->winner_1 = '';
		$object->winner_2 = '';
		$object->winner_3 = '';
		$object->tickets = '20';
		$object->image = '/var/www/Sandbox/public/raffle/8f14e45fceea167a5a36dedd4bea2543.png';
		return $object;
	}

	/**
	 * Generate a new random hash. Mostly to be used for temporals
	 *
	 * @author salvipascual
	 * @return String
	 */
	public function generateRandomHash()
	{
		$rand = rand(0, 1000000);
		$today = date('full');
		return md5($rand . $today);
	}

	/**
	 * Reduce image size and optimize the image quality
	 * 
	 * @TODO Find an faster image optimization solution
	 * @author salvipascual
	 * @param String $imagePath, path to the image
	 * */
	public function optimizeImage($imagePath, $width=false, $height=false)
	{
		// @NOTE
		// This method is not operative in the SandBox environment
		// Call the method; it will work well once in production
	}

	/**
	 * Add a new subscriber to the email list in Mail Lite
	 * 
	 * @author salvipascual
	 * @param String email
	 * */
	public function subscribeToEmailList($email)
	{
		// @NOTE
		// This method is not operative in the SandBox environment
		// Call the method; it will work well once in production
	}

	/**
	 * Delete a subscriber from the email list in Mail Lite
	 * 
	 * @author salvipascual
	 * @param String email
	 * */
	public function unsubscribeFromEmailList($email)
	{
		// @NOTE
		// This method is not operative in the SandBox environment
		// Call the method; it will work well once in production
	}

	/**
	 * Get the pieces of names from the full name
	 *
	 * @author hcarras
	 * @param String $name, full name
	 * @return Array [$firstName, $middleName, $lastName, $motherName]
	 * */
	public function fullNameToNamePieces($name)
	{
		$namePieces = explode(" ", $name);
		$newNamePieces = array();
		$tmp = "";

		foreach ($namePieces as $piece)
		{
			$tmp .= "$piece ";
		
			if(in_array(strtoupper($piece), array("DE","LA","Y","DEL")))
			{
				continue;
			}
			else
			{
				$newNamePieces[] = $tmp;
				$tmp = "";
			}
		}

		$firstName = "";
		$middleName = "";
		$lastName = "";
		$motherName = "";

		if(count($newNamePieces)>=4)
		{
			$firstName = $newNamePieces[0];
			$middleName = $newNamePieces[1];
			$lastName = $newNamePieces[2];
			$motherName = $newNamePieces[3];
		}

		if(count($newNamePieces)==3)
		{
			$firstName = $newNamePieces[0];
			$lastName = $newNamePieces[1];
			$motherName = $newNamePieces[2];
		}

		if(count($newNamePieces)==2)
		{
			$firstName = $newNamePieces[0];
			$lastName = $newNamePieces[1];
		}

		if(count($newNamePieces)==1)
		{
			$firstName = $newNamePieces[0];
		}

		return array($firstName, $middleName, $lastName, $motherName);
	}
	

	/**
	 * Get the completion percentage of a profile
	 *
	 * @author kuma, updated by salvipascual
	 * @param String, email of the person
	 * @return Number, percentage of completion
	 * */
	public function getProfileCompletion($email)
	{
		$profile = $this->getPerson($email);
		$percent = 0;

		if($profile)
		{
			$keys = get_object_vars($profile);
			$parts = 0;
			$total = count($keys);

			foreach($keys as $key=>$value)
			{
				// do not count non-required values
				if(
					$key == "middle_name" ||
					$key == "mother_name" ||
					$key == "about_me" ||
					$key == "updated_by_user" ||
					$key == "raffle_tickets" ||
					$key == "last_update_date" ||
					$key == "phone" ||
					$key == "cellphone" ||
					$key == "credit"
				) {$total--; continue;}

				// add non-empty values to the formula 
				if( ! empty($value)) $parts++;
			}

			// calculate percentage
			$percent = $parts / $total * 100;
		}
		return $percent;
	}
}
