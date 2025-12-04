<?php

class Commande {

    public function __construct(
        private Client $client,
        private array $lignesDeCommande = []
    ) {
        foreach ($lignesDeCommande as $ligne) {
            if (!($ligne instanceof LigneDeCommande)) {
                throw new InvalidArgumentException("Chaque ligne de commande doit être une instance de LigneDeCommande.");
            }
        }
    }

    public function getClient(): Client {
        return $this->client;
    }

    public function ajouterLigneDeCommande(LigneDeCommande $ligne): void {
        $this->lignesDeCommande[] = $ligne;
    }

    public function getLignesDeCommande(): array {
        return $this->lignesDeCommande;
    }

    public function getTotalHt(): float {
        $total = 0.0;
        foreach ($this->lignesDeCommande as $ligne) {
            $total += $ligne->getTotalHt();
        }
        return $total;
    }

    public function getTotalTtc(float $tauxTva): float {
        $total = 0.0;
        foreach ($this->lignesDeCommande as $ligne) {
            $total += $ligne->getTotalTtc($tauxTva);
        }
        return $total;
    }
}