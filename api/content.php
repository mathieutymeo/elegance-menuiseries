<?php
require_once __DIR__ . '/config.php';

header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];

// GET : lecture publique du contenu
if ($method === 'GET') {
    if (!file_exists(CONTENT_FILE)) {
        http_response_code(404);
        echo json_encode(['error' => 'Fichier de contenu introuvable']);
        exit;
    }
    readfile(CONTENT_FILE);
    exit;
}

// POST : mise à jour (requiert authentification)
if ($method === 'POST') {
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    require_once __DIR__ . '/auth.php';
    requireAuth();
    verifyCSRF();

    $input = json_decode(file_get_contents('php://input'), true);

    if ($input === null) {
        http_response_code(400);
        echo json_encode(['error' => 'JSON invalide']);
        exit;
    }

    // Lire le contenu actuel
    $current = json_decode(file_get_contents(CONTENT_FILE), true);
    if ($current === null) {
        $current = [];
    }

    // Fusionner section par section
    $section = $input['section'] ?? null;
    $data = $input['data'] ?? null;

    // Valider le nom de section (uniquement les sections autorisées)
    $allowedSections = ['meta', 'links', 'hero', 'promesse', 'gamme', 'atouts', 'methode', 'temoignages', 'cta', 'footer', 'page_volets', 'page_garage', 'page_portails', 'page_alu', 'page_pvc'];
    if ($section && $data && in_array($section, $allowedSections, true)) {
        $current[$section] = $data;
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Paramètres "section" et "data" requis']);
        exit;
    }

    // Sauvegarder avec backup
    $backup = CONTENT_FILE . '.bak';
    copy(CONTENT_FILE, $backup);

    $result = file_put_contents(
        CONTENT_FILE,
        json_encode($current, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
        LOCK_EX
    );

    if ($result === false) {
        http_response_code(500);
        echo json_encode(['error' => 'Erreur d\'écriture']);
        exit;
    }

    echo json_encode(['success' => true]);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Méthode non autorisée']);
