<?php
require_once __DIR__ . '/vendor/autoload.php';

// Connexion à MongoDB
$client = new MongoDB\Client('mongodb://localhost:27017/');

// Sélection de la base de données et de la collection
$database = $client->selectDatabase('gestion_employes');
$collection = $database->selectCollection('employes');
