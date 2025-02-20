<?php
include_once 'Views/partials/header.view.php';
?>
<main>
    <div>
        <!-- Message indiquant si connecte ou nan -->
        <?php if(isset($_SESSION['user_id'])) { ?>
            <h1>Bienvenue!</h1>
        <?php } else { ?>
            <h1>Tu n'est pas connecte</h1>
        <?php } ?>
    </div>
    <div>
        <?php if(isset($_SESSION['user_id'])) { ?>
            <h1>Tes chez les cools ici :)</h1>
        <?php } else { ?>
            <p>Crée un compte ou connecte toi</p>
            <div>
                <a href="/auth/login">Connexion</a>
                <a href="/auth/register">Inscription</a>
            </div>
        <?php } ?>
    </div>
    <div>
        <!-- Les prix -->
        <table>
            <thead>
                <tr>
                    <th>Prestation</th>
                    <th>Categorie</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($prestationsListe as $prestation) { ?>
                    <tr class="">
                        <td><?= $prestation['prestation']['type_prestation'] ?></td>
                        <td><?= $prestation['categorie']['libelle_categorie'] ?></td>
                        <td><?= $prestation['prix'] ?>€</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>
<?php
include_once 'Views/partials/footer.view.php';
?>