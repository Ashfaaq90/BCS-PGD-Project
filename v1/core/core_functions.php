<?php

/* 
 * Developed by Ashfaaq Mahroof
 * GMA Printers
 * Core functions and objects
 */

//page class to load and display all view files
class page{
    public $baseURL;
    public $currency;
    public function __construct() {
        global $baseURL;
        global $currency;
        global $courier_charges;
        $this->baseURL =$baseURL;
        $this->currency =$currency;
        $this->courier_charges =$courier_charges;
    }
    function begin($data) {
        /*required data array
         * title
         */
        include 'views/header.php';
    }
    function end() {
        include 'views/footer.php';
    }
    function view($view_name, $data = null){
        include 'views/'.$view_name.'_view.php';
    }
    
}

class input{
    //var to store the input error
    public  $error;
    //function to process and load submited data
    public function post($name, $type) {
        if(isset($_POST[$name])){
            $input = $_POST[$name];
        }else{
            $this->error = "Not Found";
            return null;
        }       
        switch ($type) {
            case "string": 
                $input = preg_replace("/[^A-Za-z0-9]+/", "", $input);
                break;
            case "price": 
                $input = preg_replace("/[^0-9.]+/", "", $input);
                break;
            case "paragraph":
                $input = preg_replace("/[^A-Za-z0-9 ]+/", "", $input);
                break;
            case "number":
                $input = preg_replace("/[^0-9.]+/", "", $input);
                break;
            case "address":
                $input = preg_replace("/[?<>\":;'`~!&$*]+/", "", $input);
                break;
            case "password":
                $input = preg_replace("/[ ]+/", "", $input);
                break;
            case "email":
                if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                    $this->error = "Invalid";
                    $input = null;
                }
                break;
            case "service-qty":
                list($option,$qty,$price) = explode("-", $input);
                $input = preg_replace("/[^0-9.*#]+/", "", $qty);
                break;
            case "service-price":
                list($option,$qty,$price) = explode("-", $input);
                $input = preg_replace("/[^0-9.]+/", "", $price);
                break;
            case "service-option":
                list($option,$qty,$price) = explode("-", $input);
                $input = preg_replace("/[^A-Za-z0-9 ]+/", "", $option);
                break;
            default:
                $input = null;
        }
        
        if(empty($input)){
            $this->error = "Not Found";
            return null;
        }else{
            return $input;
        }
        
    }
    
    public function get_data() {
        if(isset($_GET['data'])){
            $input = $_GET['data'];
        }else{
            $this->error = "Not Found";
            return null;
        }
        $input = preg_replace("/[^A-Za-z0-9 ]+/", "", $input);
        return $input;
        
    }
    
}

class dbModel{
    public $con;
    public $error;
    public function __construct() {
        //initiating database connection
        $db = new dbConfig();
        $this->con=mysqli_connect($db->dbaddress,$db->dbUser,$db->dbpass,$db->dbName);
        if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        return;
        }
    }
}

class uploader{
    public $error;
    
    public function photo_upload($fname,$target_dir,$save_as=null,$size=500000) {
        $original_fname = basename($_FILES[$fname]["name"]);
        $imageFileType = strtolower(pathinfo($original_fname,PATHINFO_EXTENSION));
        //if file name is given use that name
        if($save_as == NULL){
            $target_file = $target_dir . basename($_FILES[$fname]["name"]);
        }else{
            $target_file = $target_dir.$save_as.".".$imageFileType;
        }        
        $uploadOk = 1;
        
        // Check image 
        if(isset($_POST["save"])) {
            $check = getimagesize($_FILES[$fname]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $this->error = "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            //unlink($target_file);
            $this->error = "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES[$fname]["size"] > $size) {
            $this->error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $this->error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $this->error = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$fname]["tmp_name"], $target_file)) {
                //echo "The file ". basename( $_FILES[$fname]["name"]). " has been uploaded.";
            } else {
                $this->error = "Sorry, there was an error uploading your file.";
            }
        }
    }
    
    
    public function artwork_upload($fname,$target_dir,$save_as=null,$size=500000) {
        $original_fname = basename($_FILES[$fname]["name"]);
        $imageFileType = strtolower(pathinfo($original_fname,PATHINFO_EXTENSION));
        //if file name is given use that name
        if($save_as == NULL){
            $target_file = $target_dir . basename($_FILES[$fname]["name"]);
        }else{
            $target_file = $target_dir.$save_as.".".$imageFileType;
        }        
        $uploadOk = 1;
        
        // Check if file already exists
        if (file_exists($target_file)) {
            //unlink($target_file);
            $this->error = "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES[$fname]["size"] > $size) {
            $this->error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $this->error = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$fname]["tmp_name"], $target_file)) {
                //echo "The file ". basename( $_FILES[$fname]["name"]). " has been uploaded.";
                return $save_as.".".$imageFileType;
            } else {
                $this->error = "Sorry, there was an error uploading your file.";
            }
        }
    }
    
}

function load_model($model_name){
    include 'model/'.$model_name.'_model.php';
}

function redirect($page,$action=null){
    global  $baseURL;
    header("Location: ".$baseURL.$page."/".$action);
    die();
}

