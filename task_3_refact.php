<?php 

class db { 
    private static $db;
    private static $instance = null;
    /**
     * The Singleton's constructor should always be private to prevent direct
     * construction calls with the `new` operator.
     */
    protected function __construct() 
     {
        echo "<h1>Connecting with database</h1>";
        $this->db  = new mysqli('localhost', 'root', 'root', '', 3306);
        
        if ($this->db->connect_error) {
            throw new Exception("Connection error: " . $this->db->connect_error);
        }

        $this->db->query("SET NAMES 'UTF8'");

    }

    protected function __clone() { } //Заборона клонувати об'єкт 

    public static function getDatabase(): db
    {
        $cls = static::class;
        if (!isset(self::$db[$cls])) {
            self::$db[$cls] = new static();
        }

        return self::$db[$cls];
    }

    public static function getInstance(): db {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get_data() { 
        $obj1 =db::getDatabase();
        $query = "SELECT * from menu"; 
        $result = $this->db->query($query);
         for($i = 0; $i < $result->num_rows; $i++) { 
        
        $row[] = $result->fetch_assoc(); 
        
        } 
}

}

// Використання Singleton
$db1 = db::getInstance(); // Отримуємо єдиний екземпляр класу
$data = $db1->get_data();  

print_r($data); // Виведення результатів

// Якщо спробуємо створити ще один об'єкт, отримаємо той самий екземпляр
$db2 = db::getInstance();
echo $db1 === $db2 ? "Same instance" : "Different instances"; // Порівняння об'єктів

?>