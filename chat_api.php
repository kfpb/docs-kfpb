<?php

// =========================================================
// PENGATURAN DEBUGGING (HANYA UNTUK DEVELOPMENT)
// AKTIFKAN INI UNTUK MELIHAT ERROR DI BROWSER / LOG
// SETELAH DEBUGGING SELESAI, SET KEMBALI KE error_reporting(0);
// =========================================================
error_reporting(E_ALL); // Laporkan semua error
ini_set('display_errors', 1); // Tampilkan error di browser
ini_set('display_startup_errors', 1); // Tampilkan error saat startup


// =========================================================
// PENANGANAN FATAL ERROR AGAR RESPON SELALU JSON (jika terjadi error fatal)
// Fungsi ini akan dijalankan saat skrip berhenti (normal atau error)
// =========================================================
register_shutdown_function(function() {
    $lastError = error_get_last();
    // Periksa jika ada fatal error (parse error, fatal error, recoverable error)
    if ($lastError && in_array($lastError['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING, E_RECOVERABLE_ERROR])) {
        // Hapus output yang mungkin sudah terkirim (misalnya jika error terjadi setelah echo "some text")
        ob_clean(); 

        // Set header dan kode status HTTP
        header('Content-Type: application/json');
        http_response_code(500);

        // Kirim detail error dalam format JSON
        echo json_encode([
            'error' => 'Internal Server Error (PHP Fatal Error)',
            'details' => $lastError['message'],
            'file' => $lastError['file'],
            'line' => $lastError['line']
        ]);
        // Tulis juga ke log server
        error_log("PHP FATAL ERROR (chat_api.php): " . $lastError['message'] . " in " . $lastError['file'] . " on line " . $lastError['line']);
    }
});

// Mulai output buffering (penting agar ob_clean() bekerja jika terjadi error di tengah skrip)
// Ini harus di awal skrip, sebelum output apapun.
ob_start();

// =========================================================
// 1. PENGATURAN CORS (Cross-Origin Resource Sharing)
//    Penting untuk mengizinkan permintaan dari domain frontend Anda.
// =========================================================

// Untuk DEVELOPMENT (mengizinkan semua origin) - TIDAK DISARANKAN UNTUK PRODUKSI!
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Menambahkan GET ke allowed methods
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Untuk PRODUKSI (ganti dengan domain spesifik aplikasi Anda)
// Contoh:
// header("Access-Control-Allow-Origin: https://docs.kfpb.kimiafarma.co.id");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Allow-Headers: Content-Type");


// Tangani permintaan OPTIONS (preflight request untuk CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit(); // Penting untuk mengakhiri eksekusi setelah preflight
}

// =========================================================
// 2. KONFIGURASI URL N8N WEBHOOK
//    Ganti URL ini dengan 'Chat URL' dari node 'When chat message received' di N8n Anda.
// =========================================================
$n8nWebhookUrl = 'https://n8n.rizkyfajara.engineer/webhook/6dfe30ce-7d04-42f7-b943-cd626d96ff0c/chat';

// =========================================================
// 3. LOGIKA UTAMA: Menerima Pesan, Meneruskan ke N8n, Mengirim Respons
// =========================================================

// Pastikan permintaan yang masuk adalah metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ini adalah blok untuk menangani permintaan POST dari chatbot
    header('Content-Type: application/json');

    $input = file_get_contents('php://input');
    $data = json_decode($input, true); 

    if (!isset($data['message']) || empty($data['message'])) {
        http_response_code(400); 
        echo json_encode(['error' => 'Message field is required in the request body.']);
        error_log("Error (400): 'message' field missing in request body.");
        ob_end_flush(); 
        exit();
    }

    $userMessage = $data['message']; 
    error_log("Pesan dari pengguna (Frontend): " . $userMessage);

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $sessionId = isset($_SESSION['nppcv']) ? $_SESSION['nppcv'] : session_id();

    $payloadToN8n = json_encode([
        'chatInput' => $userMessage, 
        'sessionId' => $sessionId,   
        'action'    => 'sendMessage' 
    ]);

    $ch = curl_init($n8nWebhookUrl);
    if ($ch === false) { 
        error_log("PHP FATAL: curl_init() failed. cURL extension might not be enabled.");
        http_response_code(500);
        echo json_encode(['error' => 'Server error: cURL initialization failed. Is cURL enabled?']);
        ob_end_flush(); 
        exit();
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadToN8n);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payloadToN8n)
    ]);
    // curl_setopt($ch, CURLOPT_VERBOSE, true); // Aktifkan untuk log verbose di log PHP

    $n8nResponse = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        error_log("Error cURL saat menghubungi N8n: " . $curlError);
        http_response_code(500);
        echo json_encode(['error' => 'Terjadi kesalahan saat menghubungi layanan chatbot: ' . $curlError]);
        ob_end_flush(); 
        exit();
    }

    if ($httpCode !== 200) {
        error_log("N8n mengembalikan status error: " . $httpCode . " - Respons: " . $n8nResponse);
        http_response_code(500);
        $errorDetails = json_decode($n8nResponse, true); 
        echo json_encode(['error' => 'Chatbot mengembalikan error: ' . ($errorDetails['message'] ?? $n8nResponse)]);
        ob_end_flush(); 
        exit();
    }

    $botResponse = $n8nResponse; 
    error_log("Respons dari Chatbot N8n: " . $botResponse);

    http_response_code(200);
    echo json_encode(['reply' => $botResponse]); 
    ob_end_flush(); 

} else { // Ini adalah blok untuk menangani permintaan SELAIN POST (termasuk GET)
    // =========================================================
    // BLOK DIAGNOSTIK UNTUK PERMINTAAN GET LANGSUNG
    // =========================================================
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        header('Content-Type: text/html'); // Mengatur header agar browser menampilkan HTML
        http_response_code(200); // Mengembalikan kode 200 OK untuk halaman diagnostik

        echo "<html><head><title>chat_api.php - Diagnostik</title>";
        echo "<style>
            body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
            h1, h2, h3 { color: #0056b3; }
            code { background-color: #eee; padding: 2px 4px; border-radius: 3px; }
            .success { color: green; font-weight: bold; }
            .error { color: red; font-weight: bold; }
            .warning { color: orange; font-weight: bold; }
            pre { background-color: #f0f0f0; padding: 10px; border: 1px solid #ddd; overflow-x: auto; }
        </style>";
        echo "</head><body>";
        echo "<h1>chat_api.php - Halaman Diagnostik</h1>";
        echo "<p>Halaman ini untuk akses langsung/debugging. Endpoint utama (<code>/chat_api.php</code>) mengharapkan permintaan <code>POST</code> dengan data JSON dari chatbot.</p>";
        
        echo "<h2>Pemeriksaan Lingkungan PHP:</h2>";

        echo "<h3>Ekstensi cURL:</h3>";
        if (function_exists('curl_init')) {
            echo "<p class='success'>✅ Ekstensi cURL <b>AKTIF</b>.</p>";
        } else {
            echo "<p class='error'>❌ Ekstensi cURL <b>TIDAK AKTIF</b>. Ini adalah penyebab umum error 500 saat membuat permintaan eksternal. Mohon aktifkan <code>php_curl</code> di <code>php.ini</code> Anda dan restart web server.</p>";
        }

        echo "<h3>Ekstensi JSON:</h3>";
        if (function_exists('json_encode')) {
            echo "<p class='success'>✅ Ekstensi JSON <b>AKTIF</b>.</p>";
        } else {
            echo "<p class='error'>❌ Ekstensi JSON <b>TIDAK AKTIF</b>. Ini kritis untuk respons API. Mohon aktifkan <code>php_json</code> di <code>php.ini</code> Anda.</p>";
        }

        echo "<h3>Output Buffering:</h3>";
        if (ob_get_level() > 0) {
            echo "<p class='success'>✅ Output Buffering (<code>ob_start()</code>) terdeteksi aktif.</p>";
        } else {
            echo "<p class='warning'>⚠️ Output Buffering (<code>ob_start()</code>) tidak aktif, atau error terjadi sebelum dimulai. Ini dapat mempengaruhi penanganan error.</p>";
        }

        echo "<h3>Metode Permintaan:</h3>";
        echo "<p>Metode yang diterima: <code>" . htmlspecialchars($_SERVER['REQUEST_METHOD']) . "</code></p>";
        echo "<p>Endpoint ini mengharapkan metode <b>POST</b> untuk fungsionalitas chatbot.</p>";

        // Tambahkan info PHP secara lengkap jika diinginkan (hati-hati di produksi)
        // echo "<h2>Informasi PHP Lengkap (phpinfo()):</h2>";
        // phpinfo(); 

        echo "</body></html>";
    } else {
        // Untuk metode selain GET atau POST (misal PUT, DELETE, dll.), kirim 405 JSON
        header('Allow: POST');
        http_response_code(405); // Method Not Allowed
        echo json_encode(['error' => 'Method not allowed. Only POST requests are accepted.']);
        error_log("Error (405): Received " . $_SERVER['REQUEST_METHOD'] . " request. Only POST is allowed.");
    }
    ob_end_flush(); // Penting: Akhiri buffering untuk respons ini
}

?>