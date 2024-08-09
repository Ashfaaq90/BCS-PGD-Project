<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Bookstore controller
 */

//bookstore page
if($action == "index"){
   $data['title'] = "Bookstore | GMA Printers";
   $page = new page();
   $page->begin($data);
   $page->view('bookstore',$data);
   $page->end();  
   die();
}


//book search result for JS AJAX
if($action == 'searchbycode'){
    //get serch turm
    $input = new input();
    $data['s_term'] = $input->post('s_term', 'paragraph');
    //get page number
    $data['pno'] = $input->post('pno', 'number');
    $end = $data['pno']*12;
    $start = $end - 12;
    $limit = 12;
    //loading search result list   
    load_model("book");
    $book = new book_model();
    $data['res']= $book->search($data['s_term'], "book_code", $start, $limit);
    //set JS AJAX search function
    $data['s_function'] = "searchbycode";
    //displaying the result
    $page = new page();
    $page->view('bookstore_result', $data); 
}
//book search result for JS AJAX by book name
if($action == 'searchbyname'){
    //get serch turm
    $input = new input();
    $data['s_term'] = $input->post('s_term', 'paragraph');
    //get page number
    $data['pno'] = $input->post('pno', 'number');
    $end = $data['pno']*12;
    $start = $end - 12;  
    $limit = 12;
    //loading search result list   
    load_model("book");
    $book = new book_model();
    $data['res']= $book->search($data['s_term'], "book_name", $start, $limit);
    //set JS AJAX search function
    $data['s_function'] = "searchbyname";
    //displaying the result
    $page = new page();
    $page->view('bookstore_result', $data); 
}
//book search result for JS AJAX by AUTHOR
if($action == 'searchbyauthor'){
    //get serch turm
    $input = new input();
    $data['s_term'] = $input->post('s_term', 'paragraph');
    //get page number
    $data['pno'] = $input->post('pno', 'number');
    $end = $data['pno']*12;
    $start = $end - 12;    
    $limit = 12;
    //loading search result list   
    load_model("book");
    $book = new book_model();
    $data['res']= $book->search($data['s_term'], "author", $start, $limit);
    //set JS AJAX search function
    $data['s_function'] = "searchbyauthor";
    //displaying the result
    $page = new page();
    $page->view('bookstore_result', $data); 
}
//Book infomation Page (selected by book code as url data segment)
if($action== "book"){
    $link = new input();
    $code = $link->get_data();
    if(!$code){
        redirect('home'); 
    }
    //loading book info from db
    load_model("book");
    $book = new book_model();
    $data['book_info'] = $book->get_info($code);
    if(!$data['book_info']){
        //book info not loaded
        redirect('home');
    }
    //displaying book info    
   $data['title'] = $data['book_info']['book_name']." | GMA Printers";
   $page = new page();
   $page->begin($data);
   $page->view('book',$data);
   $page->end();  
   die();
}