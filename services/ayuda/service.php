<?php

class Ayuda extends Service
{
	/**
	 * Function executed when the service is called
	 *
	 * @param Request
	 * @return Response
	 * */
	public function _main(Request $request){
		// display help for an specific service
		if( ! empty($request->query))
		{
			// check if the query passed is a service
			$connection = new Connection();
			$res = $connection->deepQuery("SELECT * FROM service WHERE name = '{$request->query}'");

			if(count($res) > 0)
			{
				$service = $res[0];

				// update the valid email on the usage text
				$utils = new Utils();
				$validEmailAddress = $utils->getValidEmailAddress();
				$usage = str_replace('{APRETASTE_EMAIL}', $validEmailAddress, $service->usage_text);

				// send variables to the template
				$responseContent = array(
					"name" => $service->name,
					"description" => $service->description,
					"category" => $service->category,
					"usage" => nl2br($usage)
				);

				// create response for an specific service
				$response = new Response();
				$response->subject = "Ayuda para el servicio " . ucfirst($service->name);
				$response->createFromTemplate("service.tpl", $responseContent);
				return $response;
			}
		}

		// create response
		$responseContent = array("userEmail" => $request->email);
		$response = new Response();
		$response->subject = "Ayuda de Apretaste";
		$response->createFromTemplate("basic.tpl", $responseContent);
		return $response;
	}
}
