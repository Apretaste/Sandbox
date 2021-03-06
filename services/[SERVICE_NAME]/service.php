<?php

// use Goutte\Client; // UNCOMMENT TO USE THE CRAWLER OR DELETE

class [SERVICE_NAME_CAPITALIZED] extends Service
{
	/**
	 * Function executed when the service is called
	 * 
	 * @param Request
	 * @return Response
	 * */
	public function _main(Request $request)
	{
		/* UNCOMMENT TO USE THE CRAWLER OR DELETE
		// create a new client
		$client = new Client();
		$guzzle = $client->getClient();
		$guzzle->setDefaultOption('verify', false);
		$client->setClient($guzzle);

		// create a crawler
		$crawler = $client->request('GET', "https://google.com");

		// search for result
		$result = $crawler->filter('.health-topic-boost-wrapper')->text();
		*/

		// create a json object to send to the template
		$responseContent = array(
			"var_one" => "hello",
			"var_two" => "world",
			"var_three" => 23
		);

		// create the response
		$response = new Response();
		$response->setResponseSubject("[RESPONSE_EMAIL_SUBJECT]");
		$response->createFromTemplate("basic.tpl", $responseContent);
		return $response;
	}
}
