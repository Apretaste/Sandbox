<?php 

class Email
{
	/**
	 * Sends an email using MailGun
	 * @author salvipascual
	 * @param String $to, email address of the receiver
	 * @param String $subject, subject of the email
	 * @param String $body, body of the email in HTML
	 * @param Array $images, paths to the images to embeb
	 * @param Array $attachments, paths to the files to attach 
	 * */
	public function sendEmail($to, $subject, $body, $images=array(), $attachments=array())
	{
		// @NOTE
		// This method is not operative in the SandBox environment
		// Please call the method and it will work once in production
	}

	/**
	 * Checks if an email can be delivered to certain mailbox
	 * 
	 * @author salvipascual
	 * @param String $to, email address of the receiver
	 * @param String $subject, subject of the email
	 * @param String $body, body of the email in HTML
	 * @return String delivability status: ok, hard-bounce, soft-bounce, spam, no-reply, loop, unknown
	 * */
	public function deliveryStatus($to)
	{
		// @NOTE
		// This method is not operative in the SandBox environment
		// Please call the method and it will work once in production
		return 'ok';
	}
}
