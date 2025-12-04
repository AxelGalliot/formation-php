<?php

interface Paiement {
    public function payer(Commande $commande): bool;
}