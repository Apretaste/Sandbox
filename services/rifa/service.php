<?php

class Rifa extends Service
{
	/**
	 * Function executed when the service is called
	 * 
	 * @param Request
	 * @return Response
	 * */
	public function _main(Request $request){
		// set Spanish so the date come in Spanish
		setlocale(LC_TIME, "es_ES");

		// get the current raffle
		$raffle = $this->utils->getCurrentRaffle();

		// show message if there is no open raffle
		if( ! $raffle) {
			$response = new Response();
			$response->subject = "No hay ninguna Rifa abierta";
			$response->createFromText("Lo sentimos, no hay ninguna Rifa abierta ahora mismo. Pruebe nuevamente en algunos d&iacute;as.");
			return $response;
		}

		// get number of tickets adquired by the user
		$connection = new Connection();
		$userTickets = $connection->deepQuery("SELECT count(*) as tickets FROM ticket WHERE raffle_id is NULL AND email = '{$request->email}'");
		$userTickets = $userTickets[0]->tickets;

		// create a json object to send to the template
		$responseContent = array(
			"description" => $raffle->item_desc,
			"startDate" => $raffle->start_date,
			"endDate" => $raffle->end_date,
			"tickets" => $raffle->tickets,
			"image" => $raffle->image,
			"userTickets" => $userTickets
		);

		// create the final user Response
		$response = new Response();
		$response->subject = "La Rifa de Apretaste";
		$response->createFromTemplate("basic.tpl", $responseContent, array($raffle->image));
		return $response;
	}


	/**
	 * Function executed when a payment is finalized
	 * Add new tickets to the database when the user pays
	 * 
	 *  @author salvipascual
	 * */
	public function payment(Payment $payment){
		// get the number of times the loop has to iterate
		$numberTickets = null;
		if($payment->code == "1TICKET") $numberTickets = 1;
		if($payment->code == "5TICKETS") $numberTickets = 5;
		if($payment->code == "10TICKETS") $numberTickets = 10;

		// do not give tickets for wrong codes
		if(empty($numberTickets)) return false;

		// create as many tickets as necesary
		$query = "INSERT INTO ticket(email,paid) VALUES ";
		for ($i=0; $i<$numberTickets; $i++)
		{
			$query .= "('{$payment->buyer}','1')";
			$query .= $i < $numberTickets-1 ? "," : ";"; 
		}

		// save the tickets in the database 
		$connection = new Connection();
		$transfer = $connection->deepQuery($query);
	}
}
