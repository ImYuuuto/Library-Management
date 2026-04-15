<?php
if (!function_exists('loadEnv')) {
function loadEnv($path)
{
    if (!file_exists($path)) return;

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  
    foreach ($lines as $line) {

        $line = trim($line);
        
        if ($line === '' || strpos($line, '#') === 0) {
            continue;
        }
        if (strpos($line, '#') !== false) {
            $line = trim(explode('#', $line, 2)[0]);
        }

        if (!str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);

        $key = trim($key);
        $value = trim($value);

        $value = trim($value, "\"'");

        $_ENV[$key] = $value;
        putenv("$key=$value");
    }
}
}

$envPath = dirname(__DIR__, 2) . '/.env';
loadEnv($envPath);

?>