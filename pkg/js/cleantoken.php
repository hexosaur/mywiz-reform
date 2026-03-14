<?php
date_default_timezone_set('Asia/Manila');

echo "----------------------------------------" . PHP_EOL;
echo "MyWiz Remember Token Cleanup" . PHP_EOL;
echo "Started at: " . date("Y-m-d H:i:s") . PHP_EOL;
echo "----------------------------------------" . PHP_EOL;

// ✅ FIXED PATH (from pkg/js -> root -> config/cfg.php)
$cfgPath = __DIR__ . "/../../config/cfg.php";

if (!file_exists($cfgPath)) {
    echo "ERROR: cfg.php not found at: $cfgPath" . PHP_EOL;
    exit(1);
}

require_once $cfgPath;

if (!isset($conn) || !$conn) {
    echo "ERROR: Database connection (\$conn) not initialized." . PHP_EOL;
    exit(2);
}

if ($conn->connect_errno) {
    echo "ERROR: DB connection failed: " . $conn->connect_error . PHP_EOL;
    exit(3);
}

$sql = "DELETE FROM auth_remember_tokens WHERE expires_at < NOW()";

if ($conn->query($sql)) {
    $deleted = $conn->affected_rows;
    echo "SUCCESS: Expired tokens deleted: $deleted" . PHP_EOL;
    echo "Finished at: " . date("Y-m-d H:i:s") . PHP_EOL;
    $conn->close();
    exit(0);
} else {
    echo "ERROR: Query failed: " . $conn->error . PHP_EOL;
    $conn->close();
    exit(4);
}