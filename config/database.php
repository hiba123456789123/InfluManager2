<?php
// On inclut le fichier autoload généré par Composer
require_once __DIR__ . '/../vendor/autoload.php';

// On importe la classe Client depuis la bibliothèque MongoDB
use MongoDB\Client;

/**
 * Classe Database
 * Gère la connexion à la base MongoDB
 */
class Database {
    private static $instance = null; // Singleton
    private $client;  // Connexion au serveur MongoDB
    private $db;      // Base MongoDB utilisée

    // Constructeur privé
    private function __construct() {
        try {
            // URI du serveur MongoDB local
            $uri = "mongodb+srv://hibamejdoubi7_db_user:8GuWcsfdk8HuAVU1@cluster0.rnngzye.mongodb.net/influ_manager?retryWrites=true&w=majority&appName=Cluster0"
;
            //$this->client = new Client($uri);
             $this->client = new Client($uri);

            // ⚠️ Nom EXACT de ta base (vérifie dans Compass)
            $this->db = $this->client->influ_manager;
        } catch (Exception $e) {
            die("❌ Erreur de connexion MongoDB : " . $e->getMessage());
        }
    }

    // Retourne l’unique instance (Singleton)
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Retourne la base MongoDB
    public function getDB() {
        return $this->db;
    }
}
?>
