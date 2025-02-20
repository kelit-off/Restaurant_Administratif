<?php
include_once 'Views/partials/header.view.php';
?>
<main>
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
</main>
<?php
include_once 'Views/partials/footer.view.php';