<?php
// ============================================================
// SCRIPT D'INSTALLATION — À supprimer après utilisation
// Accéder à ce fichier via : https://votre-site.com/install.php
// ============================================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if (strlen($password) < 6) {
        $error = 'Le mot de passe doit faire au moins 6 caractères.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $configPath = __DIR__ . '/api/config.php';
        $configContent = file_get_contents($configPath);
        $replacement = "define('ADMIN_PASSWORD_HASH', '" . addcslashes($hash, "'\\") . "');";
        $configContent = preg_replace(
            "/define\('ADMIN_PASSWORD_HASH',\s*'[^']*'\);/",
            str_replace('$', '\$', $replacement),
            $configContent
        );
        file_put_contents($configPath, $configContent);
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation — Élégance Menuiseries</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: system-ui, sans-serif; background: #F3F0EC; display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .card { background: #fff; padding: 48px 40px; border-radius: 8px; box-shadow: 0 2px 20px rgba(0,0,0,0.08); max-width: 450px; width: 100%; }
        h1 { font-size: 22px; margin-bottom: 8px; }
        p { font-size: 14px; color: #666; margin-bottom: 24px; }
        input { width: 100%; padding: 12px 16px; border: 1px solid #ddd; border-radius: 4px; font-size: 15px; margin-bottom: 16px; }
        button { width: 100%; padding: 12px; background: #938D82; color: #fff; border: none; border-radius: 4px; font-size: 15px; font-weight: 600; cursor: pointer; }
        button:hover { background: #7d7870; }
        .error { color: #c0392b; font-size: 13px; margin-bottom: 16px; }
        .success { background: #d4edda; color: #155724; padding: 16px; border-radius: 4px; margin-bottom: 16px; font-size: 14px; }
        .warning { background: #fff3cd; color: #856404; padding: 12px; border-radius: 4px; font-size: 13px; margin-top: 16px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Installation</h1>
        <?php if (isset($success) && $success): ?>
            <div class="success">
                ✅ Mot de passe configuré avec succès !<br>
                Vous pouvez maintenant accéder à <a href="/admin/">l'administration</a>.
            </div>
            <div class="warning">
                ⚠️ <strong>IMPORTANT :</strong> Supprimez ce fichier (install.php) du serveur pour des raisons de sécurité.
            </div>
        <?php else: ?>
            <p>Configurez le mot de passe administrateur pour votre site.</p>
            <?php if (isset($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form method="POST">
                <input type="password" name="password" placeholder="Mot de passe administrateur" required value="CHAT-JAUNE-ROUTE">
                <button type="submit">Configurer</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
