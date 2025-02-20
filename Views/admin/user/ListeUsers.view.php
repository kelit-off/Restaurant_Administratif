<?php
include_once 'Views/partials/header.view.php';
?>
<main>
    <table>
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user) {?>
                <tr class="">
                    <td><?= $user['user']['first_name'] ?></td>
                    <td><?= $user['user']['last_name'] ?></td>
                    <td><?= $user['user']['email'] ?></td>
                    <td><?= $user['droit']['droits_role'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>
<?php
include_once 'Views/partials/footer.view.php';