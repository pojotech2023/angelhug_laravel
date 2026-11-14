<?php
/**
 * Angelhug - Emergency Administrator Credential Reset Utility
 * 
 * Instructions:
 * 1. Upload this file to your server root (or public_html).
 * 2. Visit https://angelhug.pojcotech.in/reset_admin.php in your browser.
 * 3. Enter your new Admin Email and Password, and click "Update Admin Credentials".
 * 4. IMPORTANT: Delete this file from your server after updating!
 */

// Detect .env file location
$envPaths = [
    __DIR__ . '/.env',
    __DIR__ . '/../.env'
];

$envFile = null;
foreach ($envPaths as $p) {
    if (file_exists($p)) {
        $envFile = $p;
        break;
    }
}

$dbHost = '127.0.0.1';
$dbPort = '3306';
$dbName = '';
$dbUser = '';
$dbPass = '';

if ($envFile) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if (strpos($line, '#') === 0) continue;
        if (strpos($line, 'DB_HOST=') === 0) $dbHost = trim(substr($line, 8), '"\' ');
        if (strpos($line, 'DB_PORT=') === 0) $dbPort = trim(substr($line, 8), '"\' ');
        if (strpos($line, 'DB_DATABASE=') === 0) $dbName = trim(substr($line, 12), '"\' ');
        if (strpos($line, 'DB_USERNAME=') === 0) $dbUser = trim(substr($line, 12), '"\' ');
        if (strpos($line, 'DB_PASSWORD=') === 0) $dbPass = trim(substr($line, 12), '"\' ');
    }
}

$message = '';
$error = '';
$pdo = null;

try {
    $dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    $error = "Database Connection Failed: " . $e->getMessage() . "<br><small>Make sure .env contains correct DB credentials.</small>";
}

// Current Admin Info
$currentAdminEmail = 'admin@gmail.com';
if ($pdo) {
    try {
        $stmt = $pdo->query("SELECT email FROM logins WHERE id = 1 LIMIT 1");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && !empty($row['email'])) {
            $currentAdminEmail = $row['email'];
        }
    } catch (Exception $e) {
        // Logins table might be named differently or empty
    }
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo) {
    $email = trim($_POST['email'] ?? '');
    $password = (string)($_POST['password'] ?? '');

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please provide a valid email address.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
        try {
            // Generate standard Bcrypt hash
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

            // Check if record ID 1 exists
            $stmt = $pdo->query("SELECT id FROM logins WHERE id = 1 LIMIT 1");
            if ($stmt->fetch()) {
                $update = $pdo->prepare("UPDATE logins SET email = ?, password = ? WHERE id = 1");
                $update->execute([$email, $hashedPassword]);
            } else {
                $insert = $pdo->prepare("INSERT INTO logins (id, email, password, created_at, updated_at) VALUES (1, ?, ?, NOW(), NOW())");
                $insert->execute([$email, $hashedPassword]);
            }

            // Also clean any duplicate customer record with the same email having null password
            $pdo->prepare("DELETE FROM logins WHERE email = ? AND (password IS NULL OR password = '') AND id != 1")->execute([$email]);

            $message = "<strong>Success!</strong> Administrator email & password have been updated successfully.<br>" .
                       "• <strong>Email:</strong> " . htmlspecialchars($email) . "<br>" .
                       "• <strong>Password:</strong> " . htmlspecialchars($password) . "<br><br>" .
                       "<a href='/login' class='btn' style='display:inline-block; padding:10px 20px; background:#048444; color:#fff; border-radius:8px; text-decoration:none; font-weight:bold;'>Click Here to Go to Login Page</a>" .
                       "<br><br><span style='color:#dc2626; font-size:13px;'>⚠️ <strong>SECURITY WARNING:</strong> Please delete this <code>reset_admin.php</code> file from your server now!</span>";
            $currentAdminEmail = $email;
        } catch (Exception $e) {
            $error = "Failed to update administrator: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Admin Email & Password - Angelhug</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        body { background: #f8fafc; color: #1e293b; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .card { background: #ffffff; width: 100%; max-width: 480px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); overflow: hidden; border: 1px solid #e2e8f0; }
        .card-header { background: linear-gradient(135deg, #024724 0%, #048444 100%); color: #ffffff; padding: 28px 24px; text-align: center; }
        .card-header h2 { font-size: 20px; font-weight: 700; margin-bottom: 6px; }
        .card-header p { font-size: 13px; opacity: 0.9; }
        .card-body { padding: 28px 24px; }
        .alert { padding: 14px 16px; border-radius: 10px; font-size: 14px; margin-bottom: 20px; line-height: 1.5; }
        .alert-success { background: #e8f7ee; border: 1px solid #a7f3d0; color: #065f46; }
        .alert-error { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 6px; }
        input[type="email"], input[type="text"], input[type="password"] {
            width: 100%; padding: 12px 14px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: 0.2s;
        }
        input:focus { border-color: #048444; box-shadow: 0 0 0 3px rgba(4, 132, 68, 0.15); }
        .btn-submit {
            width: 100%; background: #048444; color: #ffffff; border: none; padding: 13px; border-radius: 8px; font-size: 15px; font-weight: 700; cursor: pointer; transition: 0.2s;
        }
        .btn-submit:hover { background: #036835; }
        .card-footer { background: #f8fafc; border-top: 1px solid #f1f5f9; padding: 14px 24px; font-size: 12px; color: #64748b; text-align: center; }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h2>Angelhug Admin Reset</h2>
        <p>Set a new Administrator Email & Password</p>
    </div>

    <div class="card-body">
        <?php if ($message): ?>
            <div class="alert alert-success"><?= $message ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <?php if (!$message): ?>
        <form method="POST">
            <div class="form-group">
                <label>Administrator Email Address</label>
                <input type="email" name="email" value="<?= htmlspecialchars($currentAdminEmail) ?>" required placeholder="e.g. admin@angelhug.com">
                <small style="color:#64748b; font-size:11.5px; display:block; margin-top:4px;">The email you will use to log in.</small>
            </div>

            <div class="form-group">
                <label>New Administrator Password</label>
                <input type="text" name="password" required placeholder="Enter new password (min. 6 characters)">
                <small style="color:#64748b; font-size:11.5px; display:block; margin-top:4px;">Will be encrypted using Bcrypt.</small>
            </div>

            <button type="submit" class="btn-submit">Update Admin Credentials</button>
        </form>
        <?php endif; ?>
    </div>

    <div class="card-footer">
        Angelhug Healthcare &copy; <?= date('Y') ?> &bull; Emergency Setup Tool
    </div>
</div>

</body>
</html>
