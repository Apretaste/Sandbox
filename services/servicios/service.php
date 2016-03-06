<?php

class Servicios extends Service
{
	/**
	 * Function executed when the service is called
	 *
	 * @param Request
	 * @return Response
	 * */
	public function _main($request)
	{
		// get list of services
		$connection = new Connection();
		$result = $connection->deepQuery("SELECT name, description, category FROM service WHERE listed=1");

		$services = array();
		$others = array(); // to keep the categoty "others" at the end

		// create array of arrays
		foreach($result as $res)
		{
			// to keep the categoty "others" at the end
			if($res->category == "otros")
			{
				$others[] = $res;
				continue;
			}

			// group all other categories in a big array
			if( ! isset($services[$res->category])) $services[$res->category] = array();
			array_push($services[$res->category], $res); 
		}

		// sort by category alphabetically and merge to "other"
		ksort($services);
		$services = array_merge($services, array("otros"=>$others));

		// get variables to send to the template
		$responseContent = array(
			"services" => $services,
			"serviceNum" => count($result)
		);

		// create response
		$response = new Response();
		$response->setResponseSubject("Lista de servicios de Apretaste");
		$response->createFromTemplate("basic.tpl", $responseContent);

		// return
		return $response;
	}
}