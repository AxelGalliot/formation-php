<?php
function lireCsv(string $path): array {
    try {
        $file = fopen($path, 'r');
        if ($file === false) {
            throw new Exception("Impossible d'ouvrir le fichier : $path");
        }

        $data = [];
        $headers = fgetcsv($file);
        if ($headers === false) {
            throw new Exception("Le fichier CSV est vide ou mal formaté : $path");
        }

        while (($row = fgetcsv($file)) !== false) {
            $data[] = array_combine($headers, $row);
        }

        fclose($file);

        return $data;
    } catch (Exception $e) {
        gestionnaireException(new LoggedException($e->getMessage(), 0, $e));
        return [];
    }
}