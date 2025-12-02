<?php

class Carnet {
    public function __construct(
        private array $contacts = []
    ) {
        foreach ($contacts as $contact) {
            if (!$contact instanceof Contact) {
                throw new InvalidArgumentException('Tous les éléments doivent être des instances de Contact.');
            }
        }

        $this->contacts = $contacts;
    }

    public function ajouterContact(Contact $contact): void {
        $this->contacts[] = $contact;
    }

    public function listerContacts(): array {
        return $this->contacts;
    }

    public function rechercherParNom(string $nom): array {
        return array_filter($this->contacts, function (Contact $contact) use ($nom) {
            return stripos($contact->getNom(), $nom) !== false;
        });
    }
}