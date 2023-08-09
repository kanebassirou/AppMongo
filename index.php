<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <?php include'navbar.php'; ?>
    
    
    <div class="mt-4">

        <div class="row">
        <div class="col-md-8 offset-md-3">
        <div class="row mt-3">
        <a href="rechercher.php" class="Btn_add mb-4"> <img src="images/rechercher.png"> Rechercher</a>
        <a href="ajouter.php" class="Btn_add mb-4 col-md-3 offset-md-4"> <img src="images/plus.png"> Ajouter</a>
        </div>
        
        <table>
            <tr id="items">
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php
            // Inclure la page de connexion
            include_once "connexion.php";
            
            // Requête pour afficher la liste des employés
            $cursor = $collection->find();
            
            // Convertir le curseur en tableau pour compter les documents
            $documents = iterator_to_array($cursor);

            if (count($documents) == 0) {
                // S'il n'existe pas d'employé dans la base de données, affichez ce message :
                echo "Il n'y a pas encore d'employé ajouté !";
            } else {
                // Sinon, affichez la liste de tous les employés
                foreach ($documents as $document) {
                    ?>
                    <tr>
                        <td><?= $document['nom'] ?></td>
                        <td><?= $document['prenom'] ?></td>
                        <td><?= $document['age'] ?></td>
                        <!-- Nous alons mettre l'id de chaque employé dans ce lien -->
                        <td><a href="modifier.php?id=<?= $document['_id'] ?>"><img src="images/pen.png"></a></td>
                        <td><a href="supprimer.php?id=<?= $document['_id'] ?>"onclick="return confirm('Voulez-vous vraiment supprimer cet employé ?')"><img src="images/trash.png"></a></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>   
    </div>
</div>
    
</body>
</html>
