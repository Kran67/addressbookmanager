<?php
require_once 'ContactManager.php';

class Command
{
    private $manager;

    public function __construct()
    {
        $this->manager = new ContactManager();
    }

    public function list() {
        $contacts = $this->manager->findAll();
        // Si le tableau de contact est vide, on affiche un message et on arrête l'exécution de la méthode
        if (empty($contacts)) {
            echo "Aucun contact\n";
            return;
        }

        echo "Liste des contacts : \n";
        echo "id, nom, email, telephone\n";
        foreach ($contacts as $contact) {
            echo $contact->toString();
        }     
        echo "\n";       
    }
}