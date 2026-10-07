<?php

require_once __DIR__ . '/autoload.php';

header('Content-Type: text/html; charset=utf-8');

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dbHost = $_POST['db_host'] ?? 'localhost';
    $dbPort = (int)($_POST['db_port'] ?? 3306);
    $dbName = $_POST['db_name'] ?? '';
    $dbUser = $_POST['db_user'] ?? '';
    $dbPass = $_POST['db_pass'] ?? '';
    $apiToken = $_POST['api_token'] ?? bin2hex(random_bytes(16));
    $authSecret = $_POST['auth_secret'] ?? bin2hex(random_bytes(32));

    if (empty($dbName) || empty($dbUser)) {
        $error = 'Please provide MySQL Database Name and Username.';
    } else {
        try {
            // Test Connection
            $dsn = "mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8mb4";
            $pdo = new PDO($dsn, $dbUser, $dbPass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            // Run MySQL Migrations
            $sql = file_get_contents(__DIR__ . '/database/migrations/001_create_unified_schema.sql');
            $pdo->exec($sql);

            // Initialize SQLite Database
            $sqliteFile = __DIR__ . '/download_queue.sqlite';
            $sqliteDir = dirname($sqliteFile);
            if (!is_dir($sqliteDir)) {
                @mkdir($sqliteDir, 0755, true);
            }
            $sqlitePdo = new PDO('sqlite:' . $sqliteFile);
            $sqlitePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqliteSql = file_get_contents(__DIR__ . '/database/sqlite/001_create_download_queue_schema.sql');
            $sqlitePdo->exec($sqliteSql);

            // Create .env file for configuration
            $envContent = "APP_ENV=production\n";
            $envContent .= "SITE_URL=" . (isset($_SERVER['HTTP_HOST']) ? 'https://' . $_SERVER['HTTP_HOST'] : 'https://mm.3rah.ir') . "\n";
            $envContent .= "DB_HOST=$dbHost\n";
            $envContent .= "DB_PORT=$dbPort\n";
            $envContent .= "DB_NAME=$dbName\n";
            $envContent .= "DB_USER=$dbUser\n";
            $envContent .= "DB_PASS=$dbPass\n";
            $envContent .= "API_TOKEN=$apiToken\n";
            $envContent .= "AUTH_SECRET=$authSecret\n";
            $envContent .= "SQLITE_DB_FILE=$sqliteFile\n";

            file_put_contents(__DIR__ . '/.env', $envContent);

            $message = 'Installation completed successfully! You can now use the API.';
        } catch (Throwable $e) {
            $error = 'Installation Error: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MusicMan API Web Installer</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; background: #f4f6f8; margin: 0; padding: 40px 20px; color: #333; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        h1 { margin-top: 0; color: #111; font-size: 24px; }
        .form-group { margin-bottom: 16px; }
        label { display: block; font-weight: 600; margin-bottom: 6px; font-size: 14px; }
        input[type="text"], input[type="password"], input[type="number"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { background: #0066cc; color: #fff; border: none; padding: 12px 20px; font-size: 16px; font-weight: 600; border-radius: 4px; cursor: pointer; width: 100%; }
        .btn:hover { background: #0052a3; }
        .alert { padding: 12px 16px; border-radius: 4px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background: #e6f4ea; color: #137333; border: 1px solid #ceead6; }
        .alert-danger { background: #fce8e6; color: #c5221f; border: 1px solid #fad2cf; }
    </style>
</head>
<body>
    <div class="container">
        <h1>MusicMan API Web Installer</h1>

        <?php if (!empty($message)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <h3>MySQL Database Settings</h3>
            <div class="form-group">
                <label>Database Host</label>
                <input type="text" name="db_host" value="localhost" required>
            </div>
            <div class="form-group">
                <label>Database Port</label>
                <input type="number" name="db_port" value="3306" required>
            </div>
            <div class="form-group">
                <label>Database Name</label>
                <input type="text" name="db_name" required placeholder="e.g. musicman_db">
            </div>
            <div class="form-group">
                <label>Database User</label>
                <input type="text" name="db_user" required placeholder="e.g. musicman_user">
            </div>
            <div class="form-group">
                <label>Database Password</label>
                <input type="password" name="db_pass" placeholder="Database Password">
            </div>

            <h3>API Security Tokens</h3>
            <div class="form-group">
                <label>API Master Token</label>
                <input type="text" name="api_token" value="<?= bin2hex(random_bytes(16)) ?>">
            </div>
            <div class="form-group">
                <label>Auth Secret Key</label>
                <input type="text" name="auth_secret" value="<?= bin2hex(random_bytes(32)) ?>">
            </div>

            <button type="submit" class="btn">Install Database & Config</button>
        </form>
    </div>
</body>
</html>
