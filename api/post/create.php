<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  header('X-Requested-With: XMLHttpRequest');
  header('Accept: application/json');
header('authorization: tn34');




  $header = apache_request_headers();


  foreach ($header as $headers => $value) {
      echo " $headers: $value <br>\n";

  }

   echo "





";

 foreach($_SERVER as $name => $value){
         echo " ** $name ======> $value  \r\n";
 }

 if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'XMLHttpRequest') {
    header("Location: http://". $_SERVER['HTTP_HOST']."/");
  //
  echo '-
  --
  ---
  ----
  -----
  ------
  -------
  --------
  corse crap is outa there' ;

  printf(strtolower($_SERVER['REQUEST_SCHEME']));
}

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $post = new Post($db);
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  $post->title = $data->title;
  $post->body = $data->body;
  $post->author = $data->author;
  $post->category_id = $data->category_id;
  // Create post
  if($post->create()) {
    echo json_encode(
      array('message' => 'Post Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }
