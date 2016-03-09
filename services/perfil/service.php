<?php

class Perfil extends Service
{
	/**
	 * Display your profile
	 *
	 * @param Request $request			
	 * @return Response
	 */
	public function _main (Request $request)
	{
		// get the email or the username for the profile
		$request->query = trim($request->query, "@ ");
		$emailToLookup = empty($request->query) ? $request->email : $request->query;
		
		// get the email for the profile
		$isEmail = true;
		if ( ! filter_var($emailToLookup, FILTER_VALIDATE_EMAIL))
		{
			$connection = new Connection();
			$person = $connection->deepQuery("SELECT email FROM person WHERE username='$emailToLookup'");
			$emailToLookup = empty($person) ? "@$emailToLookup" : $person[0]->email;
			$isEmail = false;
		}
		
		// check if the person exist. If not, message the requestor
		if ( ! $this->utils->personExist($emailToLookup))
		{
			$responseContent = array(
					"email" => $emailToLookup,
					"isEmail" => $isEmail
			);
			
			$response = new Response();
			$response->setResponseSubject("No encontramos un perfil para ese usuario");
			$response->createFromTemplate("inexistent.tpl", $responseContent);
			return $response;
		}
		
		// get the full profile for the person
		$profile = $this->utils->getPerson($emailToLookup);
		
		// get the full name, or the email
		$fullName = empty($profile->full_name) ? $profile->username : trim($profile->full_name, " .,;");
		
		// get the age
		$age = empty($profile->date_of_birth) ? "" : date_diff(date_create($profile->date_of_birth), date_create('today'))->y;
		
		// get the gender
		$gender = "";
		if ($profile->gender == "M") $gender = "hombre";
		if ($profile->gender == "F") $gender = "mujer";
		
		// get the final vowel based on the gender
		$genderFinalVowel = "o";
		if ($profile->gender == "F") $genderFinalVowel = "a";
		
		// get the eye color
		$eyes = "";
		if ($profile->eyes == "NEGRO") $eyes = "negro";
		if ($profile->eyes == "CARMELITA") $eyes = "carmelita";
		if ($profile->eyes == "AZUL") $eyes = "azul";
		if ($profile->eyes == "VERDE") $eyes = "verde";
		if ($profile->eyes == "AVELLANA") $eyes = "avellana";
		
		// get the eye tone
		$eyesTone = "";
		if ($profile->eyes == "NEGRO" || $profile->eyes == "CARMELITA" || $profile->eyes == "AVELLANA") $eyesTone = "oscuros";
		if ($profile->eyes == "AZUL" || $profile->eyes == "VERDE") $eyesTone = "claros";
		
		// get the skin color
		$skin = "";
		if ($profile->skin == "NEGRO") $skin = "negr$genderFinalVowel";
		if ($profile->skin == "BLANCO") $skin = "blanc$genderFinalVowel";
		if ($profile->skin == "MESTIZO") $skin = "mestiz$genderFinalVowel";
		
		// get the type of body
		$bodyType = "";
		if ($profile->body_type == "DELGADO") $bodyType = "soy flac$genderFinalVowel";
		if ($profile->body_type == "MEDIO") $bodyType = "no soy de flac$genderFinalVowel ni grues$genderFinalVowel";
		if ($profile->body_type == "EXTRA") $bodyType = "tengo unas libritas de m&aacute;s";
		if ($profile->body_type == "ATLETICO") $bodyType = "tengo un cuerpazo atl&eacute;tico";
		
		// get the hair color
		$hair = "";
		if ($profile->hair == "TRIGUENO") $hair = "trigue&ntilde;o";
		if ($profile->hair == "CASTANO") $hair = "casta&ntilde;o";
		if ($profile->hair == "RUBIO") $hair = "rubio";
		if ($profile->hair == "NEGRO") $hair = "negro";
		if ($profile->hair == "ROJO") $hair = "rojizo";
		if ($profile->hair == "BLANCO") $hair = "canoso";
		
		// get the place where the person live
		$province = "";
		if ($profile->province == "PINAR_DEL_RIO") $province = "Pinar del R&iacute;o";
		if ($profile->province == "LA_HABANA") $province = "La Habana";
		if ($profile->province == "ARTEMISA") $province = "Artemisa";
		if ($profile->province == "MAYABEQUE") $province = "Mayabeque";
		if ($profile->province == "MATANZAS") $province = "Matanzas";
		if ($profile->province == "VILLA_CLARA") $province = "Villa Clara";
		if ($profile->province == "CIENFUEGOS") $province = "Cienfuegos";
		if ($profile->province == "SANCTI_SPIRITUS") $province = "Sancti Sp&iacute;ritus";
		if ($profile->province == "CIEGO_DE_AVILA") $province = "Ciego de &Aacute;vila";
		if ($profile->province == "CAMAGUEY") $province = "Camaguey";
		if ($profile->province == "LAS_TUNAS") $province = "Las Tunas";
		if ($profile->province == "HOLGUIN") $province = "Holgu&iacute;n";
		if ($profile->province == "GRANMA") $province = "Granma";
		if ($profile->province == "SANTIAGO_DE_CUBA") $province = "Santiago de Cuba";
		if ($profile->province == "GUANTANAMO") $province = "Guant&aacute;namo";
		if ($profile->province == "ISLA_DE_LA_JUVENTUD") $province = "Isla de la Juventud";
		
		// get the city
		$city = empty($profile->city) ? "" : ", {$profile->city}";
		
		// full location
		$location = ". Aunque prefiero no decir de donde soy";
		if ( ! empty($province)) $location = ". Vivo en " . $province . $city;
		
		// get highest educational level
		$education = "";
		if ($profile->highest_school_level == "PRIMARIO") $education = "tengo sexto grado";
		if ($profile->highest_school_level == "SECUNDARIO") $education = "soy graduad$genderFinalVowel de la secundaria";
		if ($profile->highest_school_level == "TECNICO") $education = "soy t&acute;cnico medio";
		if ($profile->highest_school_level == "UNIVERSITARIO") $education = "soy universitari$genderFinalVowel";
		if ($profile->highest_school_level == "POSTGRADUADO") $education = "tengo estudios de postgrado";
		if ($profile->highest_school_level == "DOCTORADO") $education = "tengo un doctorado";
		
		// get marital status
		$maritalStatus = "";
		if ($profile->marital_status == "SOLTERO") $maritalStatus = "estoy solter$genderFinalVowel";
		if ($profile->marital_status == "SALIENDO") $maritalStatus = "estoy saliendo con alguien";
		if ($profile->marital_status == "COMPROMETIDO") $maritalStatus = "estoy comprometid$genderFinalVowel";
		if ($profile->marital_status == "CASADO") $maritalStatus = "soy casad$genderFinalVowel";
		
		// get occupation
		$occupation = (empty($profile->occupation) || strlen($profile->occupation) < 5) ? false : strtolower($profile->occupation);
		if(stripos($occupation, "studiant") !== false) $occupation = "";
		
		// get religion
		$religions = array(
			'ATEISMO' => "soy ate$genderFinalVowel",
			'SECULARISMO' => 'no tengo creencia religiosa',
			'AGNOSTICISMO' => "soy agn&oacute;stic$genderFinalVowel",
			'ISLAM' => 'soy musulm&aacute;n',
			'JUDAISTA' => "soy jud&iacute;o$genderFinalVowel",
			'ABAKUA' => 'soy abaku&aacute;',
			'SANTERO' => "soy santer$genderFinalVowel",
			'YORUBA' => 'profeso la religi&oacute;n yoruba',
			'BUDISMO' => 'soy budista',
			'CATOLICISMO' => "soy cat&oacute;lic$genderFinalVowel",
			'OTRA' => '',
			'CRISTIANISMO' => "soy cristian$genderFinalVowel"
		);
		$religion = empty($profile->religion) ? "" : $religions[$profile->religion];

		// create the message
		$message = "Hola y bienvenido a mi perfil. Yo soy $fullName";
		if ( ! empty($religion)) $message .= " y $religion";
		if ( ! empty($age)) $message .= ", tengo $age a&ntilde;os";
		if ( ! empty($gender)) $message .= ", soy $gender";
		if ( ! empty($skin)) $message .= ", soy $skin";
		if ( ! empty($eyes)) $message .= ", de ojos $eyesTone (color $eyes)";
		if ( ! empty($hair)) $message .= ", soy de pelo $hair";
		if ( ! empty($bodyType)) $message .= " y $bodyType";
		$message .= $location;
		if ( ! empty($education)) $message .= ", $education";
		if ( ! empty($occupation)) $message .= ", trabajo como $occupation";
		if ( ! empty($maritalStatus)) $message .= " y $maritalStatus";
		$message .= ".";

		// check if the user is requesting its own profile
		$ownProfile = $emailToLookup == $request->email;

		// get the profile percentage of completion
		$completion = $ownProfile ? $this->utils->getProfileCompletion($emailToLookup) : "";

		// create a json object to send to the template
		$responseContent = array(
			"profile" => $profile,
			"message" => $message,
			"completion" => $completion,
			"ownProfile" => $ownProfile
		);

		// create the images to send to the response
		$di = \Phalcon\DI\FactoryDefault::getDefault();
		$wwwroot = $di->get('path')['root'];
		$image = empty($profile->thumbnail) ? array() : array(
				$profile->thumbnail
		);

		// create a new Response object and input the template and the content
		$response = new Response();
		$response->setResponseSubject("Perfil de Apretaste");
		$response->createFromTemplate("profile.tpl", $responseContent, $image);
		return $response;
	}

