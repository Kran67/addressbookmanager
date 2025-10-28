<?php
/**
 * Class permettant de faire la connexion à la base de données
 */
class DBConnect
{
    private static $instance = null; // utiliser pour n'avoir qu'une seule référence à l'intance de la classe => singleton
    private $pdo;

    /**
     * Constructeur de la classe DBConnect
     * Privée car elle ne doit pas être instanciée autrement que pas la fonction getInstance pour n'avoir qu'une seule intance de cette classe
     */
    private function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=addressbookmanager;charset=utf8', 'root', 'root');
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