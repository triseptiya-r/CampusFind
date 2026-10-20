<?php
// Konfigurasi Kredensial Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'campusfind_db');
define('DB_CHARSET', 'utf8mb4');

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Mengaktifkan exception error handling
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Default fetch associative array
            PDO::ATTR_EMULATE_PREPARES   => false,                  // Menggunakan native prepared statements untuk keamanan
        ];

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (\PDOException $e) {
            // Tangkap error koneksi (Bisa disesuaikan untuk production)
            http_response_code(500);
            exit("Koneksi Database Gagal: " . $e->getMessage());
        }
    }

    // Mencegah kloning instance (Singleton Pattern)
    private function __clone() {}

    // Method untuk mendapatkan instance tunggal koneksi PDO
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Method pembantu untuk mengambil koneksi PDO secara langsung
    public static function getConnection() {
        return self::getInstance()->pdo;
    }
}