<?php
/*
READ ME
The escape function will ensure that all data coming from our db tables are in UTF-8 format
Simple terms, just ensuring our outputs always come out in clean and readable format.

*/

function escape($string){
	return htmlentities($string, ENT_QUOTES, 'UTF-8');
}
?>