	/**
	 * Subservice Request
	 *
	 * @param Request $request			
	 */
	public function _nombre (Request $request)
	{
		$n = $this->utils->fullNameToNamePieces(trim($request->query));

		if ( ! is_array($n)) return new Response();
		for ($i = 0; $i <= 3; $i ++) $n[$i] = "'{$n[$i]}'";

		$query = " first_name = {$n[0]}, 
			middle_name = {$n[1]}, 
			last_name = {$n[2]}, 
			mother_name = {$n[3]}";
		
		$this->update($query, $request->email);
		return new Response();
	}

	/**
	 * Subservice CUMPLEANOS
	 *
	 * @param Request $request			
	 */
	public function _cumpleanos (Request $request)
	{
		return $this->subserviceDate($request, 'date_of_birth');
	}

	/**
	 * Subservice PROFESION
	 *
	 * @param Request $request			
	 */
	public function _profesion (Request $request)
	{
		return $this->subserviceSimple($request, 'occupation');
	}

	/**
	 * Subservice RELIGION
	 *
	 * @param Request $request			
	 */
	public function _religion (Request $request)
	{
		$religions = array(
			'ATEISMO',
			'SECULARISMO',
			'AGNOSTICISMO',
			'ISLAM',
			'JUDAISTA',
			'ABAKUA',
			'SANTERO',
			'YORUBA',
			'BUDISMO',
			'CATOLICISMO',
			'OTRA',
			'CRISTIANISMO'
		);
		
		$synon = array(
			'ATEO' => 'ATEISMO',
			'SECULAR' => 'SECULARISMO',
			'AGNOSTICO' => 'AGNOSTICISMO',
			'CATOLICO' => 'CATOLICISMO',
			'CRISTIANO' => 'CRISTIANISMO',
			'BUDISTA' => 'BUDISMO'
		);
		
		return $this->subserviceEnum($request, 'religion', $religions, 'Dinos tu religion o si careces de ella', null, $synon);
	}

