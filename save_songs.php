<?php
// save_songs.php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Lokasi file songs.json
$file = 'songs.json';

// Dapatkan data yang dikirim
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data === null) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON data']);
    exit;
}

// Validasi data
if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['error' => 'Data must be an array']);
    exit;
}

// Simpan ke file
if (file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save data']);
}
?>
