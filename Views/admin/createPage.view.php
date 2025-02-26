<?php
include_once 'Views/partials/header.view.php';
?>
<main class="container mx-auto p-6">
    <form action="/admin/<?=$type?>/<?=(isset($id)) ? 'update' : 'create'?>" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        <?php if (isset($id)) { ?>
            <input type="hidden" name="id" value="<?=$id?>">
        <?php } ?>

        <?php foreach ($formFields as $label => $type) { 
            $name = strtolower(str_replace(' ', '_', $label)); // Convert label to a usable format
        ?>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold" for="<?= $name ?>"><?= $label ?></label>

                <?php if ($type == 'select') { // Handle select dropdowns ?>
                    <select id="<?= $name ?>" name="<?= $name ?>" class="w-full mt-2 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                        <!-- Assuming you have predefined options for the 'Droits' field -->
                        <option value="">Sélectionner</option>
                        <option value="admin">Admin</option>
                        <option value="user">Utilisateur</option>
                        <!-- Add more options if needed -->
                    </select>

                <?php } else { // Handle text or email inputs ?>
                    <input 
                        type="<?= $type ?>" 
                        id="<?= $name ?>" 
                        name="<?= $name ?>" 
                        class="w-full mt-2 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" 
                        required
                    >
                <?php } ?>
            </div>
        <?php } ?>

        <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">Soumettre</button>
    </form>
</main>
<?php
include_once 'Views/partials/footer.view.php';
?>