	/**
	 * Subservice PROVINCIA
	 *
	 * @param Request $request			
	 * @return Response
	 */
	public function _provincia (Request $request)
	{
		$provs = array(
			'PINAR_DEL_RIO',
			'LA_HABANA',
			'ARTEMISA',
			'MAYABEQUE',
			'MATANZAS',
			'VILLA_CLARA',
			'CIENFUEGOS',
			'SANCTI_SPIRITUS',
			'CIEGO_DE_AVILA',
			'CAMAGUEY',
			'LAS_TUNAS',
			'HOLGUIN',
			'GRANMA',
			'SANTIAGO_DE_CUBA',
			'GUANTANAMO',
			'ISLA_DE_LA_JUVENTUD'
		);
		
		$synon = array();
		foreach ($provs as $v)
		{
			$synon[str_replace('_', ' ', $v)] = $v;
		}
		return $this->subserviceEnum($request, 'province', $provs, 'Diga la provincia donde vive', null, $synon);
	}

	/**
	 * Subservice CIUDAD
	 *
	 * @param Request $request			
	 */
	public function _ciudad (Request $request)
	{
		$query = trim($request->query);
		
		if ( ! empty($query))
		{
			$this->update("city = '{$query}'", $request->email);
		}
		
		return new Response();
	}

