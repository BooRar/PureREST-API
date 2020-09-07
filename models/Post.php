<?
class Post{



    private $conn ;
    private $table = 'posts';


    //|Post Properties
    //|P
    //|P
    public $id;
    public $catogory_id;
    public $catogory_name;
    public $title;
    public $name;
    public $author;
    public $created_at;


    //constructor with db
    public function __construct($db)
    {
        $this->conn = $db ;
    }
    public function read()
    {
        $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                               FROM ' . $this->table . ' p
                               LEFT JOIN
                                 categories c ON p.category_id = c.id
                               ORDER BY
                                 p.created_at DESC';

        //Prepair STATEMENT
        $stmt = $this->conn->prepare($query);

        //
        //EExec query
        $stmt->execute();

        return $stmt ;
    }

    Public function read_single()
    {
        $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                               FROM ' . $this->table . ' p
                               LEFT JOIN
                                 categories c ON p.category_id = c.id
                               WHERE
                               p.id = ?
                               LIMIT 0,1';
        //Prepair Statemnt
        $stmt = $this->conn->prepare($query);
        //bind // IDEA:
        //

        $stmt->bindParam(1, $this->id);
//execute the query
        $stmt->execute();

        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        //set the property
        $this->title = $row['title']   ;
        $this->body = $row['body']   ;
        $this->author = $row['author']   ;
        $this->category_name = $row['category_name']   ;
        $this->category_id = $row['category_id']   ;
    }
    public function create()
    {
        // Create query
               $query = 'INSERT INTO ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id';
               // Prepare statement
               $stmt = $this->conn->prepare($query);
               // Clean data
               $this->title = htmlspecialchars(strip_tags($this->title));
               $this->body = htmlspecialchars(strip_tags($this->body));
               $this->author = htmlspecialchars(strip_tags($this->author));
               $this->category_id = htmlspecialchars(strip_tags($this->category_id));
               // Bind data
               $stmt->bindParam(':title', $this->title);
               $stmt->bindParam(':body', $this->body);
               $stmt->bindParam(':author', $this->author);
               $stmt->bindParam(':category_id', $this->category_id);
               // Execute query
               if($stmt->execute()) {
                 return true;
           }
           // Print error if something goes wrong
            echo $query;
           printf("Error: %s.\n", $stmt->error);

           return false;
         }
         public function update()
         {
             // Create query
                    $query = 'UPDATE ' . $this->table . '
                                                    SET title = :title, body = :body, author = :author, category_id = :category_id
                                                    WHERE id = :id';
                    // $query = 'UPDATE ' . $this->table . '
                    //                                SET title = :title, body = :body, author = :author, category_id = :category_id
                    //                                WHERE id = :id';
                    // Prepare statement
                    $stmt = $this->conn->prepare($query);
                    // Clean data
                    $this->title = htmlspecialchars(strip_tags($this->title));
                    $this->body = htmlspecialchars(strip_tags($this->body));
                    $this->author = htmlspecialchars(strip_tags($this->author));
                    $this->category_id = htmlspecialchars(strip_tags($this->category_id));
                    $this->id = htmlspecialchars(strip_tags($this->id));
                    // Bind data
                    $stmt->bindParam(':title', $this->title);
                    $stmt->bindParam(':body', $this->body);
                    $stmt->bindParam(':author', $this->author);
                    $stmt->bindParam(':category_id', $this->category_id);
                    $stmt->bindParam(':id', $this->id);
                    // Execute query
                    if($stmt->execute()) {
                      return true;
                }
                // Print error if something goes wrong
                 echo $query;
                printf("Error: %s.\n", $stmt->error);

                return false;
              }
//delete Post

              public function delete()
              {
                  $query = 'DELETE FROM ' .$this->table.' WHERE id = :id';
                   $stmt = $this->conn->prepare($query);
                      $this->id = htmlspecialchars(strip_tags($this->id));
                      $stmt->bindParam(':id', $this->id);
                      if($stmt->execute()) {
                        return true;
                  }
                  // Print error if something goes wrong
                   echo $query;
                  printf("Error: %s.\n", $stmt->error);

                  return false;
              }

}



?>
