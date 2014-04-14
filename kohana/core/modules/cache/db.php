<?php
/* 
 * Portifas JSON Gateway 
 * Copyright (c) 2008 OPositivo
 */

if (!mysql_connect("localhost", "root", "")) {
	$output = array();
	$output['status'] = 0;
	$output['statuscode'] = 500;
	$output['message'] = 'Under maintenance.';
	echo json_encode($output);
	exit;
}
if (!mysql_select_db("facedelivery")) {
	$output = array();
	$output['status'] = 0;
	$output['statuscode'] = 500;
	$output['message'] = 'Under maintenance.';
	echo json_encode($output);
	exit;
}

function db_escape($text) {
	return mysql_real_escape_string($text);
}

function db_query($_query = '', $args = array(), $debug = true) {
	global $_db_query_count, $_db_query_time;

	$_db_query_count++;
	$_args = array();
	if (is_array($args) && $args) {
		$_args = array_map('db_escape', $args);
		$query = call_user_func_array('sprintf', array_merge(array($_query), $_args));
	} else {
		$query = $prepared = $_query;
	}	
	$timer_start = gettimeofday(true);
	$q = mysql_query($query);
	$timer_duration = (gettimeofday(true) - $timer_start);
	$_db_query_time += $timer_duration;
	if ($debug) {
		$log = array('duration' => sprintf('%01.3f', $timer_duration));
		if ($nr = db_num_rows($q)) {
			$log['rows'] = $nr;
		}
		if ($er = db_error()) {
			$log['error'] = $er;
			$log['backtrace'] = debug_backtrace();
		}
		//debug_log("executed query #{$_db_query_count}: {$query}", $log);
	}
	return $q;
}

function db_num_rows($query) {
	return @mysql_num_rows($query);
}

function db_affected_rows($query) {
	return @mysql_affected_rows($query);
}

function db_success() {
	return (mysql_errno() == 0);
}

function db_error() {
	return mysql_error();
}

function db_errno() {
	return mysql_error();
}

function db_fetch_array($query) {
	return mysql_fetch_assoc($query);
}

function db_save($table, $data) {
	if (!$table || !$data) {
		return false;
	}
	$fields = array();
	$updatefields = array();
	$values = array();
	foreach ($data as $fieldname => $value) {
		$value = db_escape($value);
		$values[] = "'{$value}'";
		$fields[$fieldname] = "`{$fieldname}`";	
		$updatefields[] = "`{$fieldname}` = '{$value}'";
	}
	$fields = implode(',', $fields);
	$updatefields = implode(',', $updatefields);
	$values = implode(',', $values);
	$query = db_query("INSERT INTO `{$table}` (" . $fields .') VALUES (' . $values . ') ON DUPLICATE KEY UPDATE ' . $updatefields);
	if(db_success()) return mysql_insert_id();
}

?>