	/**
	 * Subservice SEXO
	 *
	 * @param Request $request			
	 */
	public function _sexo (Request $request)
	{
		return $this->subserviceEnum($request, 'gender', array(
				'F',
				'M'
		), 'Diga su sexo', null, array(
				'FEMENINO' => 'F',
				'MUJER' => 'F',
				'MASCULINO' => 'M',
				'HOMBRE' => 'M'
		));
	}

	/**
	 * Subservice NIVEL
	 *
	 * @param Request $request			
	 */
	public function _nivel (Request $request)
	{
		return $this->subserviceEnum($request, 'highest_school_level', 
				array(
						'PRIMARIO',
						'SECUNDARIO',
						'TECNICO',
						'UNIVERSITARIO',
						'POSTGRADUADO',
						'DOCTORADO',
						'OTRO'
				), 'Diga su nivel escolar', 'ESCOLAR');
	}

	/**
	 * Subservice alias for NIVEL
	 *
	 * @param Request $request			
	 */
	public function _nivelescolar (Request $request)
	{
		return $this->_nivel($request);
	}

	/**
	 * Subservice ESTADO
	 *
	 * @param Request $request			
	 *
	 * @return Response/void
	 */
	public function _estado (Request $request)
	{
		return $this->subserviceEnum($request, 'marital_status', array(
				'SOLTERO',
				'SALIENDO',
				'COMPROMETIDO',
				'CASADO'
		), 'Diga su estado civil', 'CIVIL');
	}

	/**
	 * Subservice ESTADO alias
	 *
	 * @param Request $request			
	 */
	public function _estadocivil (Request $request)
	{
		return $this->_estado($request);
	}

	/**
	 * Subservice PELO
	 *
	 * @param Request $request			
	 */
	public function _pelo (Request $request)
	{
		return $this->subserviceEnum($request, 'hair', 
				array(
						'TRIGUENO',
						'CASTANO',
						'RUBIO',
						'NEGRO',
						'ROJO',
						'BLANCO',
						'OTRO'
				), 'Diga su color de pelo');
	}

	/**
	 * Subservice OJOS
	 *
	 * @param Request $request			
	 */
	public function _ojos (Request $request)
	{
		return $this->subserviceEnum($request, 'eyes', array(
				'NEGRO',
				'CARMELITA',
				'VERDE',
				'AZUL',
				'AVELLANA',
				'OTRO'
		), 'Diga el color de sus ojos', null, array(
				'NEGROS' => 'NEGRO',
				'CARMELITAS' => 'CARMELITA',
				'VERDES' => 'VERDE',
				'AZULES' => 'AZUL'
		));
	}

