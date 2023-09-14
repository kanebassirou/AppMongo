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
    //connexion à la base de données
    include_once "connexion.php";

    //on récupère le id dans le lien
    $id = $_GET['id'];

    //requête pour afficher les infos d'un employé
    $document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);

    //vérifier que le bouton ajouter a bien été cliqué
    if (isset($_POST['button'])) {
        //extraction des informations envoyées dans des variables par la méthode POST
        extract($_POST);
        //vérifier que tous les champs ont été remplis
        if (isset($nom) && isset($prenom) && isset($age)) {
            //requête de modification
            $updateResult = $collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($id)],
                ['$set' => ['nom' => $nom, 'prenom' => $prenom, 'age' => $age]]
            );

            if ($updateResult->getModifiedCount() > 0) {
                $messageSucce ="vous modifier les information de l'employe avec succe";

                //si la requête a été effectuée avec succès , on fait une redirection
                $message = "Employé est modifié";
                header("location: index.php");
                exit();
            } else {
                //si non
                $message = "Employé non modifié";
            }
        } else {
            //si non
            $message = "Veuillez remplir tous les champs !";
        }
    }
    ?>

        <div class="mt-4">

       


    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Modifier l'employé : <?= $document['nom'] ?></h2>
        <?php
        
          if (isset($message)) {
            echo '<div class="alert alert-danger">' . $message. '</div>';
            }
         ?>
        <!-- <p class="erreur_message">
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        </p> -->
        <form action="" method="POST">
            <label>Nom</label>
            <input type="text" name="nom" value="<?= $document['nom'] ?>">
            <label>Prénom</label>
            <input type="text" name="prenom" value="<?= $document['prenom'] ?>">
            <label>Âge</label>
            <input type="number" name="age" value="<?= $document['age'] ?>">
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
</div>
        </div>
</div>
</div>
</body>
</html>
