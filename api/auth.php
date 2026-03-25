<?php
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', '1');
    ini_set('session.cookie_secure', '1');
    ini_set('session.cookie_samesite', 'Strict');
    session_start();
}
require_once __DIR__ . '/config.php';

header('Content-Type: application/json; charset=utf-8');

function isAuthenticated(): bool {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireAuth(): void {
    if (!isAuthenticated()) {
        http_response_code(401);
        echo json_encode(['error' => 'Non authentifié']);
        exit;
    }
}

function getCSRFToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCSRF(): void {
    $token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(403);
        echo json_encode(['error' => 'Token CSRF invalide']);
        exit;
    }
}

// Ne traiter les requêtes que si auth.php est appelé directement (pas inclus)
if (basename($_SERVER['SCRIPT_FILENAME']) === 'auth.php') {
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        $action = $input['action'] ?? '';

        if ($action === 'login') {
            // Rate limiting : max 5 tentatives par IP sur 15 min
            $rateLimitFile = __DIR__ . '/../data/login_attempts.json';
            $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
            $now = time();
            $attempts = [];
            if (file_exists($rateLimitFile)) {
                $attempts = json_decode(file_get_contents($rateLimitFile), true) ?: [];
            }
            // Purger les entrées > 15 min
            $attempts = array_filter($attempts, fn($a) => ($now - $a['time']) < 900);
            $ipAttempts = array_filter($attempts, fn($a) => $a['ip'] === $ip);
            if (count($ipAttempts) >= 5) {
                http_response_code(429);
                echo json_encode(['error' => 'Trop de tentatives. Réessayez dans 15 minutes.']);
                exit;
            }

            $password = $input['password'] ?? '';
            if (password_verify($password, ADMIN_PASSWORD_HASH)) {
                session_regenerate_id(true);
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                // Effacer les tentatives de cette IP après succès
                $attempts = array_filter($attempts, fn($a) => $a['ip'] !== $ip);
                file_put_contents($rateLimitFile, json_encode(array_values($attempts)), LOCK_EX);
                echo json_encode([
                    'success' => true,
                    'csrf_token' => $_SESSION['csrf_token']
                ]);
            } else {
                $attempts[] = ['ip' => $ip, 'time' => $now];
                file_put_contents($rateLimitFile, json_encode(array_values($attempts)), LOCK_EX);
                http_response_code(401);
                echo json_encode(['error' => 'Mot de passe incorrect']);
            }
            exit;
        }

        if ($action === 'logout') {
            session_destroy();
            echo json_encode(['success' => true]);
            exit;
        }

        if ($action === 'status') {
            echo json_encode([
                'authenticated' => isAuthenticated(),
                'csrf_token' => isAuthenticated() ? getCSRFToken() : null
            ]);
            exit;
        }
    }

    http_response_code(400);
    echo json_encode(['error' => 'Requête invalide']);
}
