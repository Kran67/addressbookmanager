<?php
require_once 'ContactManager.php';

/**
 * Classe permettant de gérer toutes les commandes tapées par l'utilisateur. 
 */
class Command
{
    private ContactManager $manager;

    /**
     * Le constructeur de la classe
     * Initialise le manager de Contact
     */
    public function __construct()
    {
        $this->manager = new ContactManager();
    }

    /**
     * Affiche la liste des Contacts
     * @return void
     */
    public function list(): void {
        $contacts = $this->manager->findAll();
        // Si le tableau de contact est vide, on affiche un message et on arrête l'exécution de la méthode
        if (empty($contacts)) {
            echo "Aucun contact\n";
            return;
        }

        echo "Liste des contacts : \nid, nom, email, telephone\n";
        foreach ($contacts as $contact) {
            echo $contact;
        }     
        echo "\n";       
    }

    /**
     * Affiche le détail d'un contact
     * @param int $id L'identifiant du contact à afficher
     * @return void
     */
    public function detail(int $id): void {
        $contact = $this->manager->findById($id);
        if (!$contact) {
            echo "Contact non trouvé\n";
            return;
        }
        
        echo $contact;
    }

    /**
     * Crée un contact
     * @param string $name Le nom du contact
     * @param string $email L'email du contact
     * @param string $telephone Le téléphone du contact
     * @return void
     */
    public function create(string $name, string $email, string $telephone): void
    {
        $contact = $this->manager->create($name, $email, $telephone);
        echo "Contact créé : ".$contact;
        $this->list();
    }

    /**
     * Supprime un contact
     * @param int $id L'identifiant du contact à supprimer
     * @return void
     */
    public function delete(int $id): void
    {
        $this->manager->delete($id);
        echo "Contact n° ".$id." supprimé\n";
        $this->list();
    }

    /**
     * Affiche l'aide
     * @return void
     */
    public function help(): void {
        echo "help : affiche cette aide\n";
        echo "list : liste les contacts\n";
        echo "detail [id] : affiche les informations d'un contact\n";
        echo "create [nom], [email], [téléphone] : crée un contact\n";
        echo "delete [id] : supprime un contact\n";
        echo "clear : efface le contenu de la fenêtre\n";
        echo "stop : arrête le programme\n";
        echo "\n";
        echo "Attention à la syntaxe des commandes, les espaces, virgules et majuscules sont importantes.\n";
    }

    /**
     * Efface le contenu de la fenêtre
     * @return void
     */
    public function clear(): void
    {
        popen('cls', 'w');
        $this->showHeader();
        $this->help();
    }

    /**
     * Affiche l'entête du programme
     * @return void
     */
    private function showHeader(): void
    {
        echo "   _____       .___  .___                              __________               __     \n";
        echo "  /  _  \    __| _/__| _/______   ____   ______ ______ \______   \ ____   ____ |  | __ \n";
        echo " /  /_\  \  / __ |/ __ |\_  __ \_/ __ \ /  ___//  ___/  |    |  _//  _ \ /  _ \|  |/ / \n";
        echo "/    |    \/ /_/ / /_/ | |  | \/\  ___/ \___ \ \___ \   |    |   (  <_> |  <_> )    <  \n";
        echo "\____|__  /\____ \____ | |__|    \___  >____  >____  >  |______  /\____/ \____/|__|_ \ \n";
        echo "        \/      \/    \/             \/     \/     \/          \/                   \/ \n";
        echo "   _____                                                                               \n";
        echo "  /     \ _____    ____ _____     ____   ___________                                   \n";
        echo " /  \ /  \\\\__  \  /    \\\\__  \   / ___\_/ __ \_  __ \                                  \n";
        echo "/    Y    \/ __ \|   |  \/ __ \_/ /_/  >  ___/|  | \/                                  \n";
        echo "\____|__  (____  /___|  (____  /\___  / \___  >__|                                     \n";
        echo "        \/     \/     \/     \//_____/      \/                                         \n";
        echo "\n";
        echo "\n";
    }

}