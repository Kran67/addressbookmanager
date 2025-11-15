<?php
require_once 'DBConnect.php';
require_once 'Contact.php';

/**
 * Classe qui fait la liaison entre la base de données et le modèle Contact
 */
class ContactManager
{
    // Variable privée contenant l'instance de la connexion à la base de données
    private PDO $db;

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
        $query = $this->db->prepare("SELECT id, name, email, phone_number FROM contact");

        $query->execute();
        $contacts = $query->fetchAll(PDO::FETCH_CLASS, "Contact");
        
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
        $query->setFetchMode(PDO::FETCH_CLASS, "Contact");
        $result = $query->fetch();
        if (!$result) {
            return null;
        }
        return $result;
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
        $query->execute(["name" => filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS), "email" => filter_var($email, FILTER_VALIDATE_EMAIL), "phone_number" => filter_var($phone_number, FILTER_SANITIZE_FULL_SPECIAL_CHARS)]);
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
