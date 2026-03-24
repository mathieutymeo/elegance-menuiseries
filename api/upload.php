<?php
session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/auth.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit;
}

requireAuth();

// Vérification CSRF via header
$token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
    http_response_code(403);
    echo json_encode(['error' => 'Token CSRF invalide']);
    exit;
}

if (!isset($_FILES['image'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Aucun fichier envoyé']);
    exit;
}

$file = $_FILES['image'];

// Vérification des erreurs d'upload
if ($file['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['error' => 'Erreur d\'upload : ' . $file['error']]);
    exit;
}

// Vérification de la taille
if ($file['size'] > MAX_UPLOAD_SIZE) {
    http_response_code(400);
    echo json_encode(['error' => 'Fichier trop volumineux (max 5 Mo)']);
    exit;
}

// Vérification du type MIME
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($file['tmp_name']);

if (!in_array($mime, ALLOWED_MIME_TYPES)) {
    http_response_code(400);
    echo json_encode(['error' => 'Type de fichier non autorisé. Formats acceptés : JPG, PNG, WEBP, SVG']);
    exit;
}

// Créer le dossier uploads si nécessaire
if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}

// Générer un nom de fichier unique
$ext = match($mime) {
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/webp' => 'webp',
    'image/svg+xml' => 'svg',
    default => 'jpg'
};

$filename = date('Y-m-d_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
$destination = UPLOAD_DIR . $filename;

if (!move_uploaded_file($file['tmp_name'], $destination)) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de l\'enregistrement du fichier']);
    exit;
}

echo json_encode([
    'success' => true,
    'path' => 'uploads/' . $filename,
    'filename' => $filename
]);
