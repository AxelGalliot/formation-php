<?php

class FileLogger implements Logger {
    private string $filePath;

    public function __construct(string $filePath) {
        $this->filePath = $filePath;
    }

    public function log(string $message): void {
        $date = new DateTime();
        $formattedMessage = "[" . $date->format('Y-m-d H:i:s') . "] " . $message . PHP_EOL;
        file_put_contents($this->filePath, $formattedMessage, FILE_APPEND);
    }
}