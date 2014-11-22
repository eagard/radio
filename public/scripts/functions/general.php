<?php

function sanitize($data) {
	return mysql_real_escape_string($data);
}

function outputErrors($errors) {
	return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}



?>