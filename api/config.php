<?php
// Configuration de l'administration
// Pour générer un nouveau hash : php -r "echo password_hash('votre_mot_de_passe', PASSWORD_DEFAULT);"

define('ADMIN_PASSWORD_HASH', '$2y$10$CHANGE_ME_GENERATE_A_REAL_HASH');
define('CONTENT_FILE', __DIR__ . '/../content.json');
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5 Mo
define('ALLOWED_MIME_TYPES', ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']);
