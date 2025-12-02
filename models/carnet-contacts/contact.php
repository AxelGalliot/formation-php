<?php

class Contact {
    public function __construct(
        private string $prenom,
        private string $nom,
        private string $email
    ) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email invalide : $email");
        }
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function __toString(): string {
        return sprintf(
            '%s %s (%s)',
            $this->prenom,
            $this->nom,
            $this->email
        );
    }
}