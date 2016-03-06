<?php

class Terminos extends Service
{
	/**
	 * Function executed when the service is called
	 *
	 * @param Request
	 * @return Response
	 * */
	public function _main(Request $request)
	{
		$response = new Response();
		$response->setResponseSubject("Terminos de uso de Apretaste");
		$response->createFromTemplate("basic.tpl", array());
		return $response;
	}
}