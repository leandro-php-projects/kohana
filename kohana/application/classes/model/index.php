<?php 
defined('SYSPATH') or die('No direct script access.');

class Model_Index extends Model
{
    public static function GetTesteIndex()
    {
    	$sql = 'SELECT * FROM events';
        $query = DB::query(Database::SELECT, $sql)->execute()->as_array();
		return $query;
    }
}