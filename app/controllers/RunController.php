<?php

use Phalcon\Mvc\Controller;

class RunController extends Controller
{
	public function indexAction()
	{
		$this->view->setLayout('main');
		$this->view->title = "Test a service";
	}

	public function displayAction()
	{
		// obtain params from get
		$subject = $this->request->get("subject");
		$body = $this->request->get("body");

		// render the result
		$result = $this->renderResponse("html@apretaste.com", $subject, "HTML", $body, array(), "html");

		// send data to the template
		$this->view->result = $result;
	}

	public function apiAction()
	{
		// obtain params from get
		$subject = $this->request->get("subject");
		$body = $this->request->get("body");

		// render the result
		$result = $this->renderResponse("html@apretaste.com", $subject, "HTML", $body, array(), "json");

		// send data to the template
		$this->view->result = $result;
	}

	/**
	 * Respond to a request based on the parameters passed
	 * @author salvipascual
	 * */
	private function renderResponse($email, $subject, $sender="", $body="", $attachments=array(), $format="html")
	{
		// get the name of the service based on the subject line
		$subjectPieces = explode(" ", $subject);
		$serviceName = strtolower($subjectPieces[0]);
		unset($subjectPieces[0]);

		// get path to the service
		$utils = new Utils();
		$servicePath = $utils->getPathToService($serviceName);

		// check the service requested exists in the services folder
		if( ! $servicePath) return "<p>No service \"$serviceName\" was found</p>";

		// include the service code
		include_once "$servicePath/service.php";

		// check if a subservice is been invoked
		$subServiceName = "";
		if(isset($subjectPieces[1])) // some services are requested only with name
		{
			$serviceClassMethods = get_class_methods($serviceName);
			if(@preg_grep("/^_{$subjectPieces[1]}$/i", $serviceClassMethods))
			{
				$subServiceName = strtolower($subjectPieces[1]);
				unset($subjectPieces[1]);
			}
		}

		// get the service query
		$query = implode(" ", $subjectPieces);

		// create a new Request object
		$request = new Request();
		$request->email = $email;
		$request->name = $sender;
		$request->subject = $subject;
		$request->body = $body;
		$request->attachments = $attachments;
		$request->service = $serviceName;
		$request->subservice = trim($subServiceName);
		$request->query = trim($query);

		// get details of the service from the XML file
		$xml = simplexml_load_file("$servicePath/config.xml");
		$serviceCreatorEmail = trim((String)$xml->creatorEmail);
		$serviceDescription = trim((String)$xml->serviceDescription);
		$serviceCategory = trim((String)$xml->serviceCategory);
		$serviceUsageText = trim((String)$xml->serviceUsage);
		$serviceInsertionDate = date("Y/m/d H:m:s");

		// check if the email is valid
		if ( ! filter_var($serviceCreatorEmail, FILTER_VALIDATE_EMAIL)) die("Invalid email $serviceCreatorEmail");

		// check if the category is valid
		$categories = array('negocios','ocio','academico','social','comunicaciones','informativo','adulto','otros');
		if( ! in_array($serviceCategory, $categories)) die("Invalid category $serviceCategory");

		// create a new service Object of the user type
		$userService = new $serviceName();
		$userService->serviceName = $serviceName;
		$userService->serviceDescription = $serviceDescription;
		$userService->creatorEmail = $serviceCreatorEmail;
		$userService->serviceCategory = $serviceCategory;
		$userService->serviceUsage = $serviceUsageText;
		$userService->insertionDate = $serviceInsertionDate;
		$userService->pathToService = $servicePath;
		$userService->utils = $utils;

		// run the service and get a response
		if(empty($subServiceName))
		{
			$response = $userService->_main($request);
		}
		else
		{
			$subserviceFunction = "_$subServiceName";
			$response = $userService->$subserviceFunction($request);
		}

		// a service can return an array of Response or only one.
		// we always treat the response as an array
		$responses = is_array($response) ? $response : array($response);

		// clean the empty fields in the response  
		foreach($responses as $rs)
		{
			$rs->email = empty($rs->email) ? $email : $rs->email;
			$rs->subject = empty($rs->subject) ? "Respuesta del servicio $serviceName" : $rs->subject;
		}

		// create a new render
		$render = new Render();

		// render the template and echo on the screen
		if($format == "html")
		{
			$html = "";
			for ($i=0; $i<count($responses); $i++)
			{
				$html .= "<br/><center><small><b>Subject:</b> " . $responses[$i]->subject . "</small></center><br/>";
				$html .= $render->renderHTML($userService, $responses[$i]);
				if($i < count($responses)-1) $html .= "<br/><hr/><br/>";
			}

			$usage = nl2br(str_replace('{APRETASTE_EMAIL}', $utils->getValidEmailAddress(), $serviceUsageText));
			$html .= "<br/><hr><center><p><b>XML DEBUG</b></p><small>";
			$html .= "<p><b>Owner: </b>$serviceCreatorEmail</p>";
			$html .= "<p><b>Category: </b>$serviceCategory</p>";
			$html .= "<p><b>Description: </b>$serviceDescription</p>";
			$html .= "<p><b>Usage: </b><br/>$usage</p></small></center>";
			
			return $html;
		}

		// echo the json on the screen
		if($format == "json")
		{
			return $render->renderJSON($response);
		}

		// false if no action could be taken
		return false;
	}
}
