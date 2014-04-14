<?php defined('SYSPATH') or die('No direct script access.'); class Controller_Website extends Controller {
	
	// atributos
	protected $view;
	
	// metodos
	public function before()
    {
    	parent::before();
	   	  
	}
	
   public function after()
   {
		$this->response->body($this->view);
		parent::after();
   }
	
}
