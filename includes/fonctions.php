<?php
function lireCsv(string $path, string $delimiter = ',', bool $hasHeader = true): array {
    try {
        $fh = fopen($path, 'rb');
        if ($fh === false) {
            throw new Exception("Impossible d'ouvrir le fichier : $path");
        }

        $data = [];
        $headers = [];

        $firstBytes = fread($fh, 3);
        if ($firstBytes !== "\xEF\xBB\xBF") {
            //Pas de BOM -> on remet le cuseur au début
            fseek($fh, 0);
        }

        if ($hasHeader) {
            $headers = fgetcsv($fh, 0, $delimiter) ?: [];
        }

        while (($row = fgetcsv($fh, 0, $delimiter)) !== false) {
            //Ignore lignes vides
            if ($row === [null] || $row === [] || (count($row) === 1 && trim((string)$row[0]) === '')) {
                continue;
            }

            if ($hasHeader && $headers) {
                // Si taille différente, on répare en remplissant/rognant
                $max = max(count($headers), count($row));
                $row = array_pad($row, $max, null);
                $headers = array_pad($headers, $max, 'col_' . $max);
                $assoc = array_combine($headers, $row);
                if ($assoc === false) {
                    // fallback si échec
                    $assoc = [];
                    foreach ($row as $i => $val) {
                        $assoc[$headers[$i] ?? 'col_' . $i] = $val;
                    }
                }
                $data[] = $assoc;
            } else {
                $data[] = $row;
            }
        }

        fclose($fh);
        return $data;
    } catch (Exception $e) {
        gestionnaireException(new LoggedException($e->getMessage(), 0, $e));
        return [];
    }
}
