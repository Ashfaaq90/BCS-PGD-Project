<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Quotation controller
 */

if($action == "index"){
    $data['title'] = "Quotation | GMA Printers";
    $page = new page();
    $page->begin($data);
    $page->view("quotation");
    $page->end();

}
if($action == "submit"){
    //storing artwork file if available
    $file_name = NULL;
    $file_id = uniqid();
    if(isset($_FILES['artwork'])){
        $uploader = new uploader();
        $file_name = $uploader->artwork_upload('artwork', 'media/artwork/',$file_id);             
    }
    $input = new input();
    $quotation = array (
        'fullname' => $input->post('fullname', 'paragraph'),
        'email' => $input->post('email', 'email'),
        'contactNo' => $input->post('jobname', 'paragraph'),
        'jobname' => $input->post('jobname', 'paragraph'),
        'referenceno' => $input->post('referenceno', 'paragraph'),
        'qty' => $input->post('qty', 'paragraph'),
        'col_spec' => $input->post('col_spec', 'paragraph'),
        'finishing' => $input->post('finishing', 'paragraph'),
        'finish_size' => $input->post('finish_size', 'paragraph'),
        'papertype' => $input->post('papertype', 'paragraph'),
        'specifications' => $input->post('specifications', 'paragraph'),
        'filename' => $file_name
      );
    //storing request
    //echo '<pre>' . var_export($quotation, true) . '</pre>';
    load_model("quotation");
    $qt= new quotation_model();
    $qt->add_new($quotation);
    $data['title'] = "Quotation | GMA Printers";
    $page = new page();
    $page->begin($data);
    $page->view("quotation_received");
    $page->end();

}
