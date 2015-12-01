<?php

class Response
{
	public $email;
	public $subject;
	public $template;
	public $content;
	public $images;
	public $attachments;
	public $internal; // false if the user provides the template
	public $render; // false if the response should not be email to the user
	private $ads; // @NOTE no ads in the Sandbox

	/**
	 * Create default template
	 *
	 * @author salvipascual
	 */
	public function __construct()
	{
		$this->template = "message.tpl";
		$this->content = array("text"=>"<b>Warning:</b> Default responses will never be emailed to the user.");
		$this->images = array();
		$this->attachments = array();

		$this->internal = true;
		$this->render = false;
		$this->ads = array(); // @NOTE no ads in the Sandbox
	}

	/**
	 * Set the subject for the response
	 *
	 * @author salvipascual
	 * @param String $subject
	 * */
	public function setResponseSubject($subject)
	{
		$this->subject = $subject;
	}

	/**
	 * Set the email of the response in the cases where is not the same as the requestor
	 * Useful for confirmations or for programmers to track actions/errors on their services
	 * 
	 * @author salvipascual
	 * @param String $email
	 * */
	public function setResponseEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * Get the array of ads selected to be displayed
	 *
	 * @author salvipascual
	 * @return Object[]
	 * */
	public function getAds()
	{
		return $this->ads;
	}

	/**
	 * Build an HTML template response based on a text passed by the user
	 *
	 * @author salvipascual
	 * @param String, $text
	 */
	public function createFromText($text)
	{
		$this->template = "message.tpl";
		$this->content = array("text"=>$text);
		$this->internal = true;
		$this->render = true;
	}

	/**
	 * Build an HTML template from a set of variables and a template name passed by the user
	 *
	 * @author salvipascual
	 * @param String $template, name of the file in the template folder
	 * @param String[] $content, in the way ["key"=>"var"]
	 * @param String[] $images, paths to the images to embeb
	 * @param String[] $attachments, paths to the files to attach 
	 */
	public function createFromTemplate($template, $content, $images=array(), $attachments=array())
	{
		$this->template = $template;
		$this->content = $content;
		$this->images = $images;
		$this->attachments = $attachments;
		$this->internal = false;
		$this->render = true;
	}
}
