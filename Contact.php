<?php

/**
 * Classe représentant le modéle contact
 */
class Contact 
{
    // propriétés privées à la classe
    private int $id;
    private string $name;
    private string $email;
    private string $telephone;

    /**
     * Contructeur de la classe Contact qui prend des paramètres pour initiliser les propriétés de la nouvelle instance
     */
    public function __construct(int $id, string $name, string $email, string $telephone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->telephone = $telephone;
    }

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

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }    

    /**
     * Fonction qui formatte les propriétés en une chaine de caractères
     * @return string
     */
    public function __toString(): string {
        return "{$this->id}, {$this->name}, {$this->email}, {$this->telephone}\n";
    }    
}
