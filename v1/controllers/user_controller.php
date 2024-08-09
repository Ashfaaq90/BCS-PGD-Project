<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * User controller
 */

//handling logout request
if($action == "logout"){
    session_destroy();
    redirect('home');
}

//handling register form request
if($action == "register"){
    $data['title'] = "Register | GMA Printers";
    $page = new page();
    $page->begin($data);
    $page->view('register');
    $page->end();  
    die();
}

//handling user profile page request
if($action == "profile"){
    //cheching for user account
    if(!isset($_SESSION['umail']) || empty($_SESSION['umail'])){
        redirect('home');
    }
    //displaying profile page
    load_model("user");
    $user = new user_model();
    $data['udata'] = $user->get_info($_SESSION['umail']);
    
    $data['title'] = "Profile - ".$_SESSION['firstname'];
    $page= new page();
    $page->begin($data);
    $page->view("profile",$data);
    $page->end();
}

//handling new user reg request
if($action == "new"){
    //validating data
    $validation = true;
    $input = new input();
    $new_user['firstname'] = $input->post('firstName', 'paragraph');
    if(!$new_user['firstname']){
        $data['error'] = "First Name ".$input->error."<br>"; 
        $validation = FALSE;
    }
    $new_user['lastname'] = $input->post('lastName', 'paragraph');
    if(!$new_user['lastname']){
        $data['error'] = $data['error']."Last Name ".$input->error."<br>"; 
        $validation = FALSE;
    }
    $new_user['usermail'] = $input->post('email', 'email');
    if(!$new_user['usermail']){
        $data['error'] = $data['error']."e-mail ".$input->error."<br>"; 
        $validation = FALSE;
    }
    
    $new_user['password'] = $input->post('password', 'password');
    if(!$new_user['password']){
        $data['error'] = $data['error']."Password ".$input->error."<br>"; 
        $validation = FALSE;
    }
    $password2 = $input->post('confirmPW', 'password');
    if($new_user['password'] != $password2){
        $data['error'] = $data['error']."Repeat the password correctly.<br>"; 
        $validation = FALSE;
    }   
    if(strlen($new_user['password']) < 5){
        $data['error'] = $data['error']."Password Must be 5 characters or longer.<br>"; 
        $validation = FALSE;
    }
    $new_user['password'] = md5($new_user['password']);
    
    $new_user['uphone'] = $input->post('contactNo', 'string');
    $new_user['address'] = $input->post('address', 'address');
    
    //in case of validation falure
    if(!$validation){
        $data['title'] = "Register | GMA Printers";
        $page = new page();
        $page->begin($data);
        $page->view('register', $data);
        $page->end();  
        die();
    }
    load_model("user");
    $user = new user_model();
    if($user->add_new($new_user)){
        //loading and saving uploaded image
        //getting the relevent user id to use in file name
        $udata = $user->get_info($new_user['usermail']);
        //saving uploaded file under userid file name
        $uploader = new uploader();
        //on succesfull registration
        //removing any previous session data
        //session_destroy();
        //prompting to login for the first time
        echo $user->error;
        $data['error'] = "Please Login for the first time.";
        $page = new page();
        $page->begin($data);
        $page->view('login', $data);
        $page->end();
    }else{
        //in case of error
        $data['title'] = "Register | GMA Printers";
        $data['error'] = $user->error;
        $page = new page();
        $page->begin($data);
        $page->view('register', $data);
        $page->end();  
        die();
    }

}

if($action== "picupdate"){
    //cheching for user account
    if(!isset($_SESSION['umail']) || empty($_SESSION['umail'])){
        redirect('home');
    }
    //search for current image and delete it
    $pic = glob('media/users/'.$_SESSION['userid'].'.*');
    if(@file_exists($pic[0])){
       unlink($pic[0]);
    }   
    //saving uploaded file under userid file name
    $uploader = new uploader();
    $uploader->photo_upload('image', 'media/users/',$_SESSION['userid']);
    redirect('user/profile');
}

if($action == "update"){
    //cheching for user account
    if(!isset($_SESSION['umail']) || empty($_SESSION['umail'])){
        redirect('home');
    }
    
    $validation = true;
    $input = new input();
    $new_user['firstname'] = $input->post('firstName', 'paragraph');
    if(!$new_user['firstname']){
        $data['error'] = "First Name ".$input->error."\\n"; 
        $validation = FALSE;
    }
    $new_user['lastname'] = $input->post('lastName', 'paragraph');
    if(!$new_user['lastname']){
        $data['error'] = $data['error']."Last Name ".$input->error."\\n"; 
        $validation = FALSE;
    }
    
    $new_user['uphone'] = $input->post('contactNo', 'string');
    $new_user['address'] = $input->post('address', 'address');
    
    //in case of validation falure
    if(!$validation){
       $_SESSION['error'] = $data['error'];
       redirect('user/profile');            
    }
    load_model("user");
    $user = new user_model();
    if($user->update_info($new_user)){
        redirect('user/profile');
    }else{
        //in case of error
        $_SESSION['error'] = "Could Not Update..";
        redirect('user/profile');
    }
    
    
}

if($action == "delete"){
    //cheching for user account
    if(!isset($_SESSION['umail']) || empty($_SESSION['umail'])){
        redirect('home');
    }
    //deleting db record
    load_model("user");
    $user = new user_model();
    $user->delete($_SESSION['userid']);
    //deleting image files
    $pic = glob('media/users/'.$_SESSION['userid'].'.*');
    if(@file_exists($pic[0])){
       unlink($pic[0]);
    }
    redirect('user/logout');
}

if($action == "chpass"){
    //cheching for user account
    if(!isset($_SESSION['umail']) || empty($_SESSION['umail'])){
        redirect('home');
    }
    //validating passwords
    $validation = TRUE;
    $input = new input();
    $new_pass = $input->post('newpass', 'password');
    if(!$new_pass){
        $data['error'] = $data['error']."Password ".$input->error."\\n"; 
        $validation = FALSE;
    }
    $password2 = $input->post('reppass', 'password');
    if($new_pass != $password2){
        $data['error'] = $data['error']."Repeat the password correctly.\\n"; 
        $validation = FALSE;
    }   
    if(strlen($new_pass) < 5){
        $data['error'] = $data['error']."Password Must be 5 characters or longer.\\n"; 
        $validation = FALSE;
    }
    $new_pass = md5($new_pass);
    
    if(!$validation){
        //on validation fail
        $_SESSION['error'] = $data['error'];
        redirect('user/profile');        
    }else{
        load_model("user");
        $user = new user_model();
        $user->pass_update($_SESSION['userid'],$new_pass);
        //loguot and redirect to log in again
        session_destroy();
        redirect('login');
    }
}