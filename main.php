<?php
require_once 'DBConnect.php';
require_once 'ContactManager.php';
while (true) {
    $line = strtolower(readline("Entrez votre commande : "));
    
    switch ($line) {
        case "liste":
            $manager = new ContactManager();
            $contacts = $manager->findAll();
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
            break;
        case "stop":
         exit();
        default:
         echo "Commande non valide : $line\n";
    }
}