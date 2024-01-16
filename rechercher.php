<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher un employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
<?php include'navbar.php'; ?>
<div class="mt-4">
<div class="row">
        <div class="col-md-8 offset-md-3">

    <?php
    // Inclure la page de connexion à MongoDB
    include_once "connexion.php";

    // Variable pour stocker le résultat de la recherche
    $resultats = [];

    if (isset($_POST['rechercher'])) {
        // Récupérer le nom de l'employé saisi dans le formulaire
        $nomRecherche = $_POST['nom'];

        // Requête pour rechercher l'employé dans MongoDB
        $regex = new MongoDB\BSON\Regex($nomRecherche, 'i'); // 'i' pour effectuer une recherche insensible à la casse
        $cursor = $collection->find(['nom' => $regex]);

        // Stocker les résultats dans un tableau
        foreach ($cursor as $document) {
            $resultats[] = $document;
        }
    }
    ?>
        
    <div class="form">
        <h2>Rechercher un employé</h2>

        <form action="" method="POST">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>

            <label>Nom de l'employé :</label>
            <input type="text" name="nom" required>
            <input type="submit" value="Rechercher" name="rechercher">
        </form>
        <br>
        <br>

        <?php if (!empty($resultats)): ?>
            <table class="table">
                <tr>
                 <th>Identifiant Employe</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Âge</th>
                </tr>
                <?php foreach ($resultats as $document): ?>
                    <tr>
                    <td><?= $document['_id'] ?></td>
                        <td><?= $document['nom'] ?></td>
                        <td><?= $document['prenom'] ?></td>
                        <td><?= $document['age'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    </div>
</div>
</div>

</body>
</html>
