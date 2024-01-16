<?php
session_start();
?>
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
    <br> <br>
    <hr>
    <div class="mt-4">
        <div class="row">
        <div class="col-s12">
        <div class="row">
        <a href="rechercher.php" class="Btn_add mb-3"> <img src="images/rechercher.png"> Rechercher</a>
        <a href="ajouter.php" class="Btn_add mb-4 col-md-3 offset-md-8"> <img src="images/plus.png"> Ajouter</a>
        <hr>
        <br>
        <br>
        
        </div>
        <?php
        
          if (isset($message)) {
            echo '<div class="alert alert-danger">' . $message. '</div>';
            }
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success']. '</div>';
            unset($_SESSION['success']);
            }
         ?>
        <!-- <div id="temporary-message-container"></div> -->
        <!-- <div class="alert alert-success" id="success-message" style="display: none;"></div> -->
        <div class="table-responsive">        
          <table class="table">
          <thead>
            <tr id="">
                <th>Identifiant employe</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
          </thead>
            <tbody class="employee-table">
            <?php
            // Inclure la page de connexion
            include_once "connexion.php";
            
            // Requête pour afficher la liste des employés
            $cursor = $collection->find([], ['sort' => ['_id' => -1]]);
            
            // Convertir le curseur en tableau pour compter les documents
            $documents = iterator_to_array($cursor);

            if (count($documents) == 0) {
                // S'il n'existe pas d'employé dans la base de données, affichez ce message :
                echo "Il n'y a pas encore d'employé ajouté !";
            } else {
                $ide=1;
                // Sinon, affichez la liste de tous les employés
                foreach ($documents as $document) {
                    ?>
                    <tr>
                        <td><?=$document['_id']?></td>
                        <td><?=$document['nom'] ?></td>
                        <td><?= $document['prenom'] ?></td>
                        <td><?= $document['age'] ?></td>
                        <!-- Nous alons mettre l'id de chaque employé dans ce lien -->
                        <td><a href="modifier.php?id=<?= $document['_id'] ?>"><img src="images/pen.png"></a></td>
                        <td><a href="supprimer.php?id=<?= $document['_id'] ?>"onclick="return confirm('Voulez-vous vraiment supprimer cet employé ?')"><img src="images/trash.png"></a></td>
                    </tr>
                    <?php
                    $ide+=1;
                }
            }
            ?>
            </tbody>
        </table>
          </div>   
    </div>
    <div class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item" id="prevPage"><a class="page-link" href="#">Précédent</a></li>
            <!-- Vous pouvez ajouter plus de liens de page ici si nécessaire -->
            <li class="page-item" id="nextPage"><a class="page-link" href="#">Suivant</a></li>
        </ul>
    </nav>
</div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="veri.js"></script>
<script src="message.js" ></script>
   
</body>
</html>
