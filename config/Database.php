<?


class Database{


    //DB params
    private $host = '127.0.0.1';
    private $db_name = 'myblog';
    private $username = 'root';
    private $password = 'jono23';
    private $conn;

    //DB connect

    public function connect()
    {
//         if ( extension_loaded('pdo') ) {
// echo "PDO Loaded";
// }
// print_r(get_loaded_extensions());

        $this->conn = null;
        try{
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name , $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOExeption $e)
        {
            echo 'Connection Error ' . $e->getMessage();
        }
        return $this->conn;
    }

}





?>
