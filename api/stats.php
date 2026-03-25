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
        return ['daily' => [], 'pages' => [], 'unique_daily' => []];
    }
    $stats = json_decode(file_get_contents(STATS_FILE), true) ?: ['daily' => [], 'pages' => []];

    // Extraire uniquement les compteurs (pas les hashes) pour l'API
    $uniqueDaily = [];
    if (!empty($stats['unique'])) {
        foreach ($stats['unique'] as $date => $data) {
            $uniqueDaily[$date] = $data['count'] ?? 0;
        }
    }
    $stats['unique_daily'] = $uniqueDaily;
    unset($stats['unique']); // Ne pas exposer les hashes

    return $stats;
}

echo json_encode(loadStats());
