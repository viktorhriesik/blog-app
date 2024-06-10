<?php

class Post{

    private $conn;


    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function addPost($heading,$shortDesc,$text,$img,$user_id){
        $sql = "INSERT INTO posts (heading,shortDesc,description,img) VALUES (?,?,?,?,?);";
        $run = $this->conn->prepare($sql);
        $run->bind_param("sssss",$heading,$shortDesc,$text,$img,$user_id);
        $run->execute();

        $result = $run->get_result();
        return true;
    }

    public function getAllPosts(){
        $sql = "SELECT * FROM posts";
        $run = $this->conn->prepare($sql);
        //$run->bind_param("sssss",$heading,$shortDesc,$text,$img,$user_id);
        $run->execute();

        $result = $run->get_result();
        $result = $result->fetch_all(); 
        $json = json_encode($result);
        echo $json; 
    }

}

?>