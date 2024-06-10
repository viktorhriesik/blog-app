<?php
$user = new User();
if($_SERVER['REQUEST_METHOD']=="POST"){
   
    //login
   if(str_ends_with($_SERVER['REQUEST_URI'],"/login")){
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'];
    $password = $data['password'];

    $isLoged = $user->logInUser($email,$password);

    if($isLoged===false){
        $status = array("status"=>false);
        echo json_encode($status);
    }else{
        $status = array("status"=>$isLoged);
        echo json_encode($status);
    }
    
    
    }




    //register
    if(str_ends_with($_SERVER['REQUEST_URI'],"/register")){
 
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'];
        $name = $data['name'];
        $surname = $data['surname'];
        $password = $data['password'];

        $isRegistered = $user->registerUser($name,$surname,$email,$password);
        
        $status = array("status"=>true);
        echo json_encode($status);


    }
    


}



?>