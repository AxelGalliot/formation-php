<section>
    <h2>Gestion des commandes</h2>

    <?php
    require_once __DIR__ . '/../models/gestion-commandes/client.php';
    require_once __DIR__ . '/../models/gestion-commandes/produit.php';
    require_once __DIR__ . '/../models/gestion-commandes/ligne-commande.php';
    require_once __DIR__ . '/../models/gestion-commandes/commande.php';
    require_once __DIR__ . '/../models/gestion-commandes/logger.php';
    require_once __DIR__ . '/../models/gestion-commandes/file-logger.php';
    require_once __DIR__ . '/../models/gestion-commandes/paiement.php';
    require_once __DIR__ . '/../models/gestion-commandes/paiement-carte.php';
    require_once __DIR__ . '/../models/gestion-commandes/commande-service.php';

    // Exemple d'utilisation du FileLogger
    $logger = new FileLogger(__DIR__ . '/../logs/gestion-commandes.log');
    $paiementPaypal = new PaiementCarte($logger);
    $commandeService = new CommandeService(new PaiementCarte($logger), $logger);

    $logger->log("Initialisation de la gestion des commandes.");
    $p1 = new Produit("Produit 1", 19.99);
    $p2 = new Produit("Produit 2", 29.99);
    $p3 = new Produit("Produit 3", 9.99);
    $client = new Client("Martin Dupont", "martin.dupont@mail.fr");
    $commande = new Commande($client, [new LigneDeCommande($p1, 2), new LigneDeCommande($p3, 1)]);
    $commandeService->validerEtPayer($commande);

    // Ici, vous pourriez ajouter des implémentations concrètes de Paiement et les utiliser
    ?>
</section>