<?php 

class Render
{
	/**
	 * Render the template and return the HTML content
	 *
	 * @author salvipascual
	 * @param Service $service, service to be rendered
	 * @param Response $response, response object to render
	 * @return String, template in HTML
	 * @throw Exception
	 */
	public function renderHTML($service, $response)
	{
		// get the path
		$di = \Phalcon\DI\FactoryDefault::getDefault();
		$wwwroot = $di->get('path')['root'];
		
		// select the right file to load
		if($response->internal) $userTemplateFile = "$wwwroot/app/templates/{$response->template}";
		else $userTemplateFile = "$wwwroot/services/{$service->serviceName}/templates/{$response->template}";

		// creating and configuring a new Smarty object
		$smarty = new Smarty;
		$smarty->addPluginsDir("$wwwroot/app/plugins/");
		$smarty->setTemplateDir("$wwwroot/app/layouts/");
		$smarty->setCompileDir("$wwwroot/temp/templates_c/");
		$smarty->setCacheDir("$wwwroot/temp/cache/");

		// disabling cache and debugging
		$smarty->force_compile = true;
		$smarty->debugging = false;
		$smarty->caching = false;		
		
		// list the system variables
		$systemVariables = array(
			"APRETASTE_USER_TEMPLATE" => $userTemplateFile,
			"APRETASTE_SERVICE_NAME" => strtoupper($service->serviceName),
			"APRETASTE_SERVICE_RELATED" => $this->getServicesRelatedArray($service->serviceName),
			"APRETASTE_SERVICE_CREATOR" => $service->creatorEmail,
			"APRETASTE_TOP_AD" => "", // @NOTE no ads in the Sandbox
			"APRETASTE_BOTTOM_AD" => "" // @NOTE no ads in the Sandbox
		);

		// merge all variable sets and assign them to Smarty
		$templateVariables = array_merge($systemVariables, $response->content);
		$smarty->assign($templateVariables);
		
		// renderig and removing tabs, double spaces and break lines
		$renderedTemplate = $smarty->fetch("email_default.tpl");
		
		return preg_replace('/\s+/S', " ", $renderedTemplate);
	}

	/**
	 * Read the response and return the JSON content
	 *
	 * @author salvipascual
	 * @param Response $response, response object to render
	 * @throw Exception
	 */
	public function renderJSON($response)
	{
		return json_encode($response->content, JSON_PRETTY_PRINT);
	}

	/**
	 * Get up to five services related and return an array with them
	 * 
	 * @author salvipascual
	 * @param String $serviceName, name of the service
	 * @return Array
	 */
	private function getServicesRelatedArray($serviceName)
	{
		// This method is hardcoded in the SandBox environment
		// Call the method; it will work well once in production
		return array('servicios','articulo','ayuda','mapa','traducir');
	}
}
