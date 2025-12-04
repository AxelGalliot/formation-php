<?php

class LigneDeCommande {
    public function __construct(
        private Produit $produit,
        private int $quantite
    )
    {
        if ($quantite <= 0) {
            throw new InvalidArgumentException("La quantité doit être un entier positif.");
        }
    }

    public function getProduit(): Produit {
        return $this->produit;
    }

    public function getQuantite(): int {
        return $this->quantite;
    }

    public function getTotalHt(): float {
        return $this->produit->getPrixHt() * $this->quantite;
    }

    public function getTotalTtc(float $tauxTva): float {
        return $this->produit->getPrixTtc($tauxTva) * $this->quantite;
    }
}