<?php

class User{

    private $conn;

    public $user_id;
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }


    public function logInUser($email,$password){
        $sql = "SELECT user_id,password FROM users WHERE email = ?";
        $run = $this->conn->prepare($sql);
        $run->bind_param("s",$email);
        $run->execute();

        $result = $run->get_result();
        if($result->num_rows==1){
            $result = $result->fetch_assoc(); 
            if($result['password']===$password){
                return $result['user_id'];
            }else{
                return false;
            }
            
        }else{
        return false;
        }

    }
    public function registerUser($name,$surname,$email,$password){
        $sql = "INSERT INTO users (name, surname, email, password) VALUES (?,?,?,?)";
        $run = $this->conn->prepare($sql);
        $run->bind_param("ssss",$name,$surname,$email,$password);
        $run->execute();

        $result = $run->get_result();

        return true;
    }


}
?>