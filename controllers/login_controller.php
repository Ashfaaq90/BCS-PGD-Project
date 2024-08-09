<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Home page - controller file
 */

$data['title'] = "Login | GMA Printers";

if($action == "authenticate"){
    //calidating and authenticating login request data
    $input = new input();
    //validating email
    $umail = $input->post('umail', 'email');
    if(!$umail){
        $data['error'] = $input->error." e-mail "; 
        $page = new page();
        $page->begin($data);
        $page->view('login', $data);
        $page->end();
        return;
    }
    //validating password
    $upass = $input->post('upass', 'password');
    if(!$upass){
        $data['error'] = "Please enter the password"; 
        $page = new page();
        $page->begin($data);
        $page->view('login', $data);
        $page->end();
        return;
    }
    //authenticating
    load_model("user");    
    $user = new user_model();
    if(!$user->authenticate($umail, $upass)){
        echo $user->error;
        $data['error'] = $user->error;
        $page = new page();
        $page->begin($data);
        $page->view('login', $data);
        $page->end();
        return;
    }else{
        //loading user info and setting session data
        $udata = $user->get_info($umail);
        $_SESSION['userid'] = $udata['userid'];
        $_SESSION['umail'] = $udata['usermail'];
        $_SESSION['type'] = $udata['type'];
        $_SESSION['firstname'] = $udata['firstname'];
        redirect('home');
        
        
    }   
    
}else{
    $page = new page();
    $page->begin($data);
    $page->view('login');
    $page->end();
}
