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

//SQL COlumns possible search
// idnumber
// buslastname
// businessname
// registrationno
//
if(isset($_GET['catogory']))
{

$post->catogorySearch = ($_GET['catogory'] =='idnumber')?true : false ;
$post->catogorySearch = ($_GET['catogory'] =='lastname')?true : false ;
$post->catogorySearch = ($_GET['catogory'] =='businessname')?true : false ;
$post->catogorySearch = ($_GET['catogory'] =='registrationno')?true : false ;


}
else
{
        die();
}


$post->id = isset($_GET['id']) ? $_GET['id'] : die() ;

//Get $post_arr


$post->read_single();

//create an array

$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'catogory_id' => $post->catogory_id,
    'catogory_name' => $post->catogory_name
);

print_r(json_encode($post_arr));
