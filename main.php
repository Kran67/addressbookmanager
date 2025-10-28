<?php
while (true) {
    $line = strtolower(readline("Entrez votre commande : "));
    
    switch ($line) {
        case "liste":
            echo "Affichage de la liste\n";
            break;
    }
    
    
    echo "Vous avez saisi : $line\n";
}