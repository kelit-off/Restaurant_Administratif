<?php
include_once 'Views/partials/header.view.php';
?>
<main class="container mx-auto p-6">
    <div class="overflow-x-auto">
        <div class="flex flex-row justify-between mt-6 mb-5">
            <a class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg shadow hover:bg-gray-400" href="/admin">Retour à l'accueil</a>
            <a class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700" href="/admin/<?=$type?>/create">Créer</a>
        </div>
        <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <?php foreach($HeadersTable as $HeaderTable) { ?>
                        <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase"> <?= $HeaderTable ?> </th>
                    <?php } ?>
                    <th class="px-6 py-3 text-left text-gray-700 font-semibold uppercase"> Actions </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach($ContentsTable as $ContentTable) {?>
                    <tr class="hover:bg-gray-50">
                        <?php foreach($ContentTable as $key => $Content) { 
                            if ($key == 'id') {
                                continue;
                            }
                        ?>
                            <td class="px-6 py-4 text-gray-900"> <?= $Content ?> </td>
                        <?php } ?>
                        <td class="px-6 py-4">
                            <?php if(!empty($ContentTable['id'])) {?>
                                <a href="/admin/<?=$type?>/edit/<?= $ContentTable['id'] ?>" class="text-blue-600 hover:underline">Modifier</a>
                                <a href="/admin/<?=$type?>/<?= $ContentTable['id']?>/delete" class="ml-4 px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700">Supprimer</a>
                            <?php } elseif(isset($ContentTable['id_prestation']) && isset($ContentTable['id_categorie'])) {?>
                                <a href="/admin/tarif/edit/<?= $ContentTable['id_prestation'] ?>-<?=$ContentTable['id_categorie'] ?>" class="text-blue-600 hover:underline">Modifier</a>
                                <button data-id-prestataire="<?= $ContentTable['id_prestation'] ?>" data-id-category="<?=$ContentTable['id_categorie'] ?>" data-url="<?=$type?>" class="ml-4 px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700">Supprimer</button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>
<?php
include_once 'Views/partials/footer.view.php';
?>