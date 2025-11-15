<?php

/**
 * Classe représentant le modèle contact
 */
class Contact 
{
    // propriétés privées à la classe
    private int $id;
    private string $name;
    private string $email;
    private string $phone_number;

    /**
     * Constructeur de la classe Contact qui prend des paramètres pour initialiser les propriétés de la nouvelle instance
     */
    public function __construct() { }

    // Getters / setters
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }    

    /**
     * Fonction qui formate les propriétés en une chaine de caractères
     * @return string
     */
    public function __toString(): string {
        return $this->id.", ".$this->name.", ".$this->email.", ".$this->phone_number."\n";
    }    
}