	/**
	 * Subservice CUERPO
	 *
	 * @param Request $request			
	 */
	public function _cuerpo (Request $request)
	{
		return $this->subserviceEnum($request, 'body_type', array(
				'DELGADO',
				'MEDIO',
				'EXTRA',
				'ATLETICO'
		), 'Diga como es su cuerpo');
	}

	/**
	 * Subservice INTERESES
	 *
	 * @param Request $request			
	 */
	public function _intereses (Request $request)
	{
		return $this->subserviceSimple($request, 'interests');
	}

	/**
	 * Subservice FOTO
	 *
	 * @param Request $request			
	 * @return Response
	 */
	public function _foto ($request)
	{
		$attachments = $request->attachments;
		
		// move the first image attached to the profiles directory
		$isImageAttached = 0;
		if (count($attachments) > 0)
		{
			$di = \Phalcon\DI\FactoryDefault::getDefault();
			$wwwroot = $di->get('path')['root'];
			
			foreach ($attachments as $attach)
			{
				if ($attach->type == "image/jpeg")
				{
					// save the original copy
					$large = "$wwwroot/public/profile/{$request->email}.jpg";
					copy($attach->path, $large);
					$this->utils->optimizeImage($large);
					
					// create the thumbnail
					$thumbnail = "$wwwroot/public/profile/thumbnail/{$request->email}.jpg";
					copy($attach->path, $thumbnail);
					$this->utils->optimizeImage($thumbnail, 300);
					
					$isImageAttached = 1;
					break;
				}
			}
		}
		
		// make the changes in the database
		$this->update("picture='$isImageAttached'", $request->email);
		
		return new Response();
	}

	/**
	 * Subservice ORIENTACION SEXUAL
	 *
	 * @param Request $request			
	 */
	public function _orientacion (Request $request)
	{
		return $this->subserviceEnum($request, 'sexual_orientation', array(
				'HETERO',
				'HOMO',
				'BI'
		), 'Diga su orientacion sexual', 'SEXUAL', array(
				'HOMOSEXUAL' => 'HOMO',
				'HETEROSEXUAL' => 'HETERO',
				'BISEXUAL' => 'BI',
				'GAY' => 'HOMO'
		));
	}

	/**
	 * Alias for subservice ORIENTACION SEXUAL
	 *
	 * @param Request $request			
	 */
	public function _orientacionsexual (Request $request)
	{
		return $this->_orientacion($request);
	}

	/**
	 * Subservice piel
	 *
	 * @param Request $request			
	 */
	public function _piel (Request $request)
	{
		return $this->subserviceEnum($request, 'skin', array(
				'NEGRO',
				'BLANCO',
				'MESTIZO',
				'OTRO'
		), 'Diga su color de piel', null, array(
				'BLANCA' => 'BLANCO',
				'NEGRA' => 'NEGRO',
				'MESTIZA' => 'MESTIZO'
		));
	}

	/**
	 * Show the edit mode template
	 *
	 * @param Request $request			
	 * @return Response
	 *
	 */
	public function _editar (Request $request)
	{
		// get the text to parse
		$email = $request->email;
		
		$person = $this->utils->getPerson($email);
		
		if ($person === false)
		{
			$person = new stdClass();
			$person->thumbnail = null;
			$person->picture = '';
			$person->full_name = '';
			$person->gender = '';
			$person->sexual_orientation = '';
			$person->date_of_birth = '';
			$person->body_type = '';
			$person->eyes = '';
			$person->hair = '';
			$person->piel = '';
			$person->marital_status = '';
			$person->highest_school_level = '';
			$person->occupation = '';
			$person->province = '';
			$person->city = '';
			$person->interests = '';
			$person->religion = '';
		}
		
		$person->interests = implode(", ", $person->interests);
		$person->province = str_replace("_", " ", $person->province);
		if ($person->gender == 'M') $person->gender = "Masculino";
		if ($person->gender == 'F') $person->gender = "Femenino";
		$content = get_object_vars($person);
		
		// create the images to send to the response
		$di = \Phalcon\DI\FactoryDefault::getDefault();
		$wwwroot = $di->get('path')['root'];
		$image = empty($person->thumbnail) ? array() : array(
				$person->thumbnail
		);
		
		$response = new Response();
		$response->setResponseSubject('Edite su perfil');
		$response->createFromTemplate('profile_edit.tpl', $content, $image);
		return $response;
	}

