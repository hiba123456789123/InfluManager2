<?php
// On inclut le fichier autoload généré par Composer
require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

class Database {
    private static $instance = null; // Singleton
    private $client;  // Connexion au serveur MongoDB
    private $db;      // Base MongoDB utilisée

    // Constructeur privé
    private function __construct() {
        try {
            // Récupère l'URI depuis la variable d'environnement
            $uri = getenv("MONGODB_URI");
            if (!$uri) {
                die("❌ Erreur : la variable d'environnement MONGODB_URI n'est pas définie !");
            }

            // Connexion au client MongoDB
            $this->client = new Client($uri);

            // ⚠️ Nom exact de ta base (vérifie sur Atlas)
            $dbName = getenv("MONGODB_DB") ?: "influ_manager"; // fallback si non défini
            $this->db = $this->client->selectDatabase($dbName);

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
