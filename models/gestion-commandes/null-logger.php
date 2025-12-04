<?php

class NullLogger implements Logger {
    public function log(string $message): void {
        // Ne fait rien
    }
}