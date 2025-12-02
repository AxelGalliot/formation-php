<section>
    <h2>Lecture d'un fichier CSV</h2>

    <?php
    $ville = filter_input(INPUT_GET, 'ville', FILTER_UNSAFE_RAW) ?? '';
    $ville = strtolower(trim($ville));
    ?>
    <form method="get">
        Rechercher une ville : 
        <input type="text" name="ville" value="<?= htmlspecialchars($ville, ENT_QUOTES |ENT_SUBSTITUTE, 'UTF-8')?>"/>
        <button type="submit">Filtrer</button>
    </form>

    <?php
    $csvPath = __DIR__ . '/../data/data.csv';
    if (!is_readable($csvPath)) {
        echo "<p>Fichier de données indisponible.</p>";
        return;
    }

    $data = lireCsv($csvPath);
    $array = $data;

    if (!$ville !== '') {
        $array = array_filter($data, function ($row) use ($ville) {
            $val = strtolower((string)($row['ville'] ?? ''));
            return $val !== '' && (function_exists('str_contains')
                ? str_contains($val, $ville)
                : strpos($val, $ville) !== false);
        });
    }

    if (empty($array)) {
        echo "<p>Aucune donnée disponible.</p>";
    } else {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        // En-têtes
        $first = reset($array);
        echo "<thead><tr>";

        foreach (array_keys($first) as $header) {
            echo "<th>" . htmlspecialchars($header, ENT_QUOTES) . "</th>";
        }
        echo "</tr></thead>";

        // Données
        echo "<tbody>";
        foreach ($array as $row) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell, ENT_QUOTES) . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    ?>
</section>