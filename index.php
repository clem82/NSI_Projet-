<?php
    require 'db.class.php';
    $DB = new DB();
    $title = "Signalement";

    if(isset($_POST['submit'])) {
        
        if(isset($_POST['informatique'])){
            $informatique = 1;
        } else {
            $informatique = 0;
        }
        if(isset($_POST['materiel'])){
            $materiel = 1;
        } else {
            $materiel = 0;
        }
        if(isset($_POST['projecteur'])){
            $projecteur = 1;
        } else {
            $projecteur = 0;
        }

        if(isset($_FILES['fichier'])){

            $file_name = $_FILES['fichier']['name'];
            $file_extension = strrchr($file_name, ".");
            $file_tmp_name = $_FILES['fichier']['tmp_name'];
            $file_dest = "Fichiers/".$file_name;
            move_uploaded_file($file_tmp_name, $file_dest);
            $img = $file_name;

        } else {
            $img = "";
        }

        $nom = $_POST['nom_salle'];
        $com = $_POST['com'];

        $req = $DB->query_ins('INSERT INTO salles (nom, informatique, materiel, projecteur, commentaire, image) VALUES (?, ?, ?, ?, ?, ?)',
        array($nom, $informatique, $materiel, $projecteur, $com, $img));

    }

?>
<!DOCTYPE>
<html>
    <?php
        include("Includes/head.php");
    ?>
    <body>

        <?php
            include("Includes/header.php");
        ?>
    
        <div class="form" align="center">
        <h1>Signaler un problème</h1>
            <form method="POST" action="" enctype="multipart/form-data">

                <table>
                    
                <tr>
                    <td><label for="nom_prof">Votre nom: </label></td>
                    <td><input type="text" name="nom_prof" placeholder="Votre nom" id="nom_prof"><br></td>
                </tr>
                
                <tr>
                    <td><label for="nom_salle">Nom de la salle: </label></td>
                    <td><input type="text" name="nom_salle" placeholder="Nom de la Salle" id="nom_salle"><br></td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="checkbox" name="informatique" id="informatique">
                        <label for="informatique">Informatique</label><br>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="checkbox" name="materiel" id="materiel">
                        <label for="materiel">Matériel</label><br>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td>
                        <input type="checkbox" name="projecteur" id="projecteur">
                        <label for="projecteur">Projecteur</label><br>
                    </td>
                </tr>

                <tr>
                    <td><label for="com">Commentaire: </label></td>
                    <td><textarea name="com" placeholder="Commentaires"></textarea></td>
                </tr>

                <tr>
                    <td><label>Envoyer une photo: </label></td>
                    <td><input type="file" name="fichier"></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td><br><input type="submit" name="submit" value="Valider"></td>
                </tr>

                </table>

            </form>
        </div>
    </body>
</html>
