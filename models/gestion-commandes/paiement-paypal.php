<?php

class PaiementPaypal implements Paiement {
public function __construct(
        private Logger $logger
    ) {}

    public function payer(Commande $commande): bool {
        // Logique de paiement via PayPal
        $this->logger->log("Paiement via PayPal accepté pour " . $commande->getTotalTtc(20) . " €.");
        return true; // Supposons que le paiement réussit
    }
}