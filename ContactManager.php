<?php
require_once 'DBConnect.php';
require_once 'Contact.php';

/**
 * Classe qui fait la liaison entre la base de données et le modéle Contact
 */
class ContactManager
{
    // Variable privée contenant l'instance de la connexion à la base de données
    private $db;

    /**
     * Constructeur de la classe
     */
    public function __construct()
    {
        // On récupère l'instance de PDO via l'instance de la connexion
        $this->db = DBConnect::getInstance()->getPDO();
    }

    /**
     * Permet de récupérer tous les contacts de la base de données
     */
    public function findAll(): array
    {
        $contacts = [];
        $queryResults = $this->db->query("SELECT id, name, email, phone_number FROM contact");
        // On boucle sur les résultats pour créer un tableau d'instance de Contact
        foreach($queryResults as $result) {
            array_push($contacts, new Contact($result['id'], $result['name'], $result['email'], $result['phone_number']));
        }
        
        return $contacts;
    }    
}
