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
     * @return array
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

    /**
     * Permet de récupérer un contact par son identifiant
     * @param int $id : l'identifiant du contact à récupérer
     * @return Contact|null : le contact correspondant à l'identifiant, ou null si aucun contact n'est trouvé
     */
    public function findById(int $id): ?Contact
    {
        $query = $this->db->prepare("SELECT * FROM contact WHERE id = :id");
        $query->execute(["id" => $id]);
        $result = $query->fetch();
        if (!$result) {
            return null;
        }
        return new Contact($result['id'], $result['name'], $result['email'], $result['phone_number']);
    }

    /**
     * Permet de créer un contact
     * @param string $name : le nom du contact
     * @param string $email : l'email du contact
     * @param string $phone_number : le téléphone du contact
     * @return Contact : le contact qui vient d'être créé
     */
    public function create(string $name, string $email, string $phone_number): Contact
    {
        $query = $this->db->prepare("INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)");
        $query->execute(["name" => $name, "email" => $email, "phone_number" => $phone_number]);
        // Récupération du dernier identifiant inséré. 
        $id = $this->db->lastInsertId();
        // On retourne le contact que l'on vient juste de créer
        return $this->findById($id);
    }

    /**
     * Méthode permettant de supprimer un contact de la base de données
     * @param int $id : l'identifiant du contact à supprimer
     */
    public function delete(int $id): void
    {
        $query = $this->db->prepare("DELETE FROM contact WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
    }    
}
