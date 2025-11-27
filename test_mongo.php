<?php
// Ne rien inclure d'autre !
// Charger le vendor
require __DIR__ . '/vendor/autoload.php';

$uri = getenv('MONGODB_URI');

if (!$uri) {
    die("❌ Erreur : La variable MONGODB_URI n'est pas définie.\n");
}

try {
    $client = new MongoDB\Client($uri);

    $databases = $client->listDatabases();

    echo "✅ Connexion MongoDB réussie !\n";
    echo "Bases disponibles :\n";
    foreach ($databases as $db) {
        echo " - " . $db->getName() . "\n";
    }
} catch (Exception $e) {
    echo "❌ Erreur : " . $e->getMessage() . "\n";
}
