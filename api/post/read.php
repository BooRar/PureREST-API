<?
//headers
//
header ('Access-Conrtol-Allow-Origin: *');
header ('Content-Type:application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instantiate DB # Connection

$database = new Database();
$db = $database->connect();


// Instantate the blog post object
$post = new Post($db);

//Query
$result = $post->read();

//Get rowcount
$num = $result->rowCount();

//CHeck if any post exist
if($num > 0 ){
    //Array of the posts

    $post_arr = array();
    $post_array['data']= array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){

        //$row['title']
        // echo '<pre>';
        // print_r($row);
        // echo '</pre>';

        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name

        );
        //Push to "Data"


        array_push($post_arr,$post_item);
    }
    //Turn To JSON
    echo json_encode($post_arr,JSON_PRETTY_PRINT);
}else{
    echo json_encode(
        array('message' => 'No Posts Found')
    );

}



?>
