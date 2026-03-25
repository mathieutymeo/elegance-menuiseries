<?php
// Tracker de visites — appelé via un pixel ou fetch depuis les pages publiques
header('Content-Type: image/gif');
header('Cache-Control: no-store, no-cache');

define('STATS_FILE', __DIR__ . '/../data/stats.json');

// Créer le dossier data si nécessaire
$dataDir = __DIR__ . '/../data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Ignorer les bots
$ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
if (preg_match('/bot|crawl|spider|slurp|Googlebot|Bingbot/i', $ua)) {
    echo base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
    exit;
}

// Charger les stats
$stats = file_exists(STATS_FILE)
    ? json_decode(file_get_contents(STATS_FILE), true)
    : ['daily' => [], 'pages' => [], 'unique' => []];

if (!is_array($stats)) {
    $stats = ['daily' => [], 'pages' => [], 'unique' => []];
}
if (!isset($stats['unique'])) {
    $stats['unique'] = [];
}

$today = date('Y-m-d');
$page = $_GET['p'] ?? 'accueil';
$page = preg_replace('/[^a-z0-9_-]/i', '', $page);

// Hash anonymisé de l'IP (tronqué, non réversible)
$ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$visitorHash = substr(hash('sha256', $ip . $today), 0, 16);

// Incrémenter les visites du jour (pages vues)
if (!isset($stats['daily'][$today])) {
    $stats['daily'][$today] = 0;
}
$stats['daily'][$today]++;

// Visiteurs uniques par jour
if (!isset($stats['unique'][$today])) {
    $stats['unique'][$today] = ['count' => 0, 'hashes' => []];
}
if (!in_array($visitorHash, $stats['unique'][$today]['hashes'], true)) {
    $stats['unique'][$today]['hashes'][] = $visitorHash;
    $stats['unique'][$today]['count']++;
}

// Incrémenter les visites par page
if (!isset($stats['pages'][$page])) {
    $stats['pages'][$page] = 0;
}
$stats['pages'][$page]++;

// Garder seulement les 90 derniers jours
$cutoff = date('Y-m-d', strtotime('-90 days'));
$stats['daily'] = array_filter($stats['daily'], function($key) use ($cutoff) {
    return $key >= $cutoff;
}, ARRAY_FILTER_USE_KEY);
$stats['unique'] = array_filter($stats['unique'], function($key) use ($cutoff) {
    return $key >= $cutoff;
}, ARRAY_FILTER_USE_KEY);

// Sauvegarder
file_put_contents(STATS_FILE, json_encode($stats, JSON_PRETTY_PRINT), LOCK_EX);

// Répondre avec un pixel 1x1 transparent
echo base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
