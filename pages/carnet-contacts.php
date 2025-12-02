<section>
    <h2>Carnet de contacts</h2>

    <?php
    $searchContact = filter_input(INPUT_GET, 'contacts', FILTER_UNSAFE_RAW) ?? '';
    $searchContact = strtolower(trim($searchContact));
    ?>
    <form method="get">
        Rechercher des contacts : 
        <input type="text" name="contacts" value="<?= htmlspecialchars($searchContact, ENT_QUOTES |ENT_SUBSTITUTE, 'UTF-8')?>"/>
        <button type="submit">Filtrer</button>
    </form>

    <?php
    require_once __DIR__ . '/../models/carnet-contacts/contact.php';
    require_once __DIR__ . '/../models/carnet-contacts/carnet.php';

    $carnet = new Carnet();
    $carnet->ajouterContact(new Contact('Alice', 'Dupont', 'alice.dupont@email.fr'));
    $carnet->ajouterContact(new Contact('Bob', 'Martin', 'bob.martin@email.fr'));
    $carnet->ajouterContact(new Contact('Charlie', 'Durand', 'charlie.durand@email.fr'));
    $contacts = [];

    if ($searchContact !== '') {
        $contacts = $carnet->rechercherParNom($searchContact);
    } else {
        $contacts = $carnet->listerContacts();
    }

    if (empty($contacts)) {
        echo "<p>Aucun contact disponible.</p>";
        return;
    }
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    // En-têtes
    echo "<thead><tr>";
    echo "<th>Prénom</th>";
    echo "<th>Nom</th>";
    echo "<th>Email</th>";
    echo "</tr></thead>";

    // Données
    echo "<tbody>";
    foreach ($contacts as $contact) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($contact->getPrenom(), ENT_QUOTES) . "</td>";
        echo "<td>" . htmlspecialchars($contact->getNom(), ENT_QUOTES) . "</td>";
        echo "<td>" . htmlspecialchars($contact->getEmail(), ENT_QUOTES) . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
    ?>
</section>