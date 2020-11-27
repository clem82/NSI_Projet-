<?php
    require 'db.class.php';
    $DB = new DB();
    $title = "Problèmes";

    $salles = $DB->query('SELECT * FROM salles');

    if(isset($_GET['submit'])) {
        if(empty($_GET['nom'])) {
            header('Location: salles.php');
        }
        $salles = $DB->query('SELECT * FROM salles WHERE nom = ?', array($_GET['nom']));
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

        <h1>Problèmes</h1>
        <div id="content">

            <table align="center">

                <tr class="ex">
                    <td><label>ID</label></td>
                    <td><label>Nom</label></td>
                    <td><label>Problème</label></td>
                    <td class="com"><label>Commentaire</label></td>
                    <td><label>Image</label></td>
                </tr>
               
                <?php
                    foreach($salles as $r):
                ?>
                <tr class="other">
                    <td> <?= $r->id; ?> </td>
                    <td> <?= $r->nom; ?> </td>

                    <td>
                        <?= $r->probleme; ?>
                    </td>

                    <td class="com"><?= $r->commentaire; ?></td>
                    <td class="img"><img class="img" src="Fichiers/<?=$r->image; ?>"></td>
                </tr>

            <?php
                endforeach
            ?>
            </table>
        </div>
    </body>
</html>