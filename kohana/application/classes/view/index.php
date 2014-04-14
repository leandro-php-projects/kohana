<?php defined('SYSPATH') or die('No direct script access.');

class View_Index extends View_Website
{
	public function assets()
   	{
		return parent::assets()
		//->set('body.js.jwplayer'			, '/assets/vendor/jwplayer/jwplayer.js')
	;}
}  