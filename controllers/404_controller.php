<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Home page - controller file
 */

$data['title'] = "404 - Sorry Page not found";

$page = new page();
$page->begin($data);
$page->view('404');
$page->end();