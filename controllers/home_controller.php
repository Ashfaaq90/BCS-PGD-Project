<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Home page - controller file
 */

$data['title'] = "Home | Welcome to GMA Printers";
$page = new page();
$page->begin($data);
$page->view('home');
$page->end();



