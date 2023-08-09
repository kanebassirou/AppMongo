<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
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
    //vérifier que le bouton ajouter a bien été cliqué
    if (isset($_POST['button'])) {
        //extraction des informations envoyées dans des variables par la méthode POST
        extract($_POST);
        //vérifier que tous les champs ont été remplis
        if (isset($nom) && isset($prenom) && isset($age)) {
            //connexion à la base de données MongoDB
            include_once "connexion.php";
            
            // Requête d'ajout dans MongoDB
            $insertResult = $collection->insertOne([
                'nom' => $nom,
                'prenom' => $prenom,
                'age' => $age
            ]);
            
            if ($insertResult->getInsertedCount() > 0) {
                //si l'insertion a été effectuée avec succès , on fait une redirection
                header("location: index.php");
                exit();
            } else {
                //si non
                $message = "Employé non ajouté";
            }
        } else {
            //si non
            $message = "Veuillez remplir tous les champs !";
        }
    }
    ?>

    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Ajouter un employé</h2>
        <p class="erreur_message">
            <?php 
            // si la variable message existe , affichons son contenu
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
            <label>Nom</label>
            <input type="text" name="nom" required>
            <label>Prénom</label>
            <input type="text" name="prenom" required>
            <label>Âge</label>
            <input type="number" name="age" required>
            <input type="submit" value="Ajouter" name="button">
        </form>
      </div>
    </div>
    </div>
    </div>
    </div>
 
</body>
</html>
