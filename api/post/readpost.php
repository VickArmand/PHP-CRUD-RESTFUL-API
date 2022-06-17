<?php
// Headers
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';
// Instantiate DB and connect
$database=new Database();
$db=$database->connect();

// Instantiate blog post object
$post=new Post($db);
// Get id
$post->id=isset($_GET['id'])? $_GET['id']: die();

// Blog post query
$result=$post->view_single();
if(($result->rowCount())==1){



        $post_item=array(
            'id'=>$post->id,
            'title'=>$post->title,
            'body'=>html_entity_decode($post->body),
            'author'=>$post->author,
            'category_id'=>$post->category_id,
            'category_name'=>$post->category_name
        );
// Convert to JSON
print_r(json_encode($posts_item));
    }
    else{
        echo "Post Not Found";
    }

?>