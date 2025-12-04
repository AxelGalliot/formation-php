<?php

class PaiementCarte implements Paiement {
    public function __construct(
        private Logger $logger
    ) {}

    public function payer(Commande $commande): bool {
        // Logique de traitement du paiement par carte
        $this->logger->log("Paiement par carte accepté pour " . $commande->getTotalTtc(20) . " €.");
        return true;
    }
}