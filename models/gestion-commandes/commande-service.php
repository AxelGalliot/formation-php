<?php

class CommandeService {
    public function __construct(
        private Paiement $paiementGateway,
        private Logger $logger
    ) {}

    public function validerEtPayer(Commande $commande): void {
        $this->logger->log("Traitement de la commande pour le client : " . $commande->getClient()->getNom());

        if (empty($commande->getLignesDeCommande())) {
            $this->logger->log("La commande est vide. Aucun paiement effectué.");
            throw new InvalidArgumentException("La commande ne contient aucune ligne de commande.");
        }

        $resultatPaiement = $this->paiementGateway->payer($commande);

        if ($resultatPaiement) {
            $this->logger->log("Paiement réussi pour le client : " . $commande->getClient()->getNom());
        } else {
            $this->logger->log("Échec du paiement pour le client : " . $commande->getClient()->getNom());
        }
    }
}