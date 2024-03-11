<?php
class Manager 
{
    private static $pdo = null;
    private string $username;
    private string $password;
    private string $dsn;
    private array $options;

    /**
     * Constructeur de la classe Manager
     */
    public function __construct() {
        $this->username = $_ENV["username"];
        $this->password = $_ENV["password"];
        $this->dsn = $_ENV["dsn"];
        $this->options = $_ENV["options"];
    }

    /**
     * Connexion à la base de données, retourne l'objet PDO
     *
     * @return PDO
     */
    protected function dbConnect() : PDO
    {
        try
        {
            $conn = new PDO($this->dsn, $this->username, $this->password, $this->options); 
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } 
        catch (PDOException $e) 
        {
            print "Erreur de connexion PDO ";
            die();
        }
    }
    
    /**
     * Retourne l'objet PDO de connexion à la base de données, le crée si il n'existe pas
     *
     * @return PDO
     */
    protected function getPDO() : PDO
        {
            
            if (!self::$pdo) {
                self::$pdo = $this->dbConnect();
            }
            return self::$pdo;
        }
    }

?>
