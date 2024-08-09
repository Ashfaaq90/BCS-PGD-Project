<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Printstore  - controller file
 */

if($action == 'index'){
    $data['title'] = "Printstore | GMA Printers";
    $page = new page();
    $page->begin($data);
    $page->view('printstore');
    $page->end();
}
if($action == 'service'){
    $input = new input();
    $package = $input->get_data();    
    $data['title'] = "Printstore | GMA Printers";
    $page = new page();
    $page->begin($data);
    $page->view('printstore/begin');
    $page->view('printstore/'.$package);
    $page->view('printstore/end');
    $page->end();
}



