<?php
// Inclusion de la page de connexion à MongoDB
include_once "connexion.php";

// Récupération de l'id dans le lien
$id = $_GET['id'];

// Conversion de l'id en objet ObjectId de MongoDB
$idMongo = new MongoDB\BSON\ObjectId($id);

// Requête de suppression dans MongoDB
$deleteResult = $collection->deleteOne(['_id' => $idMongo]);

// Vérification si la suppression a été effectuée avec succès
if ($deleteResult->getDeletedCount() > 0) {
    // Redirection vers la page index.php
    header("Location: index.php");
    exit();
} else {
    // Si la suppression a échoué, afficher un message d'erreur
    echo "Échec de la suppression de l'employé.";
}
?>
