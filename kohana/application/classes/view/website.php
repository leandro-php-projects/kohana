<?php defined('SYSPATH') or die('No direct script access.');

class View_Website extends Kostache_Layout
{
	protected $_partials = 
	array(
	    //Página Inicial Index
		//'header'    => 'partials/header', //diretório  templates/partials/header.mustache
    );

	public function __construct()
	{
		  parent::__construct();		

	 	  $bases = Kohana::$config->load('site')->as_array();
		  
		  foreach($bases as $keys=>$values)
		  {
		  	define('SITE_'.strtoupper($keys), $values);
		  }
		  


	}
	
	public function assets()
   	{
		 return Assets::factory()
		  ->set('head.css.bootstrap'	    , SITE_ASSETS_VENDOR.'/bootstrap/dist/css/bootstrap-theme.min.css')
		  ->set('head.css.bootstrap-theme'	, SITE_ASSETS_VENDOR.'/bootstrap/dist/css/bootstrap-theme.min.css')
		  ->set('head.css.default-css'	    , SITE_ASSETS_CSS.'/default.css')
		  
		  ->set('head.css.bootstrap-js'	    , SITE_ASSETS_VENDOR.'/bootstrap/dist/js/bootstrap.min.js')
		  ->set('head.css.default-js'	    , SITE_ASSETS_JS.'/default.js')
	;}
}