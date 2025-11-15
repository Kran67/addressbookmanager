<?php
require_once 'Command.php';

$command = new Command();

$command->clear();

while (true) {
    $line = strtolower(readline("Entrez votre commande : "));
    
    if (preg_match("/^detail (.*)$/", $line, $matches)) {
        $command->detail($matches[1]);
    } else if (preg_match("/^create (.*), (.*), (.*)$/", $line, $matches)) {
        $command->create($matches[1], $matches[2], $matches[3]);
    } else if (preg_match("/^delete (.*)$/", $line, $matches)) {
        $command->delete($matches[1]);
    } else {
        switch ($line) {
            case "list":
                $command->list();
                break;
            case "quit":
                exit();
            case "help":
                $command->help();
                break;
            case "clear":
                $command->clear();
                break;
            default:
                echo "Commande non valide : $line\n";
        }
    }
}