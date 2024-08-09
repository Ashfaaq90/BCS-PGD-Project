<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Home page - controller file
 */
//get page name
$data['page_name']= $action;
$data['title'] = ucfirst($data['page_name'])." | GMA Printers";
$page = new page();
$page->begin($data);
$page->view("pages/".$data['page_name']);
$page->end();



