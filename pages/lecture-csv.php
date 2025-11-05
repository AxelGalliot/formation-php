<section>
    <h2>Lecture d'un fichier CSV</h2>
    <form method="get">
        Rechercher une ville : <input type="text" name="ville"/>
        <button type="submit">Filtrer</button>
    </form>
    <?php
    $csvPath = __DIR__ . '/../data/data.csv';
    $data = lireCsv($csvPath);
    $array = [];

    if (!empty($_GET['ville'])) {
        $ville = strtolower(trim($_GET['ville']));
        $array = array_filter($data, function ($row) use ($ville) {
            return strpos(strtolower($row['ville']), $ville) !== false;
        });
    } else {
        $array = $data;
    }

    if (empty($array)) {
        echo "<p>Aucune donnée disponible.</p>";
    } else {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        // En-têtes
        echo "<thead>";
        echo "<tr>";
        foreach (array_keys($array[0]) as $header) {
            echo "<th>" . htmlspecialchars($header, ENT_QUOTES) . "</th>";
        }
        echo "</tr>";
        echo "</thead>";

        // Données
        echo "<tbody>";
        foreach ($array as $row) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell, ENT_QUOTES) . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";

        echo "</table>";
    }
    ?>
</section>