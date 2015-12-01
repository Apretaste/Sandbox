<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
	public function indexAction()
	{
		$this->view->setLayout('main');
		$this->view->title = "Apretaste Sandbox";
	}
}
