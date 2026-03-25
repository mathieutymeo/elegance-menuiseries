<?php
session_start();
require_once __DIR__ . '/config.php';

header('Content-Type: application/json');

define('STATS_FILE', __DIR__ . '/../data/stats.json');

// Vérifier l'authentification admin
if (empty($_SESSION['admin_logged_in'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorisé']);
    exit;
}

function loadStats() {
    if (!file_exists(STATS_FILE)) {
        return ['daily' => [], 'pages' => []];
    }
    return json_decode(file_get_contents(STATS_FILE), true) ?: ['daily' => [], 'pages' => []];
}

echo json_encode(loadStats());
