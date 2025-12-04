<?php

class Produit {
    public function __construct(
        private string $nom,
        private float $prixHt
    )
    {
        if ($prixHt < 0) {
            throw new InvalidArgumentException("Le prix HT ne peut pas être négatif.");
        }
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPrixHt(): float {
        return $this->prixHt;
    }

    public function getPrixTtc(float $tauxTva): float {
        if ($tauxTva < 0) {
            throw new InvalidArgumentException("Le taux de TVA ne peut pas être négatif.");
        }
        return $this->prixHt * (1 + $tauxTva / 100);
    }
}