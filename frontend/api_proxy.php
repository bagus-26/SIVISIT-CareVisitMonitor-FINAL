<?php
/**
 * API Proxy untuk frontend JavaScript
 * Meneruskan request AJAX ke backend Laravel via callAPI()
 */
require_once __DIR__ . '/config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, Accept');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// ─── Proteksi API Proxy Frontend ───
// Parse endpoint terlebih dahulu untuk mengecualikan login & register
$uri = $_SERVER['REQUEST_URI'];
$scriptName = $_SERVER['SCRIPT_NAME'];
$basePath = dirname($scriptName);
if ($basePath === '\\' || $basePath === '/') $basePath = '';
$endpoint = substr($uri, strlen($basePath));
$endpoint = preg_replace('#^/api_proxy\.php#', '', $endpoint);
$cleanPath = parse_url($endpoint, PHP_URL_PATH);

// Jika bukan endpoint login/register atau pencarian monitoring pasien spesifik, pastikan user sudah login
$isPublicPatientRoute = preg_match('#^/pasien/([^/]+)/monitoring#', $cleanPath);

if ($cleanPath !== '/login' && $cleanPath !== '/register' && !$isPublicPatientRoute) {
    if (!isset($_SESSION['api_token']) && !isset($_SESSION['user'])) {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'Unauthorized: Sesi tidak valid atau telah berakhir. Harap login kembali.'
        ]);
        exit;
    }
}

$method = $_SERVER['REQUEST_METHOD'];
$data = null;

// Handle request body untuk POST/PUT
$rawInput = file_get_contents('php://input');
if ($rawInput) {
    $data = json_decode($rawInput, true);
}

// Handle GET query params — extract from endpoint URL
if ($method === 'GET' || $method === 'DELETE') {
    $parsed = parse_url($endpoint);
    $endpoint = $parsed['path'] ?? $endpoint;
    if (!empty($parsed['query'])) {
        parse_str($parsed['query'], $queryData);
        $data = $queryData;
    }
}

$result = callAPI($method, $endpoint, $data);
http_response_code($result['status_code']);
echo json_encode($result['response']);
