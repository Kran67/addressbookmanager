<?php
require_once 'Command.php';

$commandClass = new Command();

while (true) {
    $line = strtolower(readline("Entrez votre commande : "));
    
    switch ($line) {
        case "list":
            $commandClass->list();
            break;
        case "stop":
         exit();
        default:
         echo "Commande non valide : $line\n";
    }
}