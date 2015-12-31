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
	 * Check if the service exists in the database
	 *
	 * @author salvipascual
	 * @param String, name of the service
	 * @return Boolean, true if service exist
	 * */
	public function serviceExist($serviceName)
	{
		$servicePath = $this->getPathToService($serviceName);
	 	return $servicePath ? true : false;
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
		// @NOTE
		// This method is harcoded in the SandBox environment
		// Call the method; it will work well once in production
		return true;
	}

	/**
	 * Get a person's profile
	 *
	 * @author salvipascual
	 * @return Array or false
	 * */
	public function getPerson($email)
	{
		// @NOTE
		// This method is hardcoded in the SandBox environment
		// Call the method; it will work well once in production
		$di = \Phalcon\DI\FactoryDefault::getDefault();
		$wwwroot = $di->get('path')['root'];
		$object = new stdClass();
		$object->email = 'salvi.pascual@gmail.com';
		$object->insertion_date = '2015-08-17 22:13:51';
		$object->first_name = 'Salvi';
		$object->middle_name = '';
		$object->last_name = 'Pascual';
		$object->mother_name = '';
		$object->date_of_birth = '1985-11-23';
		$object->interests = array('Networking','Amistad','Programacion','Apretaste','Videojuegos','Un trambia llamado deseo','Wii U','Ensennar','Correr','Patinar','Lectura','Peliculas','Blackjack','Viajar');
		$object->gender = 'M';
		$object->phone = '';
		$object->eyes = 'VERDE';
		$object->skin = 'BLANCO';
		$object->body_type = 'MEDIO';
		$object->hair = 'TRIGUENO';
		$object->province = 'LA_HABANA';
		$object->city = 'Miami-Dade';
		$object->highest_school_level = 'POSTGRADUADO';
		$object->occupation = 'Programador';
		$object->marital_status = 'CASADO';
		$object->about_me = 'Soy programador y profesor, buscando un mejor lugar en este mundo.';
		$object->credit = '75.3';
		$object->active = '1';
		$object->last_update_date = '2015-08-26 10:39:06';
		$object->updated_by_user = true;
		$object->picture = "$wwwroot/public/profile/salvi.pascual@gmail.com.png";
		$object->full_name = 'Salvi Pascual';
		$object->raffle_tickets = 10;
		return $object;
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
		// @NOTE
		// This method is hardcoded in the SandBox environment
		// Call the method; it will work well once in production
		return array("First", "Middle", "Last", "Mother");
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
		// @NOTE
		// This method is hardcoded in the SandBox environment
		// Call the method; it will work well once in production
		return "90";
	}

	/**
	 * To create the text that will be shown when the
	 * user click on the Edit Profile button
	 * */
	public function createProfileEditableText($email)
	{
		// @NOTE
		// This method is hardcoded in the SandBox environment
		// Call the method; it will work well once in production

		return urlencode(preg_replace('/\t/', '',
			"# Su nombre, por ejemplo: NOMBRE = Juan Perez Gutierres
			NOMBRE = 
			
			# Su Fecha de nacimiento, por ejemplo: CUMPLEANO = 23/08/1995
			CUMPLEANOS = 
			
			# Su Profesion resumida en una sola palabra, por ejemplo: Arquitecto
			PROFESION = 
				
			# Provincia donde vives
			PROVINCIA = 
			
			# Ciudad donde vives
			CIUDAD = 
			
			# Escoja entre: M o F, por ejemplo: SEXO = M
			SEXO = 
			
			# Escoja entre: primario, secundario, tecnico, universitario, postgraduado, doctorado u otro
			NIVEL ESCOLAR = 
			
			# Escoja entre: soltero,saliendo,comprometido o casado
			ESTADO CIVIL = 
			
			# Escoja entre: trigueno, castano, rubio, negro, rojo, blanco u otro
			PELO = 
			
			# Escoja entre: negro, blanco, mestizo u otro
			PIEL = 
			
			# Escoja entre: negro, carmelita, verde, azul, avellana u otro
			OJOS = 
			
			# Escoja entre delgado, medio, extra o atletico
			CUERPO = 
			
			# Liste sus intereses separados por coma, ejemplo: INTERESES = carros, playa, musica
			INTERESES = 
			
			
			# Y no olvide adjuntar su foto!"));
	}
}
