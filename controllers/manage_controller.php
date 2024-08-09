<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * System mamagement interface controller
 */

//security check
if($_SESSION['type'] != 'staff'){
    redirect('Home');
    die();
}

//management interfase display request
if($action ==  'index'){
   $data['title'] = "Management | GMA Printers";
   $page = new page();
   $page->begin($data);
   $page->view('manage');
   $page->end();  
   die();
}
//manage book interface display request
if($action == 'books'){
   $data['title'] = "Bookstore Management | GMA Printers";
   $page = new page();
   $page->begin($data);
   $page->view('book_manage');
   $page->end();  
   die();
}
//single book manage page
if($action == 'book'){
    $link = new input();
    $code = $link->get_data();
    if(!$code){
        redirect('manage/books'); 
    }
    //loading book info from db
    load_model("book");
    $book = new book_model();
    $data['book_info'] = $book->get_info($code);
    if(!$data['book_info']){
        //book info not loaded
        redirect('manage/books');
    }
    //displaying book info    
   $data['title'] = $data['book_info']['book_name']." | GMA Printers";
   $page = new page();
   $page->begin($data);
   $page->view('book_info',$data);
   $page->end();  
   die();
    
}
//add new book requst
if($action == 'newbook'){
    //validation
    $validation = true;
    $input = new input();
    $new_book['book_code'] = $input->post('book_code', 'string');
    if(!$new_book['book_code']){
        $data['error'] = "Book Code ".$input->error."\\n"; 
        $validation = FALSE;
    }
    $new_book['book_name'] = $input->post('book_name', 'paragraph');
    if(!$new_book['book_name']){
        $data['error'] = $data['error']."Book Name ".$input->error."\\n"; 
        $validation = FALSE;
    }
    $new_book['author'] = $input->post('author', 'paragraph');    
    $new_book['book_desc'] = $input->post('book_desc', 'paragraph');
    $new_book['price'] = $input->post('price', 'price');
    
    //in case of validation falure
    if(!$validation){
        $_SESSION['error'] = "Could not add the new book. \\n".$data['error'];
        redirect('manage/books'); 
        die();
    }
    load_model("book");
    $book = new book_model();
    if($book->add_new($new_book)){
        //uploading the image
        $uploader = new uploader();
        $uploader->photo_upload('image', 'media/books/',$new_book['book_code']);
        //updating book file name on database
        $book->set_image($new_book['book_code']);
        //redirecting to book management page
        redirect('manage/book/'.$new_book['book_code']);
    }else{
        //in case if error
        $_SESSION['error'] = $book->error;
        redirect('manage/books');
    }
}
//update book request
if($action == 'updatebook'){
    //loading the book code
    $link = new input();
    $code = $link->get_data();
    if(!$code){
        redirect('manage/books'); 
    }
    //validation
    $validation = true;
    $input = new input();
    $book_info['book_code'] = $code;
    if(!$book_info['book_code']){
        $data['error'] = "Book Code ".$input->error."\\n"; 
        $validation = FALSE;
    }
    $book_info['book_name'] = $input->post('book_name', 'paragraph');
    if(!$book_info['book_name']){
        $data['error'] = $data['error']."Book Name ".$input->error."\\n"; 
        $validation = FALSE;
    }
    $book_info['author'] = $input->post('author', 'paragraph');    
    $book_info['book_desc'] = $input->post('book_desc', 'paragraph');
    $book_info['price'] = $input->post('price', 'price');
    
    //in case of validation falure
    if(!$validation){
        $_SESSION['error'] = "Could not updat the book. \\n".$data['error'];
        redirect('manage/book/'.$code); 
        die();
    }
    load_model("book");
    $book = new book_model();
    if($book->update($book_info)){
        //uploading the image if availale 
        if(!empty($_FILES['image']['name'])){
            //search for current image and delete it
            $pic = glob('media/books/'.$book_info['book_code'].'.*');
            if(@file_exists($pic[0])){
                unlink($pic[0]);
            } 
            $uploader = new uploader();
            $uploader->photo_upload('image', 'media/books/',$book_info['book_code']);
            //updating book file name on database
            $book->set_image($book_info['book_code']);
            //redirecting to book management page
               
        }
        redirect('manage/book/'.$code); 
        
    }else{
        //in case if error
        $_SESSION['error'] = $book->error;
        redirect('manage/books');
    }
}

