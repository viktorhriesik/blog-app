<?php
$post = new Post();

if($_SERVER['REQUEST_METHOD']=="POST"){
   
    if(str_ends_with($_SERVER['REQUEST_URI'],"/add-post")){


        $data = json_decode(file_get_contents('php://input'), true);

        $heading = $data['heading'];
        $shortDesc = $data['shortDesc'];
        $desc = $data['desc'];
        $img = $data['img'];

        $isAdded = $post->addPost($heading,$shortDesc,$desc,$img);
    }

}


if($_SERVER['REQUEST_METHOD']=="GET"){
   
    if(str_contains($_SERVER['REQUEST_URI'],"/get-all")){
        
        $post->getAllPosts();
    }

    if(str_contains($_SERVER['REQUEST_URI'],"/get-post")){
        //$status = array("status"=>false);
        
        if(isset($_GET['id']))
        {
            $postData = $post->getPostData($_GET['id']);
            //$postData = json_encode($postData);
            echo $postData;
        }
    }
}

?>