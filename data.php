<?php
session_start();
session_id();

/*
 if (isset($_SESSION["last_submit"])) {
    if (time()-$_SESSION['last_submit'] < 30)
    die();
else
    $_SESSION['last_submit'] = time();
 }
 */

 //Create connection
  $connection = mysqli_connect('localhost', 'root', '', 'ajax_php');

  if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
  } 

    if( $_SERVER['REQUEST_METHOD'] == 'POST') {

        /*
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $code = $_POST["code"];
    
        $query = "INSERT INTO insertajax (first_name, last_name, code) VALUES ('$first_name', '$last_name', '$code' )";
    
        $query = mysqli_query($connection, $query);
    
        if($query){
            echo json_encode(array("statusCode"=>200));
            }
        else {
            echo json_encode(array("statusCode"=>201));
            }
        */

        if(!empty($_POST['first_name']) || !empty($_POST['last_name']) || !empty($_POST['code']) || !empty($_FILES['file']['name'])){
            $uploadedFile = '';
            if(!empty($_FILES["file"]["type"])){
                $fileName = session_id().'_'.time()."_".$_FILES['file']['name'];
                $fileName = preg_replace("/([^A-Za-z0-9_\-\.]|[\.]{2})/", "", $fileName);
                $tmp_file = $_FILES["file"]["tmp_name"];
                $valid_extensions = array("jpeg", "jpg", "png", "PNG", "JPEG", "JPG");
                $temporary = explode(".", $_FILES["file"]["name"]);
                $file_extension = end($temporary);
                if (file_contains_php($tmp_file)) {
                 echo "ERROR";
                 $errorForm = true;
                }
                if(($_FILES['file']['size'] >= 5120000) || ($_FILES["file"]["size"] == 0)) {
                    $errorForm = true;
                }
                if((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/PNG" || $_FILES["file"]["type"] == "image/JPEG" || $_FILES["file"]["type"] == "image/JPG")) && in_array($file_extension, $valid_extensions)){
                    $sourcePath = $_FILES['file']['tmp_name'];
                    $targetPath = "uploads/".$fileName;
                    if(move_uploaded_file($sourcePath,$targetPath)){
                        $uploadedFile = $fileName;
                    }
                }
            }
            
            $_first_name = htmlspecialchars($_POST['first_name']);
            $_last_name = htmlspecialchars($_POST['last_name']);
            $_code = htmlspecialchars($_POST["code"]);
         
            $first_name =  mysqli_real_escape_string($connection, $_first_name);
            $last_name =  mysqli_real_escape_string($connection, $_last_name);
            $code =  mysqli_real_escape_string($connection, $_code);
            
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            
            
            //insert form data in the database
            $query = "INSERT INTO insertajax (first_name, last_name, code, image, ip) VALUES ('".$first_name."', '".$last_name."', '".$code."', '".$uploadedFile."', '".$ip."')";
    
            $query = mysqli_query($connection, $query);
            
            if ($query) {
                $_SESSION['last_submit'] = time();

            } else {
                echo "ERROR";
            }
        }
    
        mysqli_close($connection);
    }
    
      