if($action == "delbook"){
    //loading the book code
    $link = new input();
    $code = $link->get_data();
    if(!$code){
        redirect('manage/books'); 
    }
    load_model("book");
    $book = new book_model();
    var_dump($book->delete($code));
    if($book->delete($code)){
        //deleting the image if availale 
        $pic = glob('media/books/'.$code.'.*');
        if(@file_exists($pic[0])){
            unlink($pic[0]);
        } 
        redirect('manage/books');        
    }else{
        //n case if error
        $_SESSION['error'] = $book->error;
        redirect('manage/book/'.$code);
    }
    
}
//search book by code request AJAX
if($action == 'bookbyid'){
    //get serch turm
    $input = new input();
    $data['s_term'] = $input->post('s_term', 'paragraph');
    //get page number
    $data['pno'] = $input->post('pno', 'number');
    $end = $data['pno']*10;
    $start = $end - 10;
    $limit = 10;
    //loading search result list   
    load_model("book");
    $book = new book_model();
    $data['res']= $book->search($data['s_term'], "book_code", $start, $limit);
    //set JS AJAX search function
    $data['s_function'] = "bookbyid";
    //displaying the result
    $page = new page();
    $page->view('manage_book_result', $data); 
    
}
//search book by Name request AJAX
if($action == 'bookbyname'){
    //get serch turm
    $input = new input();
    $data['s_term'] = $input->post('s_term', 'paragraph');
    //get page number
    $data['pno'] = $input->post('pno', 'number');
    $end = $data['pno']*10;
    $start = $end - 10;   
    $limit = 10;
    //loading search result list   
    load_model("book");
    $book = new book_model();
    $data['res']= $book->search($data['s_term'], "book_name", $start, $limit);
    //set JS AJAX search function
    $data['s_function'] = "bookbyname";
    //displaying the result
    $page = new page();
    $page->view('manage_book_result', $data); 
    
}
//search book by Author request AJAX
if($action == 'bookbyauthor'){
    //get serch turm
    $input = new input();
    $data['s_term'] = $input->post('s_term', 'paragraph');
    //get page number
    $data['pno'] = $input->post('pno', 'number');
    $end = $data['pno']*10;
    $start = $end - 10;  
    $limit = 10;
    //loading search result list   
    load_model("book");
    $book = new book_model();
    $data['res']= $book->search($data['s_term'], "author", $start, $limit);
    //set JS AJAX search function
    $data['s_function'] = "bookbyauthor";
    //displaying the result
    $page = new page();
    $page->view('manage_book_result', $data); 
    
}

