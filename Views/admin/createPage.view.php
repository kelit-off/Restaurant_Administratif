<?php
include_once 'Views/partials/header.view.php';

?>
<main class="container mx-auto p-6">
    <form action="/admin/<?=$type?>/<?=(isset($id)) ? 'update' : 'create'?>" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        <?php if(isset($id)) { ?>
            <input type="hidden" name="id" value="<?=$id?>">
        <?php }
        foreach ($formFields as $label => $type) { 
            $name = strtolower(str_replace(' ', '_', $label)); // Convertit en un format utilisable
        ?>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold" for="<?= $name ?>"><?= $label ?></label>
                <input 
                    type="<?= $type ?>" 
                    id="<?= $name ?>" 
                    name="<?= $name ?>" 
                    class="w-full mt-2 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                    required
                >
            </div>
        <?php } ?>
        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Soumettre</button>
    </form>
</main>
<?php
include_once 'Views/partials/footer.view.php';
?>