	/**
	 * Update a profile
	 *
	 * @param String $sqlset			
	 * @param String $email			
	 */
	private function update ($sqlset, $email)
	{
		$query = "UPDATE person SET $sqlset, last_update_date=CURRENT_TIMESTAMP, updated_by_user=1	WHERE email='$email'";
		$query = preg_replace("/\s+/", " ", $query);
		$connection = new Connection();
		$connection->deepQuery($query);
	}

	/**
	 * Subservice utility for ENUM profile fields
	 *
	 * @param Request $request			
	 * @param String $field			
	 * @param array $enum			
	 * @param String $wrong_template			
	 * @param String $wrong_subject			
	 * @param String $field			
	 *
	 * @return Response/void
	 */
	private function subserviceEnum (Request $request, $field, $enum, $wrong_subject, $prefix = null, $synonymous = array())
	{
		if ( ! is_null($prefix))
		{
			if (stripos($request->query, $prefix) === 0)
		{
				$request->query = trim(substr($request->query, strlen($prefix)));
			}
		}
		
		$query = strtoupper(trim($request->query));
		
		// if the query is empty, set to null the field
		if (empty($query))
		{
			return new Response();
		}
		else
		{
			// search for $synonymous
			if (isset($synonymous[$query])) $query = $synonymous[$query];
			
			// search query in the list
			if (array_search($query, $enum) !== false)
			{
				// update the field
				$this->update("$field = '$query'", $request->email);
				return new Response();
			} else {
				// wrong query, return a response with selectable list
				$response = new Response();
				$response->setResponseSubject($wrong_subject);
				
				// NOTE: The template name include the field name
				
				// clear underscores
				foreach ($enum as $k => $v)
				{
					$enum[$k] = str_replace('_', ' ', $v);
				}
				
				$response->createFromTemplate('wrong_' . $field . '.tpl', array(
						'list' => $enum
				));
				return $response;
			}
		}
	}

	/**
	 * Subservice utitlity for simple profile fields
	 *
	 * @param Request $request			
	 * @param String $field			
	 * @param String $prefix			
	 */
	private function subserviceSimple (Request $request, $field, $prefix = null)
	{
		if ( ! is_null($prefix))
		{
			if (stripos($request->query, $prefix) === 0)
			{
				$request->query = trim(substr($request->query, strlen($prefix)));
			}
		}
		
		$value = trim($request->query);
		$value = str_replace(array("'","`"), "", $value);

		if ( ! empty($value))
		{
			$this->update("$field = '$value'", $request->email);
		}
		
		return new Response();
	}

	/**
	 * Subservice utility for date profile fields
	 *
	 * @param Request $request			
	 * @param String $field			
	 * @param String $prefix			
	 */
	private function subserviceDate (Request $request, $field, $prefix = null)
	{
		if ( ! is_null($prefix))
		{
			if (stripos($request->query, $prefix) === 0)
			{
				$request->query = trim(substr($request->query, strlen($prefix)));
			}
		}

		$query = trim($request->query);

		// read date in Spanish
		setlocale(LC_ALL, "es_ES");
		
		// try getting the date
		$date = DateTime::createFromFormat("d/m/Y", $query);
		
		// if date could not be calculated, return null
		if (empty($date))
			return new Response();
		else
			$query = "'" . strftime("%Y-%m-%d", $date->getTimestamp()) . "'";
		
		$this->update("$field = $query", $request->email);
		
		return new Response();
	}
}