//order managemetnt page
if($action == "orders"){
   $data['title'] = "Bookstore Management | GMA Printers";
   $page = new page();
   $page->begin($data);
   $page->view('order_manage');
   $page->end();  
   die();

    
}
//search order by id JS AJAX request
if($action == "getordersbyid"){
//get serch turm
    $input = new input();
    $data['s_term'] = $input->post('s_term', 'paragraph');
    //get page number
    $data['pno'] = $input->post('pno', 'number');
    $end = $data['pno']*10;
    $start = $end - 10;
    $limit = 10;
    //loading search result list   
    load_model("order");
    $order = new order_model();
    $data['res']= $order->search($data['s_term'], "order_id", $start, $limit);
    //set JS AJAX search function
    $data['s_function'] = "getordersbyid";
    //displaying the result
    $page = new page();
    $page->view('manage_order_result', $data);     
}
//search orders by state JS AJAX request
if($action == "getorderbystatus"){
//get serch turm
    $input = new input();
    $data['s_term'] = $input->post('s_term', 'paragraph');
    //get page number
    $data['pno'] = $input->post('pno', 'number');
    $end = $data['pno']*10;
    $start = $end - 10;
    $limit = 10;
    //loading search result list   
    load_model("order");
    $order = new order_model();
    $data['res']= $order->search($data['s_term'], "status", $start, $limit);
    //set JS AJAX search function
    $data['s_function'] = "getorderbystatus";
    //displaying the result
    $page = new page();
    $page->view('manage_order_result', $data);     
}
//set order status JS AJAX request
if($action == "setorderstatus"){
//get serch turm
    $input = new input();
    $data['s_term'] = $input->post('s_term', 'paragraph');
    $data['state'] = $input->post('status', 'string');
    $data['pno'] = 1;
    $start = 0;
    $limit = 1;
    load_model("order");
    $order = new order_model();
    //changing the order status
    $order->change_status($data['state'],$data['s_term']);
    //loading search result list   
    $data['res']= $order->search($data['s_term'], "order_id", $start, $limit);
    //set JS AJAX search function
    $data['s_function'] = "getorderbystatus";
    //displaying the result
    $page = new page();
    $page->view('manage_order_result', $data);     
}
//order delete request
if($action == 'deleteorder'){
    $input = new input();
    $order_id = $input->get_data();
    echo $order_id;
    load_model("order");
    $order = new order_model();
    $order->delete($order_id);
    redirect("manage/orders");
    
}
//order managemetnt page
if($action == "quotation"){
   $data['title'] = "Bookstore Management | GMA Printers";
   $page = new page();
   $page->begin($data);
   $page->view('quotation_manage');
   $page->end();  
   die();    
}

//search quotation by id JS AJAX request
if($action == "getquotbyid"){
//get serch turm
    $input = new input();
    $data['s_term'] = $input->post('s_term', 'paragraph');
    //get page number
    $data['pno'] = $input->post('pno', 'number');
    $end = $data['pno']*10;
    $start = $end - 10;
    $limit = 10;
    //loading search result list   
    load_model("quotation");
    $quot = new quotation_model();
    $data['res']= $quot->search($data['s_term'], "qt_id", $start, $limit);
    //set JS AJAX search function
    $data['s_function'] = "getquotbyid";
    //displaying the result
    $page = new page();
    $page->view('manage_quotation_result', $data);     
}
//search quotation state  JS AJAX request
if($action == "getquotbystatus"){
//get serch turm
    $input = new input();
    $data['s_term'] = $input->post('s_term', 'paragraph');
    //get page number
    $data['pno'] = $input->post('pno', 'number');
    $end = $data['pno']*10;
    $start = $end - 10;
    $limit = 10;
    //loading search result list   
    load_model("quotation");
    $quot = new quotation_model();
    $data['res']= $quot->search($data['s_term'], "status", $start, $limit);
    //set JS AJAX search function
    $data['s_function'] = "getquotbystatus";
    //displaying the result
    $page = new page();
    $page->view('manage_quotation_result', $data);     
}
//set quotation status JS AJAX request
if($action == "setquotstatus"){
//get serch turm
    $input = new input();
    $data['s_term'] = $input->post('s_term', 'paragraph');
    $data['state'] = $input->post('status', 'string');
    $data['pno'] = 1;
    $start = 0;
    $limit = 1;
    load_model("quotation");
    $quot = new quotation_model();
    //changing the order status
    $quot->change_status($data['state'],$data['s_term']);
    //loading search result list   
    $data['res']= $quot->search($data['s_term'], "qt_id", $start, $limit);
    //set JS AJAX search function
    $data['s_function'] = "setquotstatus";
    //displaying the result
    $page = new page();
    $page->view('manage_quotation_result', $data);     
}
//delete quotation
if($action == 'deletequot'){
    $input = new input();
    $qt_id = $input->get_data();
    echo $order_id;
    load_model("quotation");
    $quot = new quotation_model();
    $quot ->delete($qt_id);
    redirect("manage/quotation");
    
}