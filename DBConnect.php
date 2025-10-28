<?php
class DBConnect
{
    private static $instance = null; // utiliser pour n'avoir qu'une seule référence à l'intance de la classe => singleton
    private $pdo;

    /**
     * Constructeur de la classe DBConnect
     */
    private function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
    }

    /**
     * Récupération de l'instance de la classe si elle existe sinon on crée une nouvelle instance
     * @return DBConnect
     */
    public static function getInstance(): DBConnect
    {
        // création d'une nouvelle instance s'il n'y en a pas encore
        if (self::$instance == null) self::$instance = new DBConnect();
        // on retour l'instance
        return self::$instance;
    }

    /**
     * Retourne l'objet PDO
     * @return PDO
     */
    public function getPDO(): PDO
    {
        return $this->pdo;
    }    
}